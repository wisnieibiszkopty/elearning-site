<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;

class MusicPlayerController extends Controller
{
    public function playerSize(Request $request){
        $user = User::find(auth()->id());

        $success = false;
        $message = "Large player disabled";

        if($request->filled('large-player')){
            $user->large_player = true;
            $message = "Large player enabled";
            $success = true;
        } else {
            $user->large_player = false;
        }

        return redirect('/user/' . $user->id . '/edit')->with([
           'message' => $message,
           'success' => $success
        ]);
    }

    // https://open.spotify.com/playlist/7FFmEldpO7Bk8BUszNvwPk?si=1c98606e4503436b
    // https://open.spotify.com/embed/playlist/7FFmEldpO7Bk8BUszNvwPk?utm_source=generator
    public function update(Request $request, int $courseId){
        $form = $request->validate([
           'playlist_link' => ['required', 'url', 'starts_with:https://open.spotify.com']
        ]);

        $parts = parse_url($form['playlist_link']);
        $link = str_replace('/playlist', '/embed/playlist', $parts['path']);
        $link = $parts['scheme'] . '://' . $parts['host'] . $link . '?utm_source=generator';

        $course = Course::find($courseId);
        $course->playlist_link = $link;
        $course->save();

        return back()->with([
            'message' => 'Updated spotify playlist',
            'success' => true
        ]);
    }

    public function destroy(int $courseId){
        $course = Course::find($courseId);
        $course->playlist_link = "";
        $course->save();

        return back()->with([
            'message' => 'Deleted playlist',
            'success' => false
        ]);
    }
}
