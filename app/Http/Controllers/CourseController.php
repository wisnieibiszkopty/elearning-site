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
    public function index(){
        $role = User::find(auth()->id(), ['role'])->role;
        return view('/course/index', ['role' => $role]);
    }

    public function create(){
        return view('/course/create');
    }

    public function store(Request $request){
        $form = $request->validate([
            'title' => [],
            'description' => []
        ]);

        $course = new Course([
            'title' => $form['title'],
            'description' => $form['description'],
            'author' => auth()->id()
        ]);

        if($course->save()){
            return redirect('course/' . $course->id);
        }
    }

    public function join(Request $request){

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
