<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Course;
use App\Models\Homework;
use Carbon\Carbon;

class TaskController extends Controller
{
    private function getRemainingTime($finishDate): string{
        $currentTime = Carbon::now()->timestamp;
        $finishTime = Carbon::parse($finishDate)->timestamp;
        $remainingTime = $finishTime - $currentTime;
        return Carbon::createFromTimestamp($remainingTime)->format('H:i:s');
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
                $task = Task::create([
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

        if($homework && $course){
            if($homework->available && $userId != $course->author_id){
                $task = Task::where('homework_id', $homeworkId)->where('author_id', $userId)->first();
                $remainingTime = self::getRemainingTime($homework->finish_date);
                return view('/course/homework/show', [
                    'course' => $course,
                    'homework' => $homework,
                    'task' => $task,
                    'finishTime' => $remainingTime
                ]);
            } else {
                $tasks = Task::where('homework_id', $homeworkId)->get();
                return view('/course/homework/tasks', [
                    'course' => $course,
                    'homework' => $homework,
                    'tasks' => $tasks
                ]);
            }
        }

        abort(404);
    }

    public function destroy($id, $homeworkId, $taskId){
        $task = Task::find($taskId);
        if($task) $task->delete();
        return redirect('/course/' . $id . '/homework/' . $homeworkId);
    }
}
