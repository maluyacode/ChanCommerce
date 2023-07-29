@extends('layouts.main-navbar')
@section('nav-categories')
    <nav class="navbar navbar-expand-lg" style="background-color: white">
        @foreach ($categories as $category)
            <a style="color:black; margin-right:20px" href="{{ route('category', $category->id) }}">{{ $category->cat_name }}
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
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{ asset($item->img_path) }}" class="card-img-top" alt="">
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
                                        <span>{{ $item->cat_name }}</span>
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
@endsection
