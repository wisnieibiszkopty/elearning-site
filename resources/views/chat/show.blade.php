@extends('main')

@section('head')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}" defer></script>
@endsection

@section('main')
<div class="navbar bg-base-200 rounded-full flex justify-center">
    <div class="avatar">
        <div class="w-12 rounded-full">
            <img src="{{$friend->avatarPath ? asset('storage/' . $friend->avatarPath) : asset('images/avatar-placeholder.jpg')}}" alt="{{$friend->name}}">
        </div>
    </div>
    <a href="/user/{{$friend->id}}"><h1 class="text-2xl bold">{{$friend->name}}</h1></a>
</div>
<div id="load-more-wrapper" class="flex justify-center my-10"><a id="load-more" class="link link-secondary">Load older messages</a></div>
<div id="messages" class="mb-20">
    @include('chat/messages', ['messages' => $messages])
</div>
<div id="bottom"></div>
<div class="fixed bottom-10 w-4/5 ">
    <form class="flex items-center space-x-4">
        <input type="text" id="chat-message" class="input input-bordered w-3/5" placeholder="Write message...">
        <button id="chat-btn" type="button" class="btn btn-secondary"><i class="fa-regular fa-paper-plane"></i></button>
    </form>
</div>
<div id="data" data-token="{{ csrf_token() }}" user-id="{{auth()->id()}}"></div>
@endsection
