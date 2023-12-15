@extends('master')

@section('title', 'Registration')

@section('content')
<div class="flex items-center justify-center h-screen" style="height: 120vh">
    <div class="card bg-base-100 shadow-xl max-w-md">
        <div class="card-body">
            <h1 class="card-title">Register</h1>
            <form>
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Name"
                       class="input input-bordered w-full my-3">
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Email"
                       class="input input-bordered w-full my-3">
                <label for="company"></label>
                <input type="text" name="company" id="company" placeholder="Company"
                       class="input input-bordered w-full my-3">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password"
                       class="input input-bordered w-full my-3">
                <label for="password_confirmation"></label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password"
                       class="input input-bordered w-full my-3">
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
