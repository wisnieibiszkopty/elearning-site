@extends('master')

@section('title', 'Registration')

@section('content')
<div class="flex items-center justify-center h-screen" style="height: 120vh">
    <div class="card bg-base-100 shadow-xl max-w-md">
        <div class="card-body">
            <h1 class="card-title">Register</h1>
            <form method="POST" action='/auth/register'>
                @csrf
                <label for="name"></label>
                <input type="text" name="name" required min="6" max="32" placeholder="Name"
                       value="{{old('name')}}" 
                       class="input input-bordered w-full my-3 @error('name') is-invalid @enderror">
                @error('name')
                    <x-error :message="$message"></x-error>
                @enderror
                <label for="email"></label>
                <input type="email" name="email" placeholder="Email"
                        value="{{old('email')}}" 
                        class="input input-bordered w-full my-3 @error('email') is-invalid @enderror">
                @error('email')
                    <x-error :message="$message"></x-error>
                @enderror
                <label for="company"></label>
                <input type="text" name="company" placeholder="Company"
                        value="{{old('company')}}" 
                        class="input input-bordered w-full my-3 @error('company') is-invalid @enderror">
                @error('company')
                    <x-error :message="$message"></x-error>
                @enderror
                <label for="password"></label>
                <input type="password" name="password" placeholder="Password"
                        value="{{old('password')}}" 
                        class="input input-bordered w-full my-3 @error('password') is-invalid @enderror">
                @error('password')
                    <x-error :message="$message"></x-error>
                @enderror
                <label for="password_confirmation"></label>
                <input type="password" name="password_confirmation" placeholder="Repeat password"
                        value="{{old('password_confirmation')}}" 
                        class="input input-bordered w-full my-3 @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <x-error :message="$message"></x-error>
                @enderror
                <div class="form-control inline-block">
                    <label for="student" class="align-middle">Student</label>
                    <input type="radio" name="role" value="student" class="radio radio-primary align-middle" checked>
                    <label for="teacher" class="align-middle">Teacher</label>
                    <input type="radio" name="role" value="teacher" class="radio radio-primary align-middle">
                </div>
                <br><br>
                <p>Already have account? <a href="/login" class="link link-primary">Login here</a></p>
                <div class="card-actions justify-end">
                    <button class="btn btn-secondary my-3 px-10">Sign up</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
