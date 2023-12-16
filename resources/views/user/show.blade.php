@extends('main')

@section('title', 'Profile')

@section('main')
    <div class="avatar">
        <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
            <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
        </div>
    </div>
    
    @if(Auth::id() == $user->id)
    <button class="btn btn-primary">Manage</button>
    <form method="POST" action="/auth/logout">
        @csrf
        <button class="btn btn-secondary">Logout</button>
    </form>
    @else
        <button class="btn btn-primary">Message</button>
    @endif

    <div class="stats shadow">
        <div class="stat place-items-center">
            <div class="stat-title">Name</div>
            <div class="stat-value">{{ $user->name }}</div>
        </div>
        <div class="stat place-items-center">
            <div class="stat-title">Email</div>
            <div class="stat-value">{{ $user->email }}</div>
        </div>
        <div class="stat place-items-center">
            <div class="stat-title">Company</div>
            <div class="stat-value">{{ $user->company }}</div>
        </div>
    </div>
@endsection