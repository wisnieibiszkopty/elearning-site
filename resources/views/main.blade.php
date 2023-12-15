@extends('master')

@section('content')
    <x-navbar></x-navbar>
    @yield('main')
    <x-bottom></x-bottom>
@endsection
