<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\File;

use App\Models\Task;
use App\Models\Course;
use App\Models\Homework;
use App\Helpers\Helper;

class TaskController extends Controller
{
    public function create(Request $request, $id, $homeworkId){
        if($request->hasFile('task-file')){
            $user = auth()->id();
            $homework = Homework::find($homeworkId);

            // computing remaining time
            $time = Helper::getRemainingTime($homework->finish_date);
            $onTime = $time[1];

            // we have to store file in both cases -
            // when user upload task and when user edit task
            $file = $request->file('task-file');
            $filePath = $file->store('tasks/' . $homeworkId, 'public');

            $task = Task::where('homework_id', $homeworkId)->where('author_id', $user)->first();

            // task exist so there is no need to create it again
            if($task){
                $oldFilePath = $task->file_path;
                if($oldFilePath){
                    Storage::delete('public/' . $oldFilePath);
                }

                $task->update([
                    'file_path' => $filePath,
                    'filename' => $file->getClientOriginalName(),
                    'sended_on_time' => $onTime
                ]);
                $task->save();
            } else{
                Task::create([
                    'author_id' => $user,
                    'homework_id' => $homeworkId,
                    'file_path' => $filePath,
                    'filename' => $file->getClientOriginalName(),
                    'sended_on_time' => $onTime,
                    'comment' => ''
                ]);

                return redirect('/course/' . $id . '/homework/' . $homeworkId . '/task');
            }
        }

        return back();
    }

    public function show($id, $homeworkId){
        $course = Course::find($id);
        $homework = Homework::find($homeworkId);
        $userId = auth()->id();
        $remainingTime = Helper::getRemainingTime($homework->finish_date);

        if($homework && $course){
            if($homework->available){
                $task = Task::where('homework_id', $homeworkId)->where('author_id', $userId)->first();
                return view('/course/homework/show', [
                    'course' => $course,
                    'homework' => $homework,
                    'task' => $task,
                    'finishTime' => $remainingTime[0],
                    'onTime' => $remainingTime[1]
                ]);
            }
        }

        abort(404);
    }

    public function comment(Request $request, $id, $homeworkId, $taskId){
        $form = $request->validate([
            'comment' => ['required', 'min:3']
        ]);

        $task = Task::find($taskId);
        $task->comment = $form['comment'];
        $task->save();

        return back();
    }

    public function downloadAll($id, $homeworkId){
        $homework = Homework::find($homeworkId);

        $zipFilename = $homework->name . ".zip";
        $zip = new ZipArchive();

        if($zip->open(public_path($zipFilename), ZipArchive::CREATE)){
            if(File::isDirectory(public_path('storage/tasks/' . $homeworkId))){
                $files = File::files(public_path('storage/tasks/' . $homeworkId));

                foreach ($files as $key => $value){
                    $relativeName = basename($value);
                    $zip->addFile($value, $relativeName);
                }

                $zip->close();

                $response = new Response(file_get_contents($zipFilename));
                $response->header('Content-Type', 'application/zip');
                $response->header('Content-Disposition', 'attachment; filename="' . $zipFilename . '"');

                unlink($zipFilename);

                return $response;
            }
        }

        return back()->with([
           "message" => "Cannot download zip file",
           "success" => false
        ]);
    }

    public function destroy($id, $homeworkId, $taskId){
        $task = Task::find($taskId);

        $message = "Cannot delete task!";
        $success = false;

        if($task){
            Helper::deleteFile($task->file_path);
            $task->delete();

            $message = "Task successfully deleted!";
            $success = true;
        }
        return redirect('/course/' . $id . '/homework/' . $homeworkId . '/task')->with([
            'message' => $message,
            'success' => $success
        ]);
    }
}
