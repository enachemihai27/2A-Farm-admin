<nav class="navbar navbar-light bg-light ">
    <div class="container-fluid ">
        <a href="{{route('dashboard')}}" class="navbar-brand">Navbar</a>


        @if (Route::has('login'))
            <nav class="mx-3 d-flex justify-content-center align-items-center">
                @auth
                    <div class="items-center">
                        <a
                            href="{{route('dashboard')}}"
                            class="text-decoration-none rounded-md px-3 py-2 text-black ring-1 ring-transparent
                            transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]
                            dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                        </a>


                        <a class="text-decoration-none rounded-md px-3 py-2 text-black ring-1 ring-transparent
                            transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]
                            dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white" href="{{route('profile.edit')}}">Profile</a>

                        <a class="text-decoration-none btn-sm btn-info mx-1" href="{{route('client.index')}}">Client</a>
                        <a class="text-decoration-none btn-sm btn-info mx-1" href="{{route('numbers.index')}}">Client
                            numbers</a>
                        <a class="text-decoration-none btn-sm btn-info mx-1" href="{{route('jobs.index')}}">Jobs</a>
                        <a class=" text-decoration-none btn-sm btn-info mx-1"
                           href="{{route('events.index')}}">Events</a>
                    </div>
                    <div>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn-sm btn-primary">Logout</button>
                        </form>
                    </div>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif


    </div>
</nav>
