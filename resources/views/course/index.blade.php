@extends('main')

@section('title', 'Your courses')

@section('main')
    @if($role == 1)
        <div>
            <a href="/course/create"><button class="btn btn-primary">Add course</button></a>
        </div>
    @else($role == 0)
        <div>

        </div>
    @endif
@endsection
