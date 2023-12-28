@extends('course.show')

@section('title', 'Task')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <div class=" card bg-base-200 shadow-lg mt-5">
        <div class="card-body">
            <h2 class="card-title">{{$homework->name}}</h2>
            <p>{{$homework->description}}</p>
            <p>Deadline: {{$homework->finish_date}}</p>
            <p>Remaining time: {{$finishTime > 0 ? $finishTime : "Task closed"}}</p>
        </div>
    </div>
    @if($homework->file_path != "")
        <a href="{{asset('storage/' . $homework->file_path)}}" download>{{$homework->file_path}}</a>
    @endif
    <br>
    <!-- File wasn't added by user yet -->
    @if(!$task)
    <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}/task/create" enctype="multipart/form-data">
        @csrf
        <input type="file" name="task-file" class="file-input file-input-bordered w-full max-w-xs mb-3">
        <button class="btn btn-secondary">Send homework</button>
    </form>
    <!-- File is already added -->
    @else
        @if('$task->sended_on_time')
            <div class="badge badge-success">Sent on time</div>
        @else
            <div class="badge badge-error">Sent with delay</div>
        @endif
        <div class="flex items-center space-x-4 mt-5">
            <a class="link {{ $task->sended_on_time ? 'link-success' : 'link-error'}}" href="asset('storage/' . $task->file_path)">
                {{$task->filename}}
            </a>
            <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}/task/{{$task->id}}">
                @method('delete')
                @csrf
                <button class="btn">Undo upload</button>
            </form>
        </div>
    @endif
@endsection