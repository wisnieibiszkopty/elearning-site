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
            'comment' => []
        ]);

        $post = Post::find($postId);

        $comment = new Comment([
            'post_id' => $postId,
            'author_id' => $post->author_id,
            'content' => $commentForm['comment']
        ]);
        $comment->save();
        return redirect('/course/' . $id);
    }

    public function update(){

    }

    public function destroy(){
        
    }
}
