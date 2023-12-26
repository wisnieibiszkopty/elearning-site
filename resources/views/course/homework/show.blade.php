@extends('course.show')

@section('title', 'Task')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <h1>{{$homework->name}}</h1>
    <p>{{$homework->description}}</p>
    <p>{{$homework->finish_date}}</p>
    <p>remainingTime: {{$finishTime > 0 ? $finishTime : "Task closed"}}</p>
    @if($homework->file_path != "")
        <a href="{{asset('storage/' . $homework->file_path)}}" download>{{$homework->file_path}}</a>
    @endif
    <br>
    <!-- File wasn't added by user yet -->
    @if(!$task)
    <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}/task/create" enctype="multipart/form-data">
        @csrf
        <input type="file" name="task-file" class="file-input file-input-bordered w-full max-w-xs">
        <button class="btn">Send homework</button>
    </form>
    <!-- File is already added -->
    @else
        @if('$task->sended_on_time')
            <p style="color:greenyellow">Sended on time</p>
        @else
            <p style="color:red">Not sended on time</p>
        @endif
        <div>
            <a href="asset('storage/' . $task->file_path)">{{$task->filename}}</a>
            <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}/task/{{$task->id}}">
                @method('delete')
                @csrf
                <button class="btn">Undo upload</button>
            </form>
        </div>
    @endif
@endsection