<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Course;
use Illuminate\Http\Request;

/*
    Maybe add reactions 
    gif and images???
    4. Komentarze -> analogicznie usuwanie i edycja
    5. Lecimy dalej etydowanie kursu
*/

class PostController extends Controller
{
    // add error handling
    public function store(Request $request, $id){
        $messageForm = $request->validate([
            'content' => []
        ]);

        $post = new Post([
            'course_id' => $id,
            'author_id' => auth()->id(),
            'content' => $messageForm['content']
        ]);

        $post->save();
        return back();
    }

    public function update(Request $request, $id, $postId){
        $form = $request->validate([
            'content' => []
        ]);

        $post = Post::find($postId);
        if($post->author_id == auth()->id()){
            $post->content = $form['content'];
            $post->save();
        }
        return redirect('/course/' . $id);
    }

    public function destroy($id, $postId){
        $post = Post::find($postId);
        $course = Course::find($id);
        if($post->author_id == auth()->id() || $course->author_id == auth()->id()){
            Post::destroy($postId);
        }
        return redirect('/course/' . $id);
    }
}
