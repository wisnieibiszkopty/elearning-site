@extends('course.show')

@section('title', 'Posts')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="1"></x-course-menu>
    <!-- Add post -->
    <div>
        <form method="POST" action="/course/{{$course->id}}/posts/create">
            @csrf
            <input type="text" required placeholder="Type your message..." name="content" class="input input-bordered w-full max-w-xs">
            <button class="btn btn-secondary"><i class="fa-regular fa-paper-plane"></i></button>
        </form>
    </div>
    <!-- View posts -->
    @foreach($posts as $post)
        <x-post :post="$post" :courseAuthor="$course->author_id" :courseId="$course->id"></x-post>
    @endforeach
    <div class="m-5">
        {{ $posts->links() }}
    </div>
@endsection