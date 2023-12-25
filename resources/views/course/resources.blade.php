@extends('course.show')

@section('title', 'Resoucres')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="2"></x-course-menu>
    @if($course->author_id == auth()->id())
    <button class="btn" onclick="resource_modal.showModal()">Add resource</button>
    <dialog id="resource_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3>Share new file with members of the course</h3>
            <form method="POST" action="/course/{{$course->id}}/resources/create" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="file-input file-input-bordered w-full max-w-xs">
                <input type="text" name="name" class="input input-bordered w-full max-w-xs">
                <button class="btn btn-primary">Add file</button>
            </form>
        </div>
    </dialog>
    @endif
    @foreach($course->resources->reverse() as $resource)
        <div>
            <a href="{{ asset('storage/' . $resource->file_path) }}" download="{{$resource->name}}">{{$resource->name}}</a>
            <p>{{$resource->created_at}}</p>
            @if(auth()->id() == $course->author_id)
            <div class="dropdown">
                <div tabindex="0" role="button"><i class="fa-solid fa-ellipsis"></i></div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-52">
                    @php
                        $id = $resource->id;
                        $modal = "edit_modal" . $id . ".showModal()";
                        echo '<li><a onclick="' . $modal . '">Rename</a></li>';
                    @endphp
                    <dialog id="edit_modal{{$resource->id}}" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3>Enter new name</h3>
                            <form method="POST" action="/course/{{$course->id}}/resources/{{$resource->id}}">
                                @method('put')
                                @csrf
                                <input type="text" name="name" class="input input-bordered w-full max-w-xs">
                                <button class="btn btn-primary">Rename</button>
                            </form>
                        </div>
                    </dialog>
                    <li>
                        <form method="POST" action="/course/{{$course->id}}/resources/{{$resource->id}}">
                            @method('delete')
                            @csrf
                            <button>Delete</button>
                        </form></li>
                </ul>
            </div>
            @endif
        </div>
    @endforeach
@endsection