@extends('main')

@section('title', 'Create course')

@section('main')
    <h1>Create new course!</h1>
    <form method="POST" action="/course">
        @csrf
        <input type="text" placeholder="Title" name="title" class="input input-bordered w-full max-w-xs">
        <textarea class="textarea textarea-primary" placeholder="Enter description..." name="description" rows="5" cols="50"></textarea>
        <button class="btn btn-secondary">Create course!</button>
    </form>
@endsection
