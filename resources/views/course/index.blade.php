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
@endsection
