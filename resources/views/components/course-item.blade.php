<div class="card bg-base-100 shadow-xl m-5 ">
    <div class="card-body">
        <div>
            <div class="flex items-center space-x-4 mb-4">
                <div class="avatar">
                    <div class="w-12 rounded-xl">
                        <img src="{{ $course->imagePath ? asset('storage/' . $course->imagePath) : asset('images/no-image.jpg')}}" alt="{{$course->name}}">
                    </div>
                </div>
                <div>
                    <a href="/course/{{$course->id}}"><h2 class="text-lg">{{$course->title}}</h2></a>
                </div>
                <div>
                    <div class="dropdown dropdown-bottom dropdown-end">
                        <div tabindex="0" role="button"><i class="fa-solid fa-ellipsis"></i></div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            @if(auth()->id() == $course->author_id)
                                <li class="is-invalid">
                                    <a href="/course/{{$course->id}}/edit">Delete course</a>
                                </li>
                            @else()
                                <li class="is-invalid">
                                    <form method="POST" action="/course/{{$course->id}}/leave">
                                        @method('delete')
                                        @csrf
                                        <button>Exit course</button>
                                    </form> 
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <span><i class="fa-solid fa-user"></i></span>
                    <span>{{$course->author->name}}</span>
                </div>
                <div>
                    <span><i class="fa-solid fa-users"></i></span>
                    <span>{{count($course->members)}}</span>
                </div>
            </div>
        </div>  
    </div>
</div>