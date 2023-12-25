@extends('course.show')

@section('title', 'Add homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <form method="POST" action="/course/{{$course->id}}/homework" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Title" name="name" class="input input-bordered w-full max-w-xs"><br>
        <textarea name="description" class="textarea textarea-bordered" placeholder="Description..."></textarea><br>
        <div class="flex">
            <input type="checkbox" name="available" checked="checked" class="checkbox">
            <p>Show after creating</p>
        </div>
        <input type="file" name="file" class="file-input file-input-bordered w-full max-w-xs"><br>
        <input type="datetime-local" name="finishDate">
        <button class="btn btn-secondary">Add homework</button>
    </form>
@endsection