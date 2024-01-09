<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Course;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // there is problem with comments -> i don't know how to limit comments which i get
    public function show(int $id){
        $course = Course::with(['posts.comments'])->find($id);
        // napraw
        $posts = $course->posts()->paginate(10);

        return view('course/posts', ['course' => $course,
            'posts' => $posts]);
    }

    public function store(Request $request, $id){
        $messageForm = $request->validate([
            'content' => ['required', 'min:3']
        ]);

        $post = new Post([
            'course_id' => $id,
            'author_id' => auth()->id(),
            'content' => $messageForm['content'],
            'edited' => false
        ]);

        $post->save();
        return back();
    }

    public function update(Request $request, $id, $postId){
        $form = $request->validate([
            'content' => ['required', 'min:3']
        ]);

        $post = Post::find($postId);
        if($post->author_id == auth()->id()){
            $post->content = $form['content'];
            $post->edited = true;
            $post->save();
        }
        return redirect('/course/' . $id . '/posts');
    }

    public function destroy($id, $postId){
        $post = Post::find($postId);
        $course = Course::find($id);
        if($post->author_id == auth()->id() || $course->author_id == auth()->id()){
            $post->delete();
        }
        return redirect('/course/' . $id . '/posts');
    }
}
