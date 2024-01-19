<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\UniqueConstraintViolationException;

/*
 *
 *  Dodaj bledy w widoku dodawania kursu i edycji
 *  napraw ten show zasrany
 */


class CourseController extends Controller
{

    // return courses
    public function index(){
        $role = auth()->user()->role;
        if($role == 1){
            $courses = Course::where('author_id', auth()->id())->get();
        } else if($role == 0){
            $courses = auth()->user()->courses;
        }

        return view('/course/index', ['role' => $role,
                                      'courses' => $courses]);
    }

    public function create(){
        return view('/course/create');
    }

    public function store(Request $request){
        $form = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'code' => ['required', 'min:3']
        ]);

        $course = new Course([
            'title' => $form['title'],
            'description' => $form['description'],
            'code' => $form['code'],
            'author_id' => auth()->id()
        ]);

        try {
            if ($course->save()) {
                // author of the course also has to be member of it to pass authentication
                $course->members()->attach(auth()->id());
            }
        } catch(UniqueConstraintViolationException $e){
            return redirect('course/create')
                ->withErrors(['code' => 'Code must be unique!'])
                ->withInput();
        }

        return redirect('course/' . $course->id . '/posts');
    }

    public function members(int $id){
        $course = Course::find($id);

        return view('course.members', ['course' => $course]);
    }

    // method for adding user to course, based on members table
    public function join(Request $request){
        $entryCode = $request['code'];
        $course = Course::where('code', $entryCode)->first();
        if($course){
            $userId = auth()->id();
            // check if user isn't already in course
            if(!$course->members()->where('user_id', $userId)->exists()){
                $course->members()->attach($userId);
            }

            return redirect('course/' . $course->id . '/posts');
        }

        return back();
    }

    public function edit(int $id){
        $course = Course::find($id);
        return view('course/update', ['course' => $course]);
    }

    public function image(Request $request, int $id){
        $course = Course::find($id);
        if($request->hasFile('image') && $course){
            $file = $request->file('image');
            $course->imagePath = $file->store('course_images', 'public');
            $course->save();
        }

        return back()->with("message", "You have to add image!");
    }

    public function update(Request $request, int $id){
        $form = $request->validate([
            'title' => ['required', 'min:3'],
            'code' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        try {
            $course = Course::find($id);
            if ($course) {
                $course->title = $form['title'];
                $course->code = $form['code'];
                $course->description = $form['description'];
                $course->save();
            }
            return back();
        } catch(UniqueConstraintViolationException $e){
            return back()->withErrors(['code' => 'Code must be unique!'])->withInput();
        }
    }

    public function leave(int $id){
        $course = Course::find($id);
        $userId = auth()->id();

        if($userId != $course->author_id){
            $course->members()->detach($userId);
        }
        return back();
    }

    public function kick(int $courseId, int $userId){
        $course = Course::find($courseId);
        $authorId = auth()->id();

        if($authorId == $course->author_id){
            $course->members()->detach($userId);
        }
        return back();
    }

    public function destroy(int $id){
        $course = Course::find($id);
        if($course->author_id == auth()->id()){
            $course->delete();
            return redirect('/course')->with([
                'message' => 'Delete course!',
                'success' => true
            ]);
        }

        return redirect('/course/' . $id . '/edit')->with([
            'message' => 'Cannot delete course!',
            'success' => false
        ]);
    }
}
