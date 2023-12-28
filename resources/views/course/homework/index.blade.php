@extends('course.show')

@section('title', 'Homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    @if(auth()->id() == $course->author_id)
    <div class="flex justify-end mr-5 mt-5">
        <a href="/course/{{$course->id}}/homework/create"><button class="btn btn-secondary">Add homework</button></a>
    </div>
    @endif
    @foreach($course->homework->reverse() as $homework)
        <div class="card bg-base-200 m-4 shadow-lg">
            <div class="p-4">
                <a href="/course/{{$course->id}}/homework/{{$homework->id}}">
                    <h2 class="card-title">{{$homework->name}}</h2>
                </a>
                <p>Deadline: {{$homework->finish_date}}</p>
            </div>
        </div>
    @endforeach
@endsection