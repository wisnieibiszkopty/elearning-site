<div role="tablist" class="tabs tabs-lifted">
    <a href="/course/{{$id}}" role="tab" class="tab {{ $active == 1 ? 'tab-active' : '' }}">Posts</a>
    <a href="/course/{{$id}}/resources" role="tab" class="tab {{ $active == 2 ? 'tab-active' : '' }}">Resources</a>
    <a href="/course/{{$id}}/homework" role="tab" class="tab {{ $active == 3 ? 'tab-active' : '' }}">Homework</a>
    @if(auth()->id() == $authorId)
        <a href="/course/{{$id}}/edit" role="tab" class="tab {{ $active == 4 ? 'tab-active' : '' }}">Settings</a>
    @endif
</div>