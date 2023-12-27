@extends('master')

@section('title', 'Home')

@section('content')
<div class="hero min-h-screen">
    <div class="hero-content text-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold">Welcome to course.io</h1>
            <p class="py-6">Participate in online courses and gather knowledge!</p>
            <a href="/login"><button class="btn btn-accent">Login</button></a>
            <a href="/register"><button class="btn btn-outline btn-accent mx-5">Sign up</button></a>
        </div>
    </div>
</div>
<div class="flex flex-col lg:flex-row items-center justify-around my-20">
    <div class="card w-96 bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <h2 class="card-title">Join courses as student</h2>
            <p>If a dog chews shoes whose shoes does he choose?</p>
        </div>
    </div>
    <div class="card w-96 bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <h2 class="card-title">Create courses for your students</h2>
            <p>If a dog chews shoes whose shoes does he choose?</p>
        </div>
    </div>
    <div class="card w-96 bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <h2 class="card-title">Talk to your friend</h2>
            <p>If a dog chews shoes whose shoes does he choose?</p>
        </div>
    </div>
</div>
<footer class="footer p-10 text-neutral-content">
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
<footer class="footer footer-center p-10 text-base-content rounded">
    <nav>
        <div class="grid grid-flow-col gap-4">
            <a href="https://github.com/wisnieibiszkopty" target="_blank"><i class="fa-brands fa-github text-3xl"></i></a>
            <a href="https://www.linkedin.com/in/kamil-wodowski-594a61298/" target="_blank"><i class="fa-brands fa-linkedin text-3xl"></i></a>
            <a></a>
        </div>
    </nav> 
    <aside>
        <p>Copyright © 2023 - Kamil Wodowski</p>
    </aside>
</footer>
@endsection
