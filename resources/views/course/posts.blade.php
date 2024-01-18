@extends('course.show')

@section('title', 'Posts')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="1"></x-course-menu>
    <div class="flex space-x-10">
        <div class="w-3/4">
            <div class="bg-base-200 p-5 rounded-xl">
                <h2 class="text-xl">{{ $course->description }}</h2>
            </div>
            <div>
                <div class="mx-auto w-full mt-10">
                    <form method="POST" action="/course/{{$course->id}}/posts/create" class="flex space-x-4">
                        @csrf
                        <input type="text" required placeholder="Type your message..." name="content" min="3" autocomplete="off" class="input input-bordered w-60 md:w-4/5">
                        @error('content')
                        <p style="color:red;">Message must have at least 3 chars</p>
                        @enderror
                        <button class="btn btn-secondary"><i class="fa-regular fa-paper-plane"></i></button>
                    </form>
                </div>
                <div class="md:w-3/4 mx-auto mt-20">
                    @foreach($posts as $post)
                        <x-post :post="$post" :courseAuthor="$course->author_id" :courseId="$course->id"></x-post>
                    @endforeach
                </div>
                <div class="m-5">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div>
            @foreach($course->members as $member)
                <div class="flex items-center space-x-4 my-4">
                    <div class="avatar">
                        <div class="w-12 h-12 rounded-full">
                            <img class="avatar" src="{{ $member->avatarPath ? asset('storage/' . $member->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
                        </div>
                    </div>
                    <div>
                        <a href="/user/{{$member->id}}">{{ $member->name }}</a>
                    </div>
                    @if(auth()->id() == $course->author_id)
                        <div>
                            <div class="dropdown dropdown-end dropdown-bottom">
                                <div tabindex="0" role="button"><i class="fa-solid fa-ellipsis"></i></div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li style="color:red">
                                        <form method="POST" action="/course/{{$courseId}}/posts/{{$post->id}}">
                                            @method('delete')
                                            @csrf
                                            <button>Kick</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
