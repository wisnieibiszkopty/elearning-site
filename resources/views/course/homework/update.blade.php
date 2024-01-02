@extends('course.show')

@section('title', 'Edit homework')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="3"></x-course-menu>
    <!-- do editing here -->
    <form method="POST" action="/course/{{$course->id}}/homework/{{$homework->id}}">
        @method('put')
        @csrf
        <input type="text" required min="3" placeholder="Title" value="{{$homework->name}}" name="name" class="input input-bordered w-full max-w-xs my-2 block">
        @error('name')
        <p style="color:red;">Wrong title!</p>
        @enderror
        <textarea name="description" class="textarea textarea-bordered w-full max-w-xs my-2" placeholder="Description...">{{$homework->description}}</textarea>
        <div class="flex my-2">
            <input type="checkbox" name="available" checked="checked" class="checkbox">
            <p class="ml-3">Show after creating</p>
        </div>
        <input type="file" name="file" class="file-input file-input-bordered w-full max-w-xs my-2">
        <input type="datetime-local" value="{{$homework->finish_date}}" name="finishDate" required class="input input-bordered w-full max-w-xs block">
        <button class="btn btn-secondary my-2">Edit</button>
    </form>
@endsection
