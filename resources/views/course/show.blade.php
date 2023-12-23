@extends('main')

@section('title', 'Course')

@section('main')
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>
    @yield('course')
@endsection
