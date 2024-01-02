<div class="flex items-center space-x-4 w-full justify-between my-5">
    <div>
        <div class="flex space-x-4">
            <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                    <img class="avatar" src="{{ $post->author->avatarPath ? asset('storage/' . $post->author->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
                </div>
            </div>
            <div>
                <div><a class="link link-secondary" href="/user/{{$post->author_id}}"><p>{{$post->author->name}}</a></div>
                <div><p>@if(!$post->edited){{ $post->created_at}}@else{{$post->updated_at }} (edited)@endif</p></div>
            </div>
        </div>
        <div class="mt-2  ml-3">
            <p>{{$post->content}}</p>
        </div>
        <!-- add comment -> i need to change this html beacuse it looks terrible -->
        <details class="collapse">
            <summary class="collapse-title p-0 ml-3"><a class="link link-secondary">Reply</a></summary>
            <div class="collapse-content">
                <form method="POST" action="/course/{{$courseId}}/posts/{{$post->id}}/comments/create" class="flex flex-col">
                    @csrf
                    <textarea class="textarea textarea-bordered" name="comment" placeholder="Write comment.." cols="35" rows="5"></textarea>
                    <button class="btn btn-secondary w-1/3 mt-5">Comment</button>
                </form>
            </div>
        </details>
        <!-- comments -->
        <div class="ml-10">
            @foreach($post->comments->reverse() as $comment)
                <x-comment :comment="$comment" :courseAuthor="$courseAuthor" :courseId="$courseId" :postId="$post->id"></x-comment>
            @endforeach
        </div>
    </div>
    <!-- manage post -->
    @if($post->author_id == auth()->id() || $courseAuthor == auth()->id())
    <div>
        <div class="dropdown dropdown-end dropdown-bottom">
            <div tabindex="0" role="button"><i class="fa-solid fa-ellipsis"></i></div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                @if($post->author_id == auth()->id())
                @php
                    $id = $post->id;
                    $modal = "edit_modal" . $id . ".showModal()";
                    echo '<li><a onclick="' . $modal . '">Edit</a></li>';
                @endphp
                <dialog id="edit_modal{{$post->id}}" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                        <h3 class="text-2xl mb-10">Edit post</h3>
                        <form method="POST" action="/course/{{$courseId}}/posts/{{$post->id}}" class="flex flex-col">
                            @method('put')
                            @csrf
                            <textarea class="textarea textarea-bordered" name="content" rows="5">{{$post->content}}</textarea>
                            <button class="btn btn-primary mt-10 w-1/4">Edit</button>
                        </form>
                    </div>
                </dialog>
                @endif
                <li style="color:red">
                    <form method="POST" action="/course/{{$courseId}}/posts/{{$post->id}}">
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
