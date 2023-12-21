@extends('main')

@section('title', 'Edit profile')

<!-- 
    Make some styles for headings and separating parts of site
    Make sure that all error messages work
-->

@section('main')
<!-- Avatar -->
    <h3>Change profile picture</h3>
    <form method="POST" action="/user/{{ $user->id }}/avatar" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <input type="file" name="avatar" class="file-input file-input-bordered w-full max-w-xs">
        <button class="btn btn-secondary">Change</button>
    </form>
<!-- Basic fields -->
    <h3>Edit info</h3>
    <form method="POST" action="/user/{{$user->id}}" autocomplete="off">
        @method('put')
        @csrf
        <input type="text" value="{{$user->name}}" name="name" class="input input-bordered w-full max-w-xs">
        <input type="text" value="{{$user->email}}" name="email" class="input input-bordered w-full max-w-xs">
        <input type="text" value="{{$user->company}}" name="company" class="input input-bordered w-full max-w-xs">
        <button class="btn btn-outline btn-warning">Update info</button>
    </form>
<!-- Password -->
    <h3>Change password</h3>
    <form method="POST" action="/user/{{$user->id}}/password" autocomplete="off">
        @method('patch')
        @csrf
        <input type="text" placeholder="Old password" name="old-password" class="input input-bordered w-full max-w-xs">
        <input type="text" placeholder="New password" name="new-password" class="input input-bordered w-full max-w-xs">
        <input type="text" placeholder="Confirm password" name="new-password_confirmation" class="input input-bordered w-full max-w-xs">
        <button class="btn btn-outline btn-info">Update password</button>
    </form>
<!-- Delete account -->
    <h3>Delete account</h3>
    <button class="btn btn-outline btn-error" onclick="delete_modal.showModal()">Delete account</button>
    <dialog id="delete_modal" class="modal">
        <div class="modal-box">
            <h3>Are you sure you want to delete account?</h3>
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
@endsection