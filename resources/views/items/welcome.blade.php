{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QK Hardware Store</title>
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
                        <a href="{{ url('redirect') }}" style="color:white"
                            class="font-semibold text-black-600 hover:text-dark-900 dark:text-dark-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
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
                <a style="color: black;" href="{{ route('backadmin') }}" class="d-block" style="color: white;">Toggle Admin
                    Mode</a>
            @endif
        @endauth
        @foreach ($categories as $category)
            <a style="color:black; margin-right:20px"
                href="{{ route('category', $category->id) }}">{{ $category->cat_name }} </a>
        @endforeach
    </nav>

    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" style="display:inline-block">x</button>
            {{ session()->get('message') }}
        </div>
    @endif --}}
{{-- @if (Route::has('login'))
            <div class="navbar navbar-expand-lg" style="background-color:#A52A2A">
                <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                    <img src="/images/SQUARELOGO.png" width="40" height="40" alt="">
                    {{ 'QK Hardware Store' }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <form action="{{ route('search') }}" method="get">
                            <input type="text" name="q" placeholder="Search items...">
                            <button type="submit" style="background-color: #F0E68C">Search</button>
                        </form>
                    </ul>
                </div>
                @auth
                    @if (Auth::user()->usertype == 'Admin')
                        <a style="color: black;" href="{{ route('backadmin') }}" class="d-block"
                            style="color: white;">Toggle Admin Mode</a>
                    @endif
                @endauth
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('redirect') }}" style="color:white"
                            class="font-semibold text-black-600 hover:text-dark-900 dark:text-dark-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            </div><br>
        @endif --}}
{{-- <div class="flex justify-center">
                    <img src="/images/SQUARELOGO.png" alt=""width="80px" height="80px" class="img"
                        style="opacity: .8">
                </div>
                <p class="card-text" style="text-align:center; font-size: 30px;">
                    {{ __('Welcome to QK Hardware Store! Browse our products!') }}
                </p> --}}
{{-- <div
                class="container d-flex align-items-center justify-content-center"style="font-size: 18px; background-color: #A52A2A; display: flex; justify-content: center; height: 50px">

                <form action="{{ route('search') }}" method="get">
                    <input type="text" name="q" placeholder="Search items...">
                    <button type="submit" style="background-color: #F0E68C">Search</button>
                </form>
            </div> --}}
{{-- @if ($items->count())
                    <ul>
                        @foreach ($items as $item)
                            <li>{{ $item->item_name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No results found.</p>
                @endif --}}
{{-- <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
            <div class="container" style="background-color: #A52A2A">
                @foreach ($categories as $category)
                    <a class="btn btn" style="background-color:#000; color:#e5e7eb"
                        href="{{ route('category', $category->id) }}">{{ $category->cat_name }} </a>
                @endforeach
                </li>
            </div>
        </nav> --}}

{{-- <div class="card">
                    <div class="gallery">
                        <div class="box">
                            <img src="/images/pic1.jpg" alt="">
                        </div>
                        <div class="box">
                            <img src="/images/pic2.jpg" alt="">
                        </div>
                        <div class="box">
                            <img src="/images/pic3.jpg" alt="">
                        </div>
                    </div>
                </div> --}}
@extends('layouts.main-navbar')
@section('nav-categories')
    <nav class="navbar navbar-expand-lg" style="background-color: white">
        @foreach ($categories as $category)
            <a style="color:black; margin-right:30px; text-transform:uppercase" href="{{ route('category', $category->id) }}">{{ $category->cat_name }}
            </a>
        @endforeach
    </nav><br>
@endsection
@section('content')
    <div class="container">
        @foreach ($items as $item)
            <div class="row justify-content-center mb-3">
                <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface"
                                        style="display: flex; justify-content:center">
                                        <img src="{{ $item->media[0]->original_url }}" class="card-img-top"
                                            style="min-height:100px; min-width:100px; max-height: 400px; max-width: 400px; object-fit:cover">
                                        <a href="#!">
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5>{{ $item->item_name }}</h5>
                                    <div class="mt-1 mb-0 text-muted small">
                                        <span>{{ $item->category->cat_name }}</span>
                                        <span class="text-primary"> • </span>
                                        <span>{{ $item->description }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <h4 class="mb-1 me-1">₱ {{ $item->sellprice }}</h4>
                                    </div>
                                    <div class="d-flex flex-column mt-4">
                                        {{-- <button class="btn btn-primary btn-sm" type="button">Details</button> --}}
                                        {{-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                                        Add to wishlist
                                    </button> --}}
                                        <div class="clearfix">
                                            <form id="my-form" method="POST"
                                                action="{{ route('addcart', ['id' => $item->id]) }}">
                                                @csrf
                                                <button class="btn btn-outline-primary btn-sm btn-block" type="submit"
                                                    role="button">
                                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                                </button>
                                            </form>
                                            <script>
                                                var isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
                                                var link = document.getElementById('my-form');

                                                if (isAuthenticated) {
                                                    link.href = '{{ route('addcart', ['id' => $item->id]) }}';
                                                } else {
                                                    link.href = '{{ route('login') }}';
                                                }

                                                $.get('/check-availability/{{ $item->id }}', function(response) {
                                                    if (response.available == false) {
                                                        link.querySelector('button').disabled = true;
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center" style="margin-top:20px">
        {{ $items->links() }}
    </div>
@endsection
{{-- <div class="row">
            @foreach ($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">

                            <div class="thumbnail">
                                <img src="{{ asset($item->img_path) }}" class="card-img-top" alt="">

                                <div class="caption">
                                    <h3 class="card-title">{{ $item->item_name }}
                                    </h3>
                                    <p class="card-text">P{{ $item->sellprice }}</p>

                                    <p class="card-text">{{ $item->cat_name }}</p>
                                    <p class="card-text">{{ $item->description }}</p>
                                    <div class="clearfix">
                                        <form id="my-form" method="POST"
                                            action="{{ route('addcart', ['id' => $item->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" role="button">
                                                <i class="fas fa-cart-plus"></i> Add to Cart
                                            </button>
                                        </form>
                                        <script>
                                            var isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
                                            var link = document.getElementById('my-form');

                                            if (isAuthenticated) {
                                                link.href = '{{ route('addcart', ['id' => $item->id]) }}';
                                            } else {
                                                link.href = '{{ route('login') }}';
                                            }

                                            $.get('/check-availability/{{ $item->id }}', function(response) {
                                                if (response.available == false) {
                                                    link.querySelector('button').disabled = true;
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

{{-- <script>
        src = "https://code.jquery-1.12.4.min.js" >
    </script>
    <script>
        src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

{{-- </html> --}}
