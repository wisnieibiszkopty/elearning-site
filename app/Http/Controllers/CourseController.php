<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

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

            // author of the course also has to be member of it to pass authentication
            $course->members()->attach(auth()->id());
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
            if(!$course->members()->where('user_id', $userId)->exists()){
                $course->members()->attach($userId);   
            }

            return redirect('course/' . $course->id);
        }

        return back();
    }

    // i'm not sure how to get data from 3 tables with orm
    // chuj wie jak to napisać, zrobie sobie przerwe z tym
    public function show(int $id){
        $course = Course::find($id);
        //$course = Course::with(['posts.author:name,created_at,avatarPath'])->find($id);
        $posts = DB::table('posts') 
            ->where('course_id', $id)
            ->join('users', 'author_id', '=', 'users.id')
            //->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            //->join('users as comment_user', 'comments.author_id', '=', 'comment_user.id')
            ->select('posts.*', 'users.name', 'users.avatarPath')
            //'comments.*', 'comment_user.name as comment_name', 'comment_user.avatarPath as comment_avatar')
            ->orderByDesc('created_at')
            //->get();
            ->paginate(10);
        //dd($posts);
        return view('course/posts', ['course' => $course,
                                    'posts' => $posts]);
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
        return back();
    }

    public function update(Request $request, int $id){
        $form = $request->validate([
            'title' => [],
            'code' => [],
            'description' => []
        ]);

        $course = Course::find($id);
        if($course){
            $course->title = $form['title'];
            $course->code = $form['code'];
            $course->description = $form['description'];
            $course->save();
        }
        return back();
    }

    public function leave(int $id){

        $course = Course::find($id);
        $userId = auth()->id();
        if($userId != $course->author_id){
            $course->members()->detach($userId);
        }
        return back();
    }

    public function destroy(int $id){
        $course = Course::find($id);
        if($course->author_id == auth()->id()){
            $course->destroy();
            return redirect('/course');
        }

        return redirect('/course/' . $id . '/edit');
    }
}
