@foreach($messages as $message)
    @php
        $isAuthor = $message->chat_member_id == auth()->id()
    @endphp
    <div id="message_{{$message->id}}" class="chat {{$isAuthor ? 'chat-end' : 'chat-start' }} group relative">
        <div class="chat-bubble {{$isAuthor ? 'chat-bubble-secondary':''}}">{{$message->message}}</div>
        @if($isAuthor)
            <div class="dropdown dropdown-bottom dropdown-end">
                <div tabindex="0" role="button" class="m-1 mb-3 invisible group-hover:visible"><i class="fa-solid fa-ellipsis"></i></div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    @php
                        $id = $message->id;
                        $modal = "edit_modal" . $id . ".showModal()";
                        echo '<li><a onclick="' . $modal . '">Edit</a></li>';
                    @endphp
                    <dialog id="edit_modal{{$message->id}}" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="text-2xl mb-10">Edit message</h3>
                            <div class="flex flex-col">
                                <textarea id="textarea_{{$message->id}}" class="textarea textarea-bordered" name="message" rows="5">{{$message->message}}</textarea>
                                <button class="btn btn-primary mt-10 w-1/4" onclick="editMessage({{$message->id}})">Edit</button>
                            </div>
                        </div>
                    </dialog>
                    <li>
                        <button style="color:red;" onclick="deleteMessage({{$message->id}})">Delete</button>
                    </li>
                </ul>
            </div>
        @endif
    </div>
@endforeach
