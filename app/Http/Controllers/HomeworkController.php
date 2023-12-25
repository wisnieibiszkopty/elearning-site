<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Homework;

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
            'name' => ['required'],
            'description' => [],
            'finishDate' => []
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
        return view('/course/homework/show', [
            'course' => $course,
            'homework' => $homework
        ]);
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
