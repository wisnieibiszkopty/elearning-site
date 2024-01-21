@extends('main')

@section('head')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}" defer></script>
@endsection

@section('main')
<div class="flex justify-center">
    <div class="navbar bg-base-200 rounded-lg flex justify-center space-x-5 py-3 md:w-1/3">
        <div class="avatar">
            <div class="w-12 rounded-full">
                <img src="{{$friend->avatarPath ? asset('storage/' . $friend->avatarPath) : asset('images/avatar-placeholder.jpg')}}" alt="{{$friend->name}}">
            </div>
        </div>
        <a href="/user/{{$friend->id}}"><h1 class="text-2xl bold">{{$friend->name}}</h1></a>
    </div>
</div>
<div id="load-more-wrapper" class="flex justify-center my-10"><a id="load-more" class="link link-secondary">Load older messages</a></div>
<div id="messages">
    @include('chat/messages', ['messages' => $messages])
</div>
<div id="bottom" style="height: 75px;"></div>
<div class="fixed bottom-10 w-4/5 ">
    <div class="flex items-center space-x-4">
        <input type="text" id="chat-message" class="input input-bordered w-3/5" placeholder="Write message...">
        <button id="chat-btn" type="button" class="btn btn-secondary"><i class="fa-regular fa-paper-plane"></i></button>
    </div>
</div>
<div id="data" data-token="{{ csrf_token() }}" user-id="{{auth()->id()}}"></div>
@endsection
