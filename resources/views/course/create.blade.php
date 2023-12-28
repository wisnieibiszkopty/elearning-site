@extends('main')

@section('title', 'Create course')

@section('main')
    <div class="flex flex-col ">
        <h1 class="text-2xl my-3">Create new course!</h1>
        <form method="POST" action="/course" class="flex flex-col md:w-1/3">
            @csrf
            <input type="text" placeholder="Title" name="title" class="input input-bordered w-full max-w-xs my-1">
            <textarea class="textarea textarea-primary my-1" placeholder="Enter description..." name="description" rows="5" cols="10"></textarea>
            <input type="text" placeholder="Course code" name="code" class="input input-bordered w-full max-w-xs my-1">
            <button class="btn btn-secondary w-3/5 my-1">Create course!</button>
        </form>
    </div>
@endsection
