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
        <form method="POST" action="/openai">
            @csrf
            <input type="text" id="prompt" name="prompt" required placeholder="Type your message..." autocomplete="off" class="input input-bordered w-60 max-w-xs">
            <button class="btn btn-secondary" type="submit">Send</button>
        </form>
    </div>
    <div class="messages">
        <div class="chat chat-start">
            <div class="chat-bubble">Hello!</div>
        </div>
    </div>
@endsection
{{--<script>--}}
{{--    $("form").submit(function (event) {--}}
{{--        event.preventDefault();--}}
{{--        $("form #message").prop('disabled', true);--}}
{{--        $("form button").prop('disabled', true);--}}

{{--        $.ajax({--}}
{{--           url: '/openai',--}}
{{--           method: 'POST',--}}
{{--           headers: {--}}
{{--               'X-CSRF-TOKEN': "{{csrf_token()}}"--}}
{{--           },--}}
{{--            data: {--}}
{{--               'content': $("form #message").val()--}}
{{--            }--}}
{{--        }).done(function(res){--}}
{{--            console.log(res);--}}
{{--            $(".messages > .message").last().after('<div class="chat chat-end"><div class="chat-bubble">' +--}}
{{--                '<p>' + $("form #message").val() + '</p>' +--}}
{{--                '</div></div>');--}}

{{--            $(".messages > .message").last().after('<div class="chat chat-start"><div class="chat-bubble">' +--}}
{{--                '<p>' + res + '</p>' +--}}
{{--                '</div></div>');--}}

{{--            $("form #message").val('');--}}
{{--            $(document).scrollTop($(document).height());--}}
{{--            $("form #message").prop('disabled', false);--}}
{{--            $("form button").prop('disabled', false);--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
