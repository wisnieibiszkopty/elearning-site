<div class="flex my-5 post">
    <div class="avatar">
        <div class="w-12 rounded-full">
            <img class="avatar" src="{{ $post->avatarPath ? asset('storage/' . $post->avatarPath) : asset('images/avatar-placeholder.jpg') }}" alt="User profile picture">
        </div>
    </div>  
    <div>
        <a href="/user/{{$post->author_id}}"><p>{{$post->name}}</a> | {{ $post->created_at}}</p>
        <p>{{ $post->content }}</p>
    </div>
    <!-- manage post -->
    @if($post->author_id == auth()->id() || $courseAuthor == auth()->id())
    <div class="dropdown">
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
                    <h3>Edit post</h3>
                    <form method="POST" action="/course/{{$courseId}}/posts/{{$post->id}}">
                        @method('put')
                        @csrf
                        <textarea class="textarea textarea-bordered" name="content">{{$post->content}}</textarea>
                        <button class="btn btn-primary">Edit</button>
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
    @endif
</div>
<!-- add comment -> i need to change this html beacuse it looks terrible -->
<details class="collapse">
    <summary class="collapse-title"><a class="link link-secondary">Reply</a></summary>
    <div class="collapse-content">
        <form method="POST" action="/course/{{$courseId}}/posts/{{$post->id}}/comments/create">
            @csrf
            <textarea class="textarea textarea-bordered" name="comment"></textarea>
            <button>Comment</button>
        </form>
    </div>
</details>