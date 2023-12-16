@extends('master')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center h-screen">
    <div class="card bg-base-100 shadow-xl max-w-xs sm:max-w-full" >
        <div class="card-body">
            <h1 class="card-title">Login</h1>
            <form method="POST" action="/auth/login">
                @csrf
                <input type="text" name="email" id="email" placeholder="E-mail"
                       class="input input-bordered w-full my-3">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password"
                       class="input input-bordered w-full my-3">
                <p>New here? <a href="/register" class="link link-primary">Click here to create account</a></p>
                <div class="form-control inline-block">
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="remember" class="checkbox">
                        <span class="label-text ml-2">Remember me</span>
                    </label>
                </div>
                <div class="card-actions justify-end">
                    <button class="btn btn-secondary my-3 px-10">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
