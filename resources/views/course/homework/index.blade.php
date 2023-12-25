@extends('course.show')

@section('title', 'Homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    @if(auth()->id() == $course->author_id)
        <a href="/course/{{$course->id}}/homework/create"><button class="btn btn-secondary">Add homework</button></a>
    @endif
    @foreach($course->homework->reverse() as $homework)
        @if(!(auth()->id() != $course->author_id && !$homework->available))
            <a href=""><h3>{{$homework->name}}</h3></a>
            <p>Deadline: {{$homework->finish_date}}</p>
        @endif
    @endforeach
@endsection