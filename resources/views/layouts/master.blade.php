<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2A Farm - Admin</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 ">

    <header>
        @include('layouts.navigation')
    </header>


    <!-- Page Content -->
    <main class="max-w-6xl mx-auto min-h-screen py-6 ">
        @yield('content')
    </main>

    <footer>
        <div class="d-flex flex-column flex-md-row align-items-center justify-between bg-white p-6">

            <a class="navbar-brand" href="https://www.2afarm.ro" target="_blank">
                <img src="{{asset('assets/logo2A.svg')}}"/>
            </a>

            <div>
                  <span class="text-muted fw-bold me-2">
                {{date('Y')}}
              </span>
                <a class="text-gray-800 text-hover-primary" href="https://www.2afarm.ro" target="_blank">
                    &copy; 2A farm
                </a>
            </div>
        </div>
    </footer>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
