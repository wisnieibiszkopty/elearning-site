@extends('main')

@section('title', 'Profile')

@section('main')
<div class="m-2">
    <div class="flex flex-col md:flex-row">
        <div class="flex flex-col items-center">
            @if($user->id == auth()->id())
            <div class="avatar">
                <div class="w-40 rounded-full profile-picture" onclick="profile_modal.showModal()">
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
                    <h3 class="text-2xl">Change profile picture</h3><br>
                    <form method="POST" action="/user/{{ $user->id }}/avatar" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="flex space-x-4 w-full">
                            <input type="file" name="avatar" class="file-input file-input-bordered w-full max-w-xs" />
                            <button class="btn btn-secondary w-1/4">Change</button>
                        </div>
                    </form>
                </div>
            </dialog>
            @else
            <div class="avatar">
                <div class="w-40 rounded-full profile-picture">
                    <img src="{{ $user->avatarPath ? asset('storage/' . $user->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
                </div>
            </div>
            @endif
            <h1 class="text-3xl mt-5">{{ $user->name }}</h1>
        </div>
        <div class="flex justify-around spacex-x-5 mt-10 md:justify-end md:w-full mx-10">
            @if(Auth::id() == $user->id)
            <a href="/user/{{ $user->id }}/edit">
                <button class="btn btn-primary px-8">Manage</button>
            </a>
            <form method="POST" action="/auth/logout">
                @csrf
                <button class="btn btn-secondary px-8">Logout</button>
            </form>
            @else
                <button class="btn btn-primary px-8">Message</button>
            @endif
        </div>
    </div>
    <div class="flex justify-center mt-10">
        <!-- chuj wie jak jest prosto ustawic (kolka) -->
        <ul>
        <li class="text-2xl my-2 flex">
                <div class="mr-5 px-5 flex items-center bg-base-200 rounded-full p-2 shadow-3xl">
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <div>
                    <p class="text-base text-slate-400">Email</p>
                    <h4>{{ $user->email }}</h4>
                </div>
            </li>
            <li class="text-2xl my-2 flex">
                <div class="mr-5 px-5 flex items-center bg-base-200 rounded-full p-2 shadow-3xl">
                    <i class="fa-regular fa-building"></i>
                </div>
                <div>
                    <p class="text-base text-slate-400">Company</p>
                    <h4>{{ $user->company }}</h4>
                </div>
            </li>
            <li class="text-2xl my-2 flex">
                <div class="mr-5 px-5 flex items-center bg-base-200 rounded-full p-2 shadow-3xl">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div>
                    <p class="text-base text-slate-400">Role</p>
                    <h4>{{ $user->role == 1 ? "teacher" : "student" }}</h4>
                </div>
            </li>
            <li class="text-2xl my-2 flex">
                <div class="mr-5 px-5 flex items-center bg-base-200 rounded-full p-2 shadow-3xl">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div>
                    <p class="text-base text-slate-400">Join date</p>
                    <h4>{{ substr($user->created_at, 0, 10) }}</h4>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection