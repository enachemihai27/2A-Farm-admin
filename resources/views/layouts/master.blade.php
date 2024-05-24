<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-light bg-light ">
    <div class="container-fluid ">
        <a href="{{route('dashboard')}}" class="navbar-brand">Navbar</a>


        @if (Route::has('login'))
            <nav class="mx-3 d-flex justify-content-center align-items-center">
                @auth
                    <div class="items-center">
                        <a
                            href="{{route('dashboard')}}"
                            class="text-decoration-none rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>

                            <a class="text-decoration-none btn-sm btn-info mx-1" href="{{route('client.index')}}">Client</a>
                            <a class="text-decoration-none btn-sm btn-info mx-1" href="{{route('numbers.index')}}">Client numbers</a>
                            <a class="text-decoration-none btn-sm btn-info mx-1" href="{{route('jobs.index')}}">Jobs</a>
                            <a class=" text-decoration-none btn-sm btn-info mx-1" href="{{route('events.index')}}">Events</a>
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

<div class="container">
    @yield('content')
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
