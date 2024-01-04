<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

use App\Models\User;
use App\Models\Chat;


// chat ma jakeiś imaginacje kurwa zle to całkowicie robie
class ChatController extends Controller
{
    public function index(){
        $user = User::find(auth()->id());

        return view('chat/index', ['chats' => $user->chats]);
    }

    public function create(int $userId){
        $ids = [auth()->id(), $userId];
        $chatId = DB::table('chat_members')
            ->whereIn('user_id', $ids)
            ->groupBy('chat_id')
            ->havingRaw('COUNT(DISTINCT user_id) = 2')
            ->pluck('chat_id')
            ->first();


        if(!$chatId){
            $chat = Chat::create();
            $chat->users()->attach($ids[0]);
            $chat->users()->attach($ids[1]);
            $chatId = $chat->id;
        }

        return redirect('/chats/' . $chatId);
    }

    public function show(int $chatId){
        $chat = Chat::find($chatId);
        return view('chat/show', ['chat' => $chat]);
    }

    public function store(Request $request, int $chatId){
        $message = $request->input('message');

        // store message in database

        // broadcasting message
        Message::dispatch($chatId, $message);
        //event(new Message($chatId, $message));

        // returning status
        return response()->json([
            'message' => $message,
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }
}
