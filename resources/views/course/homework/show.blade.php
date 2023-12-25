@extends('course.show')

@section('title', 'Homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    
@endsection