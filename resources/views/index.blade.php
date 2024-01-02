@extends('master')

@section('title', 'Home')

@section('content')
<div id="blob">

</div>
<div class="hero min-h-screen">
    <div class="hero-content text-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold gradient-text">Welcome to course.io</h1>
            <p class="py-6">Participate in online courses and gather knowledge!</p>
            <a href="/login"><button class="btn btn-secondary">Login</button></a>
            <a href="/register"><button class="btn btn-outline btn-secondary mx-5">Sign up</button></a>
        </div>
    </div>
</div>
<div class="flex flex-col lg:flex-row items-center justify-around my-20">
    <div class="card w-96 bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <h2 class="card-title">Join courses as student</h2>
            <p>Immerse yourself in the world of learning by joining courses on our platform. Browse materials, learn at your own pace, and track your progress. Grow alongside fellow students through interactive tools and diverse educational resources.</p>
            <img src="{{asset('images/svgs/svg4.svg')}}" class="mt-20">
        </div>
    </div>
    <div class="card w-96 bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <h2 class="card-title">Create courses for your students</h2>
            <p>Create compelling courses and share knowledge with students on our platform. Engage learners with interactive content, track their performance, and foster a collaborative learning environment. Inspire the next generation with your expertise.</p>
            <img src="{{asset('images/svgs/svg2.svg')}}" class="mt-20">
        </div>
    </div>
    <div class="card w-96 bg-base-100 shadow-xl my-5 ">
        <div class="card-body">
            <h2 class="card-title">Talk to your friend</h2>
            <p>Connect with fellow users through our chat feature, facilitating real-time communication. Engage in discussions, seek assistance, or collaborate on projects. Enhance your learning experience by interacting with a vibrant community of students and teachers.</p>
            <img src="{{asset('images/svgs/svg3.svg')}}" class="mt-20">
        </div>
    </div>
</div>
<footer class="footer p-10 text-neutral-content flex justify-around">
    <nav>
        <header class="footer-title">Contact us</header>
        <a href="https://github.com/wisnieibiszkopty" target="_blank" class="link link-hover" >Contact</a>
        <a href="https://www.linkedin.com/in/kamil-wodowski-594a61298/" target="_blank" class="link link-hover">Support</a>
        <a href="" class="link link-hover">Media</a>
    </nav>
    <nav>
        <header class="footer-title">About us</header>
        <a href="https://laravel.com" target="_blank" class="link link-hover">Privacy policy</a>
        <a href="https://tailwindcss.com" target="_blank" class="link link-hover">Terms and conditions</a>
        <a href="https://daisyui.com" target="_blank" class="link link-hover">FAQ</a>
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
