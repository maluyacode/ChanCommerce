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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

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
                        <a href="{{ route('shoppingcart', ['id' => auth()->user()->id]) }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <i class="fas fa-shopping-cart" style="margin-left:-30px; color:white"></i>
                            <span class="badge badge-light"
                                style="font-size:12px; margin-right:10px;">{{ $itemCount }}</span>
                            <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                        </a>
                        <a href="{{ route('userprofile', ['id' => auth()->user()->id]) }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            style="color:white; margin-right:10px">
                            <i class="fas fa-person"></i>
                            {{ __('Profile') }}
                        </a>
                        {{-- <a href="{{ url('redirect') }}" style="color:white"
                class="font-semibold text-black-600 hover:text-dark-900 dark:text-dark-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a> --}}
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
                <a style="color: black; margin-right:20px" href="{{ route('backadmin') }}" class="d-block"
                    style="color: white;">Toggle Admin
                    Mode</a>
            @endif
        @endauth
        {{-- @foreach ($categories as $category)
            <a style="color:black; margin-right:20px"
                href="{{ route('category', $category->id) }}">{{ $category->cat_name }} </a>
        @endforeach --}}
        @yield('categories')
    </nav>
</body>
</html>
