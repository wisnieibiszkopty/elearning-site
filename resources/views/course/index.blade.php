@extends('main')

@section('title', 'Your courses')

@section('main')
    @if($role == 1)
        <div>
            <a href="/course/create"><button class="btn btn-primary">Add course</button></a>
        </div>
    @else($role == 0)
        <div>
            <button class="btn btn-primary" onclick="join_modal.showModal()">Join course</button>
            <dialog id="join_modal" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h2>Enter access code to join course</h2>
                    <div class="modal-action">
                    <form method="POST" action="/course/join">
                        @csrf
                        <div class="flex space-x-4">
                            <input type="text" placeholder="Entry code" name="code" class="input input-bordered w-full max-w-xs">
                            <button class="btn btn-secondary">Join</button>
                        </div>
                    </form>
                </div>
                </div>
            </dialog>
        </div>
    @endif
    <div class="collapse collapse-arrow bg-base-200">
        <input type="checkbox"> 
        <div class="collapse-title text-xl font-medium">
            Filters
        </div>
        <div class="collapse-content"> 
            <p>jazda</p>
        </div>
    </div>
    <!-- Just to check if it works, styles, etc will be added later-->
    <div>
        @forelse($courses as $course)
            <div>
                <a href="/course/{{ $course->id }}">
                    <h1>{{ $course->title }}</h1>
                </a>
                <p>{{ $course->author_id }}</p>
            </div>
        @empty
            <h1>It seems that you don't join any courses yet</h1>
        @endforelse
    </div>
@endsection
