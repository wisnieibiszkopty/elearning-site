<div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label> 
    <aside class="bg-base-100 min-h-screen w-80">
        <ul class="menu bg-base-200 w-56 rounded-box mx-5">
            <li><a href="/courses" class="group">
                <span><i class="fa-solid fa-chalkboard-user"></i></span>
                <span>Courses</span>
            </a></li>
            <li><a href="/user/{{ auth()->id() }}" class="group">
                <span><i class="fa-regular fa-user"></i></span>
                <span>Profile</span>
            </a></li>
            <li><a href="" class="group">
                <span><i class="fa-regular fa-comment"></i></span>
                <span>Chats</span>
            </a></li>
        </ul>
    </aside>
</div>