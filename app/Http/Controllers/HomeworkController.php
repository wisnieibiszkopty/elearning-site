<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Homework;
use App\Models\Task;
use App\Helpers\Helper;

/*
 *
 *  if user didn't sent task on time, and finish date will be changed
 *  so that user now sent task before that date, status won't change (fix in future)
 *
 */

class HomeworkController extends Controller
{
    public function index(int $id){
        $course = Course::find($id);
        return view('course/homework/index', ['course' => $course]);
    }

    public function create(int $id){
        $course = Course::find($id);
        return view('course/homework/create', ['course' => $course]);
    }

    public function store(Request $request, int $id){
        $form = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => [],
            'finishDate' => ['required'],
        ]);

        $homework = new Homework();

        if($request->hasFile('file')){
            $file = $request->file('file');
            $filePath = $file->store('homework', 'public');
            $homework->file_path = $filePath;
        }

        $homework->name = $form['name'];
        if($form['description'] != ""){
            $homework->description = $form['description'];
        }

        if($request->has('available')){
            $homework->available = true;
        } else {
            $homework->available = false;
        }

        $homework->finish_date = $form['finishDate'];
        $homework->course_id = $id;
        $homework->save();

        return redirect('/course/' . $id . '/homework');
    }

    public function show(int $id, int $homeworkId){
        $course = Course::find($id);
        $homework = Homework::find($homeworkId);

        $time = Helper::getRemainingTime($homework->finish_date);
        $remainingTime = $time[0];
        $onTime = $time[1];

        $tasks = Task::where('homework_id', $homeworkId)
            ->join('users', 'users.id', '=', 'tasks.author_id')
            ->select('tasks.*', 'users.avatarPath', 'users.name', 'users.id as userId')
            ->get();
        return view('/course/homework/tasks', [
            'course' => $course,
            'homework' => $homework,
            'tasks' => $tasks,
            'finishTime' => $remainingTime,
            'onTime' => $onTime
        ]);
    }

    public function edit(int $id, int $homeworkId){
        $course = Course::find($id);
        $homework = Homework::find($homeworkId);
        return view('/course/homework/update', [
            'course' => $course,
            'homework' => $homework
        ]);
    }

    public function update(Request $request, int $id, int $homeworkId){
        $homework = Homework::find($homeworkId);

        $form = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => [],
            'finishDate' => ['required'],
        ]);

        $homework->name = $form['name'];
        $homework->description = $form['description'];
        $homework->finish_date = $form['finishDate'];

        if($request->has('available')){
            $homework->available = true;
        } else {
            $homework->available = false;
        }

        // remember to delete old file
        if($request->hasFile('file')){
            dd('test');

            $file = $request->file('file');
            Helper::deleteFile($homework->file_path);

            $filePath = $file->store('homework', 'public');
            $homework->file_path = $filePath;
        }

        $message = "Cannot edit homework!";
        $success = false;

        if($homework->save()){
            $message = "Updated homework successfulyy!";
            $success = true;
        }

        return redirect('/course/' . $id . '/homework/' . $homeworkId . '/edit')->with([
            'message' => $message,
            'success' => $success
        ]);
    }

    public function destroy(int $id, int $homeworkId){
        $homework = Homework::find($homeworkId);
        if($homework){
            Helper::deleteFile($homework->file_path);
            $homework->delete();
        }

        return redirect('/course/' . $id . '/homework');
    }
}
