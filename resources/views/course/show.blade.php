@extends('main')

@section('title', 'Course')

@section('main')
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>
    <div role="tablist" class="tabs tabs-lifted">
        <a role="tab" class="tab tab-active">Posts</a>
        <a role="tab" class="tab">Resources</a>
        <a role="tab" class="tab">Homework</a>
        @if(auth()->id() == $course->author_id)
            <a href="/course/{{$course->id}}/edit" role="tab" class="tab">Settings</a>
        @endif
    </div>
@endsection
