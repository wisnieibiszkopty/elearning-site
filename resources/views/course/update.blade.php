@extends('course.show')

@section('title', 'Edit course')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="4"></x-course-menu>
    <br>
    <div class="card bg-base-200">
        <div class="card-body flex items-center">
            @if(Session::has('message'))
                <div role="alert" class="alert alert-error">
                    <span>{{Session::get('message')}}</span>
                </div>
            @endif
            <div class="mx-auto my-10">
                <!-- Edit image -->
                <h3 class="text-xl mb-2">Change image</h3>
                <form method="POST" action="/course/{{$course->id}}/image" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs mb-2"><br>
                    <button class="btn btn-secondary w-1/2">Change image</button>
                </form>
                <!-- Edit info -->
                <form method="POST" action="/course/{{$course->id}}">
                    @method('put')
                    @csrf
                    <h3 class="text-lg my-1">Title</h3>
                    @error('title')
                    <x-error :message="$message"></x-error>
                    @enderror
                    <input type="text" placeholder="Title" name="title" value="{{$course->title}}" class="input input-bordered w-full max-w-xs">
                    <h3 class="text-lg my-1">Entry code</h3>
                    @error('code')
                    <x-error :message="$message"></x-error>
                    @enderror
                    <input type="text" placeholder="Entry code" name="code" value="{{$course->code}}" class="input input-bordered w-full max-w-xs">
                    <h3 class="text-lg my-1">Description</h3>
                    @error('description')
                    <x-error :message="$message"></x-error>
                    @enderror
                    <textarea placeholder="Description..." name="description" class="textarea textarea-bordered w-full max-w-xs" cols="30" rows="5">{{$course->description}}</textarea><br>
                    <button class="btn btn-primary my-1 w-1/2">Change</button>
                </form>
                <!-- Deleting course -->
                <h3 class="text-3xl my-2 ">Delete course</h3>
                <button class="btn btn-outline btn-error w-1/2 mb-10" onclick="delete_modal.showModal()">Delete course</button>
                <dialog id="delete_modal" class="modal">
                    <div class="modal-box">
                        <h3 class="text-xl">Are you sure you want to delete course?</h3>
                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn">Cancel</button>
                            </form>
                            <form method="POST" action="/course/{{ $course->id }}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-outline btn-error ">Delete</button>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>
    </div>
@endsection
