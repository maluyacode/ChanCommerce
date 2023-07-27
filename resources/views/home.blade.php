@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Admin Dashboard') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text">
                                <p>{{ __('Welcome Admin! You are logged in!') }}</p>
                                <div class="buttons">
                                    <button id="productSold" class="btn btn-light btn-sm ">Product Sales</button>
                                    <button class="btn btn-light btn-sm">Annual Sales</button>
                                    <button class="btn btn-light btn-sm">Monthly Sales</button>
                                    <button id="productStocks" class="btn btn-light btn-sm">Product Stocks</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="/images/HWLogo.png" alt="" class="responsive">
                                <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/home.js') }}" defer></script>
@endsection
