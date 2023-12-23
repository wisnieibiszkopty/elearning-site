@extends('main')

@section('title', 'Profile')

@section('main')
<div class="m-2">
    @if($user->id == auth()->id())
    <div class="avatar">
        <div class="w-24 rounded-full profile-picture" onclick="profile_modal.showModal()">
            <img class="avatar-img" src="{{ $user->avatarPath ? asset('storage/' . $user->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
            <div class="change-avatar">
                <p>Change avatar</p>
            </div>
        </div>
    </div>
    <dialog id="profile_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3>Change profile picture</h3>
            <form method="POST" action="/user/{{ $user->id }}/avatar" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="file" name="avatar" class="file-input file-input-bordered w-full max-w-xs" />
                <button class="btn btn-secondary">Change</button>
            </form>
        </div>
    </dialog>
    @else
    <div class="avatar">
        <div class="w-24 rounded-full profile-picture">
            <img src="{{ $user->avatarPath ? asset('storage/' . $user->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
        </div>
    </div>
    @endif
    @if(Auth::id() == $user->id)
    <a href="/user/{{ $user->id }}/edit">
        <button class="btn btn-primary">Manage</button>
    </a>
    <form method="POST" action="/auth/logout">
        @csrf
        <button class="btn btn-secondary">Logout</button>
    </form>
    @else
        <button class="btn btn-primary">Message</button>
    @endif

    <div class="stats shadow">
        <div class="stat place-items-center">
            <div class="stat-title">Name</div>
            <div class="stat-value">{{ $user->name }}</div>
        </div>
        <div class="stat place-items-center">
            <div class="stat-title">Email</div>
            <div class="stat-value">{{ $user->email }}</div>
        </div>
        <div class="stat place-items-center">
            <div class="stat-title">Company</div>
            <div class="stat-value">{{ $user->company }}</div>
        </div>
    </div>  
</div>
@endsection