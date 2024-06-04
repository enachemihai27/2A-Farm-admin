<nav class="navbar navbar-light bg-light ">
    <div class="container-fluid ">
        <a href="{{route('dashboard')}}" class="navbar-brand"><img src="{{asset('assets/logo2A.svg')}}" /></a>


        @if (Route::has('login'))
            <nav class="mx-3 d-flex justify-content-center align-items-center">
                @auth
                    <div class="items-center">



             {{--           <a class="text-decoration-none rounded-md px-3 py-2 text-black ring-1 ring-transparent
                            transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]
                            dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white" href="{{route('profile.edit')}}">Profile</a>--}}

                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('dashboard')}}">
                            ACASA
                        </a>
                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('client.privateIndex')}}">CONTACT</a>
                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('numbers.privateIndex')}}">NUMERE</a>
                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('jobs.privateIndex')}}">CARIERA</a>
                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('events.privateIndex')}}">EVENIMENTE</a>
                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('persons.privateIndex')}}">REPREZENTANTI</a>
                        <a class="text-decoration-none text-black hover:text-gray-500 text-sm mx-2" href="{{route('partners.privateIndex')}}">PARTENERI</a>
                    </div>
                    <div>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn-sm btn-danger ml-2">Logout</button>
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
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif


    </div>
</nav>
