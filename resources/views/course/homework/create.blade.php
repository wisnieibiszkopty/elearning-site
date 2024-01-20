@extends('course.show')

@section('title', 'Add homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <div class="md:w-3/4 mx-auto mt-20 w-full">
        <h3 class="text-xl inline">Add new homework</h3>
        @if($errors->any())
            @foreach($errors as $error)
                <p style="color:red;">{{$error}}</p>
            @endforeach
        @endif
        <form method="POST" action="/course/{{$course->id}}/homework" enctype="multipart/form-data">
            @csrf
            <input type="text" required min="3" placeholder="Title" name="name" class="input input-bordered w-full max-w-xs my-2 block">
            @error('name')
                <p style="color:red;">Wrong title!</p>
            @enderror
            <textarea name="description" class="textarea textarea-bordered w-full max-w-xs my-2" placeholder="Description..."></textarea>
            <div class="flex my-2">
                <input type="checkbox" name="available" checked="checked" class="checkbox">
                <p class="ml-3">Show after creating</p>
            </div>
            <input type="file" name="file" class="file-input file-input-bordered w-full max-w-xs my-2">
            <input type="datetime-local" name="finishDate" required class="input input-bordered w-full max-w-xs block">
            <button class="btn btn-secondary my-2">Add homework</button>
        </form>
    </div>
@endsection
