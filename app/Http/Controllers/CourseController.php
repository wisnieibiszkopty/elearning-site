<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

/*
    For sure i need to add some kind of key for students to join course
    also tags would be cool
    maybe delete imagePath ???
*/

class CourseController extends Controller
{

    // return courses
    public function index(){
        $role = auth()->user()->role;
        return view('/course/index', ['role' => $role]);
    }

    public function create(){
        return view('/course/create');
    }

    public function store(Request $request){
        $form = $request->validate([
            'title' => [],
            'description' => [],
            'code' => []
        ]);

        $course = new Course([
            'title' => $form['title'],
            'description' => $form['description'],
            'code' => $form['code'],
            'author_id' => auth()->id()
        ]);

        if($course->save()){
            return redirect('course/' . $course->id);
        }
    }

    // method for adding user to course, based on members table
    // add error message
    public function join(Request $request){
        $entryCode = $request['code'];
        $course = Course::where('code', $entryCode)->firstOrFail();
        if($course){
            $userId = auth()->id();
            // check if user isnt already in course
            $course->members()->attach($userId);

            return redirect('course/' . $course->id);
        }

        return back();
    }

    public function show(int $id){
        dd($id);
    }

    public function edit(int $id){

    }

    public function update(int $id){

    }

    public function destroy(int $id){

    }
}
