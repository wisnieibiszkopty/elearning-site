@extends('course.show')

@section('title', 'Resoucres')

@section('course')
    <x-course-menu :authorId="$course->author_id" :id="$course->id" active="2"></x-course-menu>
    @if($course->author_id == auth()->id())
    <div class="flex justify-end mr-10 my-5">
        <button class="btn btn-secondary" onclick="resource_modal.showModal()">Add resource</button>
    </div>
    <dialog id="resource_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-xl">Share new file with members of the course</h3>
            <form method="POST" action="/course/{{$course->id}}/resources/create" enctype="multipart/form-data">
                @csrf
                @error('file')
                    <x-error :message="$message"></x-error>
                @enderror
                <input type="file" name="file" required class="file-input file-input-bordered w-full max-w-xs my-2" autocomplete="off">
                @error('name')
                    <x-error :message="$message"></x-error>
                @enderror
                <input type="text" name="name" placeholder="Filename" required min="3" class="input input-bordered w-full max-w-xs my-2">
                <br><button class="btn btn-primary my-2">Add file</button>
            </form>
        </div>
    </dialog>
    @endif
    @if($course->resources->isNotEmpty())
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Uploaded</th>
                    @if(auth()->id() == $course->author_id)
                        <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($course->resources->reverse() as $resource)
                <!-- better option is to store it in db -->
                @php
                    function formatSizeUnits($bytes) {
                       $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                        $bytes = max($bytes, 0);
                        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
                        $pow = min($pow, count($units) - 1);
                        $bytes /= (1 << (10 * $pow));
                        return round($bytes, 2) . ' ' . $units[$pow];
                    }

                    $file = public_path('storage/' . $resource->file_path);
                    $filesize = filesize($file);
                    $formattedSize = formatSizeUnits($filesize);
                @endphp
                <tr class="hover">
                    <td></td>
                    <td><a href="{{ $file }}" download="{{$resource->name}}">{{$resource->name}}</a></td>
                    <td>{{ $formattedSize }}</td>
                    <td><p>{{$resource->created_at}}</p></td>
                    @if(auth()->id() == $course->author_id)
                    <td>
                        <div>
                            <div class="dropdown dropdown-bottom dropdown-end">
                                <div tabindex="0" role="button"><i class="fa-solid fa-ellipsis"></i></div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-52">
                                    @php
                                        $id = $resource->id;
                                        $modal = "edit_modal" . $id . ".showModal()";
                                        echo '<li><a onclick="' . $modal . '">Rename</a></li>';
                                    @endphp
                                    <dialog id="edit_modal{{$resource->id}}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="text-xl mb-3">Enter new name</h3>
                                            <form method="POST" action="/course/{{$course->id}}/resources/{{$resource->id}}">
                                                @method('put')
                                                @csrf
                                                <input type="text" name="name" required min="3" placeholder="New filename" autocomplete="off"
                                                class="input input-bordered w-full max-w-xs mt-2">
                                                <button class="btn btn-primary mt-2">Rename</button>
                                            </form>
                                        </div>
                                    </dialog>
                                    <li>
                                        <form method="POST" action="/course/{{$course->id}}/resources/{{$resource->id}}">
                                            @method('delete')
                                            @csrf
                                            <button>Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <x-empty></x-empty>
    @endif
@endsection
