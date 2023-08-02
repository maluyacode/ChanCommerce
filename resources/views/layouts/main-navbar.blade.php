<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QK Hardware Store</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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

        .number:after {
            content: attr(value);
            font-size: 12px;
            color: #fff;
            background: red;
            border-radius: 50%;
            padding: 0 5px;
            position: relative;
            left: -8px;
            top: -10px;
            opacity: 0.9;
            font-style: inherit;
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
                        <div class="ui-widget">
                            <input class="form-control" type="text" aria-label="Search" name="search"
                                id="tags">
                            <button class="btn my-2 my-sm-0" type="submit"
                                style="background-color: #F0E68C; margin-left: -10px"><i
                                    class="fas fa-search"></i></button>
                        </div>
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
                                <a class="dropdown-item" href="{{ route('backadmin') }}" class="d-block">
                                    <i class="fa-solid fa-unlock" style="margin-left: 2px; margin-right:27px;"></i>
                                    Admin
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('backadmin') }}" class="d-block">
                                    <i class="fa-solid fa-unlock" style="margin-left: 2px; margin-right:27px;"></i>
                                    CRUD
                                </a>
                            @endif
                            <a href="{{ route('shoppingcart', ['id' => auth()->user()->id]) }}" class="dropdown-item">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="number" data-id="{{ Auth::user()->id }}" id="cart-number"></span>
                                {{ __('Cart') }}
                            </a>
                            <a href="{{ route('userprofile', ['id' => auth()->user()->id]) }}" class="dropdown-item">
                                <i class="fas fa-person" style="margin-left: 5px; margin-right:30px;"></i>
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"
                                        style="margin-left: 5px; margin-right:25px;"></i>
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
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position: fixed; z-index: 1; width: 100%; top: 14%;">
            {!! Session::get('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @yield('content')
    <script src="{{ asset('js/main-navbar.js') }}"></script>
</body>

</html>
