@extends('course.show')

@section('title', 'Homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <h1>{{$homework->name}}</h1>
    <p>{{$homework->description}}</p>
    <br>
    <h1>Sended tasks</h1>
    <a href="/course/{{$course->id}}/homework/{{$homework->id}}/download">
        <button class="btn btn-secondary">Download all</button>
    </a><br>
    @foreach($tasks as $task)
        <!--
            Chcemy mieć nazwe pliku i ścieżke do pobrania, przycisk do pobierania wszystkich,
            informacje o użytkowniku i tym czy przesłał na czas i o której godzinie
        -->
        <p>
            @if($task->sended_on_time)
                Sended on time
            @else
                Sended with delay
            @endif
            | {{$task->created_at}}
        </p>
        <a href="{{asset('storage/' . $task->file_path)}}" download="{{$task->filename}}">{{$task->filename}}</a><br>
        <div>
            <a href="/user/{{$task->userId}}"><p>{{$task->name}}</p></a>
        </div>
    @endforeach
@endsection
