<nav class= "border-b border-border px-6">
    <div class= "max-w-7xl mx-auto h-16 flex items-center justify-between">

        <div>
            <a href="/">
                <img src= "/images/logo.svg" alt= "Idea Logo" width="100">
            </a>

        </div>
        <div class="flex items-center gap-x-5">

            @auth
                <a href="{{ route('profile.edit') }}">Edit profile</a>
                <div class= "flex gap-x-6 items-center">
                    <form action="/signout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"> Sign out </button>
                    </form>
                </div>
            @endauth
            @guest
                <div class= "flex gap-x-6 items-center">
                    <a href="/auth/signin" class="btn btn-secondary"> Sign in </a>
                    <a href="/auth/signup" class="btn"> Sign Up </a>
                </div>
            @endguest
        </div>
    </div>

</nav>
