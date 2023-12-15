@extends('master')

@section('title', 'Home')

@section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold">Hello there</h1>
            <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
            <a href="/login"><button class="btn btn-accent">Login</button></a>
            <a href="/register"><button class="btn btn-outline btn-accent">Sign up</button></a>
        </div>
    </div>
</div>
@endsection
