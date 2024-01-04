@extends('main')

@section('head')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}" defer></script>
@endsection

@section('main')
<div>

</div>
<div class="absolute bottom-10 w-4/5 ">
    <form class="flex items-center space-x-4">
        <input type="text" id="chat-message" class="input input-bordered w-3/5" placeholder="Write message...">
        <button id="chat-btn" type="button" class="btn btn-secondary"><i class="fa-regular fa-paper-plane"></i></button>
    </form>
</div>
<div id="csrf-token" data-token="{{ csrf_token() }}"></div>
@endsection
