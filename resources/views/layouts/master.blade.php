<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('css')
</head>
<style>
    .judul{
        margin-top: 2rem;
        margin-left: 2rem;
        font-family: marmelad;
    }
</style>
<body>
    <div class="main d-flex justify-content-between flex-column">
        
        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="button-primary">
                    @if(Auth::user())
                        <h3 class="judul">Digital Library</h3>
                        <hr>
                        @if(Auth::user()->role_id == 1)
                        <a href="/dashboard" class="{{ (request()->is('dashboard') ? 'active' : '') }}">Dashboard</a>
                        <a href="{{ route('books.index') }}"
                            class="{{ (request()->is('books*') ? 'active' : ''); }}">Books</a>
                        <a href="{{ route('category.index') }}"
                            class="{{ (request()->is('categories*') ? 'active' : ''); }}">Categories</a>
                        <a href="{{ route('users.index') }}"
                            class="{{ (request()->is('users*') ? 'active' : '') }}">Users</a>
                        <a href="{{ route('rent_logs.index') }}"
                            class="{{ (request()->is('rent-logs*') ? 'active' : '') }}">Rent Log</a>
                        <a href="/logout">Logout</a>
                        @elseif (Auth::user()->role_id == 2)
                        <a href="/dashboard" class="{{ (request()->is('dashboard') ? 'active' : '') }}">Dashboard</a>
                        <a href="{{ route('books.index') }}"
                            class="{{ (request()->is('books*') ? 'active' : ''); }}">Books</a>
                        <a href="{{ route('category.index') }}"
                            class="{{ (request()->is('categories*') ? 'active' : ''); }}">Categories</a>
                        <a href="{{ route('rent_logs.index') }}"
                            class="{{ (request()->is('rent-logs*') ? 'active' : '') }}">Rent Log</a>
                        <a href="/logout">Logout</a>
                        @else
                            <a href="{{ route('books.buku') }}" class="{{ request()->is('books*') ? 'active' : '' }}">Book</a>
                            <a href="/profile" @if(request()->is('profile*')) class="active" @endif>Profile</a>
                            <a href="/logout">Logout</a>
                        @endif

                    @else
                    <a href="/login">Login</a>
                    @endif
                </div>
                <div class="content p-5 col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    @stack('script')
</body>

</html>