<div class="drawer-side" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <aside class="bg-base-100 min-h-screen md:w-60 w-80">
        <ul class="menu bg-base-200 rounded-box mx-5 mg-top"">
            <li><a href="/course" class="group">
                <span><i class="fa-solid fa-chalkboard-user"></i></span>
                <span>Courses</span>
            </a></li>
            <li><a href="/user/{{ auth()->id() }}" class="group">
                <span><i class="fa-regular fa-user"></i></span>
                <span>Profile</span>
            </a></li>
            <li><a href="/chats" class="group">
                <span><i class="fa-regular fa-comment"></i></span>
                <span>Chats</span>
            </a></li>
            <li>
                <form method="POST" action="/auth/logout">
                    @csrf
                    <button>
                        <span><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>
</div>
