@extends('course.show')

@section('title', 'Posts')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="1"></x-course-menu>
    <!-- Add post -->
    <!-- kurwa nie wiem czy sie bawic z tym fixed -->
    <!-- <div class="fixed bottom-10 mx-auto w-full">
        <form method="POST" action="/course/{{$course->id}}/posts/create" class="flex space-x-4">
            @csrf
            <input type="text" required placeholder="Type your message..." name="content" autocomplete="off" class="input input-bordered w-60 max-w-xs">
            <button class="btn btn-secondary"><i class="fa-regular fa-paper-plane"></i></button>
        </form>
    </div> -->
    <!-- View posts -->
    <div class="md:w-3/4 mx-auto mt-20">
    @foreach($posts as $post)
        <x-post :post="$post" :courseAuthor="$course->author_id" :courseId="$course->id"></x-post>
    @endforeach
    </div>
    <div class="m-5">
        {{ $posts->links() }}
    </div>
@endsection