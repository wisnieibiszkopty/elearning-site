<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

use App\Models\User;
use App\Models\Chat;
use App\Models\Message;


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
        $chat = Chat::select('id')->with('users')->find($chatId);
        $friend = null;
        foreach ($chat->users as $user){
            if($user->id != auth()->id()){
                $friend = $user;
            }
        }
        $messages = Message::where('chat_id', '=', $chatId)->latest()->paginate(5)->reverse();
        return view('chat/show', ['chat' => $chat,
            'friend' => $friend,
            'messages' => $messages]);
    }

    // method for loading older messages
    public function load(Request $request, int $chatId){
        $messages = Message::where('chat_id', '=', $chatId)
            ->latest()
            ->paginate(5, ['*'], 'page', $request->page)
            ->reverse();
        return view('chat/messages', ['messages' => $messages])->render();
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
            Message::create([
                'chat_id' => $chatId,
                'chat_member_id' => $senderId,
                'message' => $message
            ]);
        }

        // broadcasting message
        MessageEvent::dispatch($chatId, $senderId, $message);

        // returning status
        return response()->json([
            'status' => $status
        ]);
    }

    public function edit(Request $request, Message $message){
        if(auth()->id() == $message->chat_member_id){
            $message->message = $request->message;
            $message->update();
        }
        return redirect('/chats/' . $message->chat_id);
    }

    public function destroy(Message $message){
        if(auth()->id() == $message->chat_member_id){
            $message->delete();
        }
        return redirect('/chats/' . $message->chat_id);
    }
}
