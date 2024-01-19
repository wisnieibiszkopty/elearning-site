@extends('course.show')

@section('title', 'Members')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="1"></x-course-menu>
    @foreach($course->members->take(5) as $member)
        @if($member->id == $course->author_id)
            <div class="flex items-center space-x-4 my-4 border rounded-lg border-secondary py-2 px-6">
                <div class="avatar">
                    <div class="w-12 h-12 rounded-full">
                        <img class="avatar" src="{{ $member->avatarPath ? asset('storage/' . $member->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
                    </div>
                </div>
                <div>
                    <a href="/user/{{$member->id}}">{{ $member->name }} - leader</a>
                </div>
            </div>
        @else
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
                                    <form method="POST" action="/course/{{$course->id}}/kick/{{$member->id}}">
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
        @endif
    @endforeach
@endsection
