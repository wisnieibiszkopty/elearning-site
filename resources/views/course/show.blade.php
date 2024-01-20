@extends('main')

@section('title', 'Course')

@section('main')
    <div class="flex flex-row items-end space-x-4 mb-10">
        <div>
            <div class="avatar">
                <div class="w-24 rounded-xl">
                    <img src="{{ $course->imagePath ? asset('storage/' . $course->imagePath) : asset('images/no-image.jpg')}}" alt="{{$course->name}}">
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-3xl">{{ $course->title }}</h1>
        </div>
    </div>
    @yield('course')
@endsection
