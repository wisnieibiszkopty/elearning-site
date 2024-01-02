<div class="flex items-center space-x-4 w-full justify-between my-5">
    <div>
        <div class="flex space-x-4">
            <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                    <img class="avatar" src="{{ $comment->author->avatarPath ? asset('storage/' . $comment->author->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
                </div>
            </div>
            <div>
                <div><a class="link link-secondary" href="/user/{{$comment->author_id}}"><p>{{$comment->author->name}}</a></div>
                <div><p>@if(!$comment->edited){{ $comment->created_at}}@else{{$comment->updated_at }} (edited)@endif</p></div>
            </div>
        </div>
        <div class="mt-2  ml-3">
            <p>{{$comment->content}}</p>
        </div>
    </div>
    <!-- manage comment -->
    @if($comment->author_id == auth()->id() || $courseAuthor == auth()->id())
        <div>
            <div class="dropdown dropdown-end dropdown-bottom">
                <div tabindex="0" role="button"><i class="fa-solid fa-ellipsis"></i></div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    @if($comment->author_id == auth()->id())
                        @php
                            $id = $comment->id;
                            $modal = "edit_modal" . $id . ".showModal()";
                            echo '<li><a onclick="' . $modal . '">Edit</a></li>';
                        @endphp
                        <dialog id="edit_modal{{$comment->id}}" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-2xl mb-10">Edit comment</h3>
                                <form method="POST" action="/course/{{$courseId}}/comments/{{$comment->id}}" class="flex flex-col">
                                    @method('put')
                                    @csrf
                                    <textarea class="textarea textarea-bordered" name="comment" rows="5">{{$comment->content}}</textarea>
                                    <button class="btn btn-primary mt-10 w-1/4">Edit</button>
                                </form>
                            </div>
                        </dialog>
                    @endif
                    <li style="color:red">
                        <form method="POST" action="/course/{{$courseId}}/posts/{{$postId}}/comments/{{$comment->id}}">
                            @method('delete')
                            @csrf
                            <button>Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
