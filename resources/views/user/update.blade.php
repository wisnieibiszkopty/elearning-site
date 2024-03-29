@extends('main')

@section('title', 'Edit profile')

@section('main')
    <div class="card">
        <x-message></x-message>
        <div class="card-body flex items-center">
            <!-- Avatar -->
            <div class="mx-7 md:mx-10">
                <h3 class="text-xl my-3">Change profile picture</h3>
                <form method="POST" action="/user/{{ $user->id }}/avatar" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <input type="file" name="avatar" class="file-input file-input-bordered w-full max-w-xs my-1">
                    <button class="btn btn-outline btn-secondary my-1">Change</button>
                </form>
            </div>
            <div class="flex flex-col md:flex-row md:my-10 my-3">
                <!-- Basic fields -->
                <div class="md:mx-10">
                    <form method="POST" action="/user/{{$user->id}}" autocomplete="off" class="flex flex-col items-center">
                        <h3 class="text-xl my-3">Edit info</h3>
                        @method('put')
                        @csrf
                        <input type="text" value="{{$user->name}}" name="name" class="input input-bordered w-full max-w-xs my-1">
                        @error('name')
                        <x-error :message="$message"></x-error>
                        @enderror
                        <input type="text" value="{{$user->email}}" name="email" class="input input-bordered w-full max-w-xs my-1">
                        @error('email')
                        <x-error :message="$message"></x-error>
                        @enderror
                        <input type="text" value="{{$user->company}}" name="company" class="input input-bordered w-full max-w-xs my-1">
                        @error('company')
                        <x-error :message="$message"></x-error>
                        @enderror
                        <button class="btn btn-outline btn-warning w-full max-w-xs my-1">Update info</button>
                    </form>
                </div>
                <div class="divider lg:divider-horizontal">OR</div>
                <!-- Password -->
                <div class="md:mx-10">
                    <form method="POST" action="/user/{{$user->id}}/password" autocomplete="off" class="flex flex-col items-center">
                        <h3 class="text-xl my-3">Change password</h3>
                        @method('patch')
                        @csrf
                        <input required type="text" placeholder="Old password" name="old-password" class="input input-bordered w-full max-w-xs my-1">
                        @error('old-password')
                        <x-error :message="$message"></x-error>
                        @enderror
                        <input required type="text" placeholder="New password" name="new-password" class="input input-bordered w-full max-w-xs my-1">
                        @error('old-password')
                        <x-error :message="$message"></x-error>
                        @enderror
                        <input required type="text" placeholder="Confirm password" name="new-password_confirmation" class="input input-bordered w-full max-w-xs my-1">
                        @error('old-password')
                        <x-error :message="$message"></x-error>
                        @enderror
                        <button class="btn btn-outline btn-info w-full max-w-xs my-1">Update password</button>
                    </form>
                </div>
            </div>
            <!-- Spotify options -->
            <div>
                <h3 class="text-xl my-3">Spotify</h3>
                <form method="POST" action="/user/player">
                    @csrf
                    <div class="flex my-4 space-x-4 items-center">
                        <p>Enable large spotify player</p>
                        <input type="checkbox" name="large-player" class="toggle toggle-success"
                            {{ $user->large_player ? "checked" : ""}}>
                    </div>
                    <button class="btn btn-outline btn-success">Update</button>
                </form>
            </div>
            <!-- Delete account -->
            <div class="mx-7 md:mx-10">
                <h3 class="text-xl my-3">Delete account</h3>
                <button class="btn btn-outline btn-error" onclick="delete_modal.showModal()">Delete account</button>
            </div>
            <dialog id="delete_modal" class="modal">
                <div class="modal-box">
                    <h3 class="text-xl">Are you sure you want to delete account?</h3>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn">Cancel</button>
                        </form>
                        <form method="POST" action="/user/{{ $user->id }}">
                            @method('delete')
                            @csrf
                            <button class="btn btn-outline btn-error">Delete</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
    </div>
@endsection
