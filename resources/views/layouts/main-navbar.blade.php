<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QK Hardware Store</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .navbar-toggler {
            background-color: #F0E68C;
            color: black;
        }

        @media (min-width: 900px) {
            .dropdown-menu {
                left: -75%;
            }
        }
    </style>
</head>

<body class="antialiased" style="background-color: #F0E68C">
    @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg" style="background-color: #A52A2A">
            <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                <img src="/images/SQUARELOGO.png" width="40" height="40" alt="">
                {{ 'QK Hardware Store' }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <div class="form-inline my-2 my-lg-0" style="padding-right: 20px">
                    <form action="{{ route('search') }}" method="get" style="display: flex; flex-wrap:nowrap">
                        <input class="form-control" type="search" aria-label="Search">
                        <button class="btn my-2 my-sm-0" type="submit"
                            style="background-color: #F0E68C; margin-left: -10px"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                @auth
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if (Auth::user()->usertype == 'Admin')
                                <a class="dropdown-item" href="{{ route('backadmin') }}" class="d-block">Admin Mode</a>
                            @endif
                            <a href="{{ route('shoppingcart', ['id' => auth()->user()->id]) }}" class="dropdown-item">
                                <i class="fas fa-shopping-cart"></i>
                                {{-- <span class="badge badge-light"
                                        style="font-size:12px; margin-right:10px;">{{ $itemCount }}</span> --}}
                                {{ __('Cart') }}
                                <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                            </a>
                            <a href="{{ route('userprofile', ['id' => auth()->user()->id]) }}" class="dropdown-item">
                                <i class="fas fa-person" style="margin-left: 5px;"></i>
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-right-from-bracket" style="margin-left: 5px;"></i>
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                    {{-- <a href="{{ url('redirect') }}" style="color:white"
                    class="font-semibold text-black-600 hover:text-dark-900 dark:text-dark-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a> --}}
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        style="color:white">Log in</a>

                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        style="color:white">Register</a>

                @endauth
            </div>
        </nav>
    @endif

    @yield('nav-categories')
    @yield('content')
    <script src="{{ asset('js/main-navbar.js') }}"></script>
</body>

</html>
