@extends('course.show')

@section('title', 'Homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <x-message></x-message>
    <div class="flex flex-col md:flex-row items-center mb-10">
        <div class="card-body">
            <h2 class="card-title text-2xl">{{$homework->name}}</h2>
            <p>{{$homework->description}}</p>
            <p>Deadline: {{$homework->finish_date}}</p>
            <p>Remaining time: {{$onTime ? $finishTime : "Task closed"}}</p>
            @if($homework->file_path != "")
                <a href="{{asset('storage/' . $homework->file_path)}}" download class="link link-secondary">{{ str_replace('homework/', '', $homework->file_path) }}</a>
            @endif
            <div class="badge badge-warning">{{ $homework->available ? 'available' : 'unavailable' }}</div>
        </div>
        <div class="flex md:flex-col flex-row space-x-2 space-y-2 items-end">
            <a href="/course/{{$course->id}}/homework/{{$homework->id}}/edit">
                <button class="btn btn-primary">Edit</button>
            </a>
            <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}">
                @method('delete')
                @csrf
                <button class="btn btn-warning">Delete</button>
            </form>
            <a href="/course/{{$course->id}}/homework/{{$homework->id}}/download">
                <button class="btn btn-secondary">Download all</button>
            </a>
        </div>
    </div>
    <div class="ml-10">
        <h2 class="text-xl mb-4">Tasks sent:</h2>
        @php
        $ratio = round($tasks->count() / $course->members->count() * 100, 2);
        echo '<div class="radial-progress text-primary" style="--value:'. $ratio .';" role="progressbar">'. $ratio .'%</div>';
        @endphp
    </div>
    @error('comment')
        <p style="color:red;">Wrong comment format!</p>
    @enderror
    @foreach($tasks as $task)
        <div class="card bg-base-200 m-4 p-4 shadow-lg flex flex-col space-y-4 md:flex-row md:items-center justify-between">
            <div>
                <div class="flex flex-row items-center space-x-4">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="{{ $task->avatarPath ? asset('storage/' . $task->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="{{$task->name}}">
                        </div>
                    </div>
                    <div>
                        <a href="/user/{{$task->userId}}" class="link link-primary"><p>{{$task->name}}</p></a>
                    </div>
                    <p> | </p>
                    <div>
                        <a href="{{asset('storage/' . $task->file_path)}}" download="{{$task->filename}}" class="link link-secondary">
                            {{ (strlen($task->filename)) ? substr($task->filename, 0, 15) . '...' : $task->filename }}
                        </a>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 mt-4">
                    @if($task->sended_on_time)
                        <div class="badge badge-success">
                            Sent on time
                        </div>
                    @else
                        <div class="badge badge-warning">
                            Not sent on time
                        </div>
                    @endif
                    <div class="badge badge-neutral">
                        {{$task->updated_at}}
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-neutral" onclick="comment_modal_{{$task->id}}.showModal()">Add comment</button>
            </div>
            <dialog class="modal" id="comment_modal_{{$task->id}}">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="font-bold text-lg">Add comment</h3>
                    <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}/task/{{$task->id}}/comment" class="flex flex-col space-y-4 items-start">
                        @csrf
                        <textarea required name="comment" class="textarea textarea-bordered" placeholder="Write your comment...">{{$task->comment}}</textarea>
                        <button class="btn btn-secondary">Comment</button>
                    </form>
                </div>
            </dialog>
        </div>
    @endforeach
@endsection
