@extends('main')

@section('main')
    <div>
        @foreach($chats as $chat)
            @php
            $user = $chat->users[0]->id == auth()->id() ? $chat->users[1] : $chat->users[0];
            @endphp
            <div class="card bg-base-200 shadow-xl my-5 px-10">
                <div class="flex space-x-4 items-center text-lg my-4">
                    <a href="/user/{{$user->id}}">
                        <div class="avatar">
                            <div class="w-16 rounded-full profile-picture">
                                <img src="{{ $user->avatarPath ? asset('storage/' . $user->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
                            </div>
                        </div>
                    </a>
                    <a href="/chats/{{$chat->id}}">
                        <div class="flex flex-col">
                            <div class="link-secondary">{{ $user->name }}</div>
                            <div>
                                @if($chat->lastMessage)
                                    @php
                                        $message = $chat->lastMessage->message;
                                    @endphp
                                    <span>{{ $chat->lastMessage->updated_at }}</span> |
                                    <span>{{ $chat->lastMessage->chat_member_id == auth()->id() ? 'You: ' : '' }}
                                        {{ (strlen($message)) > 30 ? substr($message, 0, 30) . '...' : $message }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
