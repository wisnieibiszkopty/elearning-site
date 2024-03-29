<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    public function index(){
        $id = auth()->id();

        // I have no idea if it is efficient
        $chats = Chat::whereHas('users', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->with('users', 'messages')->get();

        return view('chat/index', ['chats' => $chats]);
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
        $chat = Chat::select('id')->with('users')->find($chatId);
        $friend = null;
        foreach ($chat->users as $user){
            if($user->id != auth()->id()){
                $friend = $user;
            }
        }
        $messages = Message::where('chat_id', '=', $chatId)->latest()->paginate(10)->reverse();
        return view('chat/show', ['chat' => $chat,
            'friend' => $friend,
            'messages' => $messages]);
    }

    // method for loading older messages
    public function load(Request $request, int $chatId){
        $limit = 10;

        $messages = Message::where('chat_id', '=', $chatId)
            ->latest()
            ->paginate($limit, ['*'], 'page', $request->page)
            ->reverse();

        $moreMessages = count($messages) === $limit;

        return response()->json([
            'messages' => $messages,
            'moreMessages' => $moreMessages
        ]);
    }

    public function store(Request $request, int $chatId){
        $message = $request->input('message');
        $senderId = auth()->id();
        $status = 'not ok';

        // preventing from sending storing message if authenticated user isn't member of chat
        $chat = Chat::find($chatId);
        $exists = $chat->users()->where('user_id', auth()->id())->exists();
        if($exists){
            $status = 'ok';

            // store message in database
            $msg = Message::create([
                'chat_id' => $chatId,
                'chat_member_id' => $senderId,
                'message' => $message
            ]);

            // broadcasting message
            // it stopped working for no reason
            MessageEvent::dispatch($chatId, $senderId, $message, $msg->id);
        }

        // returning status
        return response()->json([
            'status' => $status
        ]);
    }

    public function edit(Request $request, Message $message){
        $status = "not ok";

        if(auth()->id() == $message->chat_member_id){
            $message->message = $request->message;
            if($message->update()){
                $status = "ok";
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message->message
        ]);
    }

    public function destroy(Message $message){
        $status = "not ok";

        if(auth()->id() == $message->chat_member_id){
            if($message->delete()){
                $status = "ok";
            }
        }
        return response()->json(['status' => $status]);
    }
}
