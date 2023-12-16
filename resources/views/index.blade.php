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
<footer class="footer p-10 bg-base-200 text-neutral-content">
    <nav>
        <header class="footer-title">Contact us</header>
        <a href="https://github.com/wisnieibiszkopty" target="_blank" class="link link-hover" >Github</a>
        <a href="https://www.linkedin.com/in/kamil-wodowski-594a61298/" target="_blank" class="link link-hover">Linkedin</a>
        <a href="" class="link link-hover">Onlyfans</a>
    </nav>
    <nav>
        <header class="footer-title">Technologies</header>
        <a href="https://laravel.com" target="_blank" class="link link-hover">Laravel</a>
        <a href="https://tailwindcss.com" target="_blank" class="link link-hover">Tailwind</a>
        <a href="https://daisyui.com" target="_blank" class="link link-hover">Daisy UI</a>
    </nav>
</footer>
@endsection
