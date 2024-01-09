@extends('main')

@section('title', 'Create course')

@section('main')
    <div class="card bg-base-200">
        <div class="card-body flex items-center">
            <div class="card-title">Create new course!</div>
            <form method="POST" action="/course" class="flex flex-col md:w-1/3">
                @csrf
                <input type="text" placeholder="Title" name="title" value="{{old('title')}}" class="input input-bordered w-full max-w-xs my-1" autocomplete="off">
                @error('title')
                <x-error :message="$message"></x-error>
                @enderror
                <textarea class="textarea textarea-primary my-1" placeholder="Enter description..." name="description" rows="5" cols="10" autocomplete="off">{{old('description')}}</textarea>
                @error('description')
                <x-error :message="$message"></x-error>
                @enderror
                <input type="text" placeholder="Course code" name="code" value="{{old('code')}}" class="input input-bordered w-full max-w-xs my-1" autocomplete="=off">
                @error('code')
                <x-error :message="$message"></x-error>
                @enderror
                <button class="btn btn-secondary w-3/5 my-1">Create course!</button>
            </form>
        </div>
    </div>
@endsection
