<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Course;
use App\Models\Homework;

/*
 * Z czasem jest w chuj problemow
 * Chce zrobic getRemainingTime jako Facade
 * ale nie wiem jeszcze jak
 *
 */

class TaskController extends Controller
{
    private function getRemainingTime($finishDate): array{
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $finishDate);
        $now = new \DateTime();

        if($date > $now){
            // you can still upload task on time
            $remainingTime = $now->diff($date);
            $onTime = true;
        } else {
            // you're too late
            $remainingTime = $date->diff($now);
            $onTime = false;
        }

        return [$remainingTime->format('%Y-%m-%d %H:%I:%S'), $onTime];
//        $currentTime = Carbon::now()->timestamp;
//        $finishTime = Carbon::parse($finishDate)->timestamp;
//        $remainingTime = $finishTime - $currentTime;
//        return Carbon::createFromTimestamp($remainingTime)->format('H:i:s');
    }

    public function create(Request $request, $id, $homeworkId){
        if($request->hasFile('task-file')){
            $user = auth()->id();
            $task = Task::where('homework_id', $homeworkId)->where('author_id', $user)->first();

            // computing reamining time
            $homework = Homework::find($homeworkId);
            $remainingTime = self::getRemainingTime($homework->finish_date);
            $onTime = $remainingTime > 0;

            $file = $request->file('task-file');
            $filePath = $file->store('tasks', 'public');

            // task exist so there is no need to create it again
            if($task){
                $task->update([
                    'file_path' => $filePath,
                    'filename' => $file->getClientOriginalName()
                ]);
                $task->save();
            } else{
                Task::create([
                    'author_id' => $user,
                    'homework_id' => $homeworkId,
                    'file_path' => $filePath,
                    'sended_on_time' => $onTime,
                    'filename' => $file->getClientOriginalName(),
                    'comment' => ''
                ]);

                return redirect('/course/' . $id . '/homework/' . $homeworkId);
            }
        }

        return back();
    }

    public function show($id, $homeworkId){
        $course = Course::find($id);
        $homework = Homework::find($homeworkId);
        $userId = auth()->id();
        $remainingTime = self::getRemainingTime($homework->finish_date);

        //dd([$homework->finish_date, $remainingTime]);

        if($homework && $course){
            if($homework->available){
                $task = Task::where('homework_id', $homeworkId)->where('author_id', $userId)->first();
                return view('/course/homework/show', [
                    'course' => $course,
                    'homework' => $homework,
                    'task' => $task,
                    'finishTime' => $remainingTime
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
        return redirect('/course/' . $id . '/homework/' . $homeworkId);
    }
}
