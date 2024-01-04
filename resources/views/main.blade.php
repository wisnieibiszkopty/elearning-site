@extends('master')

@section('content')
<div>
    <div class="bg-base-100 drawer lg:drawer-open height-9/10">
        <input id="drawer" type="checkbox" class="drawer-toggle">
        <div class="drawer-content mx-10 relatve h-screen" style="height: 100vh;">
            <x-navbar></x-navbar>
            <span class="tooltip tooltip-bottom before:text-xs before:content-[attr(data-tip)]" data-tip="Menu"><label aria-label="Open menu" for="drawer" class="btn btn-square btn-ghost drawer-button lg:hidden "><svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current md:h-6 md:w-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></label></span>
            @yield('main')
        </div>
        <x-sidebar></x-sidebar>
        <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    </div>
</div>
@endsection
