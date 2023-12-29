@extends('main')

@section('title', 'ChatGPT')

@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div>
        <div class="navbar bg-base-200 rounded-full">
            <h2 class="text-xl text-center">ChatGPT 3.5</h2>
        </div>
    </div>
    <div >
        <form method="POST" action="/openai" class="flex space-x-4">
            @csrf
            <input type="text" id="prompt" required placeholder="Type your message..." name="prompt" autocomplete="off" class="input input-bordered w-60 max-w-xs">
            <input type="submit" value="Send" class="btn btn-primary">
        </form>
    </div>
    <div class="messages">
        <div class="left-message my-3">
            <p>Hello!</p>
        </div>
    </div>
@endsection