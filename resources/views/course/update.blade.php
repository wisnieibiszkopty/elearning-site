@extends('course.show')

@section('title', 'Edit course')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="4"></x-course-menu>
    <!-- Edit image -->
    <form method="POST" action="/course/{{$course->id}}/image" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs">
        <button class="btn btn-secondary">Change image</button>
    </form>
    <!-- Edit info -->
    <form method="POST" action="/course/{{$course->id}}">
        @method('put')
        @csrf
        Title<br>
        <input type="text" placeholder="Title" name="title" value="{{$course->title}}" class="input input-bordered w-full max-w-xs">
        <br>Code<br>
        <input type="text" placeholder="Entry code" name="code" value="{{$course->code}}" class="input input-bordered w-full max-w-xs">
        <br>Description<br>
        <textarea placeholder="Description..." name="description" class="textarea textarea-bordered">{{$course->description}}</textarea>
        <br><button class="btn btn-primary">Change</button>
    </form>
    <!-- Deleting course -->
    <h3 class="text-3xl">Delete course</h3>
    <button class="btn btn-outline btn-error" onclick="delete_modal.showModal()">Delete course</button>
    <dialog id="delete_modal" class="modal">
        <div class="modal-box">
            <h3>Are you sure you want to delete course?</h3>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Cancel</button>
                </form>
                <form method="POST" action="/course/{{ $course->id }}">
                    @method('delete')
                    @csrf    
                    <button class="btn btn-outline btn-error">Delete</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection