@extends('master')

@section('title', 'Not found')

@section('content')
<div class="hero min-h-screen">
    <div class="hero-content flex flex-col">
        <img src="{{ asset('/images/svgs/empty-page.svg') }}" alt="Empty page" class="w-2/3">
        <h1 class="text-4xl">404 Page not found</h1>
        <a  @auth href="/course" @else href="/" @endauth><button class="btn btn-primary">Home</button></a>
    </div>
</div>
@endsection
