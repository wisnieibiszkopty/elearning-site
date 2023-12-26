@extends('course.show')

@section('title', 'Edit homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <!-- do editing here -->
@endsection