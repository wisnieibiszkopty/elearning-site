@extends('main')

@section('title', 'Your courses')

@section('main')
    @if($role == 1)
        <div class="flex justify-end m-5">
            <a href="/course/create"><button class="btn btn-primary">Add course</button></a>
        </div>
    @else($role == 0)
        <div class="flex justify-end m-5">
            <div class="flex justify-end">
                <button class="btn btn-primary" onclick="join_modal.showModal()">Join course</button>
            </div>
            <dialog id="join_modal" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h1 class="text-2xl">Enter access code to join course</h1>
                    <div class="modal-action">
                    <form method="POST" action="/course/join" class="w-full">
                        @csrf
                        <div class="flex space-x-4 w-full">
                            <input type="text" placeholder="Entry code" name="code" autocomplete="off" class="input input-bordered w-full max-w-xs">
                            <button class="btn btn-secondary w-1/4">Join</button>
                        </div>
                    </form>
                </div>
                </div>
            </dialog>
        </div>
    @endif
    <div class="grid-container grid">
        @forelse($courses as $course)
            <x-course-item :course="$course"></x-course-item>
        @empty
            <x-empty></x-empty>
        @endforelse
    </div>
@endsection
