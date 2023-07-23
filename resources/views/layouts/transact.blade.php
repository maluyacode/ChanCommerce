<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QK Hardware Store</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-e06GcLQw98u2PjItJSav8mx2ZCJ9soMG+sEZp5j5d5YY5yJ0rLlYBkbTRvE/L/bN+pt1BZz+LZCp5j+vd5/gJw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <div class="sm:fixed sm:top-0 sm:left-0 p-6 text-left">
            <a class="font-semibold text-black-600 hover:text-dark-900 dark:text-dark-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                href="{{ url('/redirect') }}">
                {{ 'QK Hardware Store' }}

            </a>
            <strong>
                @if (Auth::user()->usertype == 'Admin')
                    <a style="color: black;" href="{{ route('backadmin') }}" class="d-block"
                        style="color: white;">Toggle Admin Mode</a>
                @endif
            </strong>
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @if (Auth::check())
                    <a href="{{ route('userprofile', ['id' => auth()->user()->id]) }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <br>
                    <a href="{{ route('shoppingcart', ['id' => auth()->user()->id]) }}" type="button"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart <span
                            class="badge badge-primary rounded-pill"
                            style="font-size:12px; justify-content:center">{{ $itemCount }}</span>
                        <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                @else
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>
                @endif
            </div>
        </div> --}}

<body class="antialiased" style="background-color: #F0E68C">
    @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg" style="background-color: #A52A2A">
            <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                <img src="/images/SQUARELOGO.png" width="40" height="40" alt="">
                {{ 'QK Hardware Store' }}
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <div class="form-inline my-2 my-lg-0">
                    <form action="{{ route('search') }}" method="get">
                        <input class="form-control mr-sm-2" type="search" aria-label="Search" style="width: 1000px;">
                        <button class="btn my-2 my-sm-0" type="submit"
                            style="background-color: #F0E68C;
                            margin-right:50px; margin-left:-20px"><i
                                class="fas fa-search"></i></button>
                    </form>
                    @auth
                        <a href="{{ url('redirect') }}"
                            class="font-semibold text-black-600 hover:text-dark-900 dark:text-dark-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            style="color:white">Home</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            style="color:white">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                style="color:white">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>
    @endif

    <nav class="navbar navbar-expand-lg" style="background-color: white">
        @auth
            @if (Auth::user()->usertype == 'Admin')
                <a style="color: black; margin-right:20px"
                    href="{{ route('backadmin') }}" class="d-block" style="color: white;">Toggle Admin
                    Mode</a>
            @endif
        @endauth
        @foreach ($categories as $category)
            <a style="color:black; margin-right:20px"
                href="{{ route('category', $category->id) }}">{{ $category->cat_name }} </a>
        @endforeach
    </nav>

    @if (Session::has('message'))
        <div class="alert alert-success">
            {!! Session::get('message') !!}
        </div>
    @endif
    <br>
    @yield('content')
</body>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</html>
