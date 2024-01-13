<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $filePath = $file->store('tasks', 'public');

            $task = Task::where('homework_id', $homeworkId)->where('author_id', $user)->first();

            // task exist so there is no need to create it again
            if($task){
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
        $tasks = $homework->tasks;
        $filepaths = [];
        foreach ($tasks as $task){
            $filepaths[$task->filename] = public_path($task->file_path);
        }
        //dd($filepaths);

        $zipFilename = $homework->name . ".zip";
        $zip = new \ZipArchive();
        $zip->open(public_path($zipFilename), \ZipArchive::CREATE);

        foreach($filepaths as $filename => $filepath){
            //dd($filepath);
            // nie dziala :<<
            $zip->addFile($filepath, $filename);
        }
        $zip->close();

        return response()->download(public_path($zipFilename))->deleteFileAfterSend(true);
    }

    public function destroy($id, $homeworkId, $taskId){
        $task = Task::find($taskId);
        if($task) $task->delete();
        return redirect('/course/' . $id . '/homework/' . $homeworkId . '/task');
    }
}
