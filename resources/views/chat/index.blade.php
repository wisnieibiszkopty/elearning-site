@extends('main')

@section('main')
    <div>
        @foreach($chats as $chat)
            <a href="/chats/{{$chat->id}}">{{$chat->id}}</a>
        @endforeach
    </div>
@endsection
