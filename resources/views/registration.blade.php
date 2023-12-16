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
                <input type="text" name="name" id="name" placeholder="Name"
                       value="{{old('name')}}" class="input input-bordered w-full my-3">
                @error('name')
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Error! Test error.</span>
                </div>
                @enderror
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Email"
                        value="{{old('email')}}" class="input input-bordered w-full my-3">
                <label for="company"></label>
                <input type="text" name="company" id="company" placeholder="Company"
                        value="{{old('company')}}" class="input input-bordered w-full my-3">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password"
                        value="{{old('password')}}" class="input input-bordered w-full my-3">
                <label for="password_confirmation"></label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password"
                        value="{{old('password_confirmation')}}" class="input input-bordered w-full my-3">
                <div class="form-control inline-block">
                    <label for="student">Student</label>
                    <input type="radio" name="role" value="student" id="student" class="radio radio-primary" checked />
                    <label for="teacher">Teacher</label>
                    <input type="radio" name="role" value="teacher" id="teacher" class="radio radio-primary" />
                </div>
                <p>Already have account? <a href="/login" class="link link-primary">Login here</a></p>
                <div class="card-actions justify-end">
                    <button class="btn btn-secondary my-3 px-10">Sign up</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
