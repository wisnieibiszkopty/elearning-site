<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id, $postId){
        $commentForm = $request->validate([
            'comment' => ['required', 'min:3']
        ]);

        $comment = new Comment([
            'post_id' => $postId,
            'author_id' => auth()->id(),
            'content' => $commentForm['comment']
        ]);
        $comment->save();
        return redirect('/course/' . $id . '/posts');
    }

    public function update(Request $request, $id, $commentId){
        $form = $request->validate([
            'comment' => ['required', 'min:3']
        ]);

        $comment = Comment::find($commentId);
        if($comment->author_id == auth()->id()){
            $comment->content = $form['comment'];
            $comment->edited = true;
            $comment->save();
        }

        return redirect('/course/' . $id . '/posts');
    }

    public function destroy($id, $postId, $commentId){
        $comment = Comment::find($commentId);
        $post = Post::find($postId);
        $course = Course::find($id);

        if($comment->author_id == auth()->id() || $post->author_id == auth()->id() || $course->author_id == auth()->id()){
            $comment->delete();
        }

        return redirect('/course/' . $id . '/posts');
    }
}
