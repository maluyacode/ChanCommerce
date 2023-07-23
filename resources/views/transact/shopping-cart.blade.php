@extends('layouts.transact')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success">
            {!! Session::get('message') !!}
        </div>
    @endif
    @if (Auth::id())
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: white">
                            <div class="card-body" style="border:3px solid #000000; padding:3px; margin:2px">
                                <table class="table">
                                    <thead>

                                        <th style="font-size: 17px">Item Image</th>
                                        <th style="font-size: 17px;">Item Name</th>
                                        <th style="font-size: 17px;">Quantity</th>
                                        <th style="font-size: 17px;">Item Price</th>
                                        <link rel="stylesheet"
                                            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                                        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css"
                                            rel="stylesheet">
                                        <link rel="stylesheet" href="{{ url('src/css/app.css') }}">
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $carts)
                                            <tr>

                                                <td><img src="{{ asset($carts->img_path) }}" alt="" width="80px"
                                                        height="80px"
                                                        style="border:3px solid #000000; padding:3px; margin:2px"></td>
                                                <td><strong><span
                                                            style="font-size: 17px; justify-content: center">{{ $carts->item_name }}</span></strong>
                                                </td>
                                                <td><span class="badge badge-primary rounded-pill"
                                                        style="font-size: 17px">{{ $carts->quantityC }}</span></td>

                                                <td><span class="label label-success"
                                                        style="font-size: 17px;">{{ $carts->sellprice }}</span></td>
                                                <td class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle"
                                                        data-toggle="dropdown">Action <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('increment', ['id' => $carts->item_id]) }}">Add
                                                                Quantity
                                                            </a></li>
                                                        <li><a href="{{ route('decrement', ['id' => $carts->item_id]) }}">Reduce
                                                                Quantity</a></li>
                                                        <li><a href="{{ route('delete', ['id' => $carts->item_id]) }}">Reduce
                                                                All</a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </ul>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-2 text-center"
                style="background-color: white; border:3px solid #000000; font-size: 18px ">
                <br>
                <strong>Total: {{ $totalprice }}</strong>
            </div>
        </div>
        <hr>
        <form method="POST" action="{{ route('checkout', ['id' => $user]) }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group row">
                        <label for="pmethod_id">Payment Method</label>
                        <select class="form-select form-control" name="pmethod_id" id="pmethod_id">
                            <option selected>Select Payment Method</option>
                            @foreach ($pmethod as $pm)
                                <option value={{ $pm->id }}>{{ $pm->Methods }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group row" style="align:center">
                        <label for="country">Shipping Via</label>
                        <select class="form-select form-control" name="shipper_id" id="shipper_id">
                            <option selected>Select Shipper</option>
                            @foreach ($shipper as $ship)
                                <option value={{ $ship->id }}>{{ $ship->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 text-right" style="font-size: 20px">
                    <button type="submit" class="btn btn-success" id="checkout-button"
                        style="border:3px solid #000000; padding:3px; margin:2px">Checkout</button>
                </div>

            </div>
        </form>
        {{-- <script>
            // Get references to the payment method and shipper select elements
            const pmethodSelect = document.getElementById('pmethod_id');
            const shipperSelect = document.getElementById('shiper_id');

            // Get a reference to the checkout button element
            const checkoutButton = document.getElementById('checkout-button');

            // Attach an event listener to the payment method and shipper select elements
            pmethodSelect.addEventListener('change', updateCheckoutButton);
            shipperSelect.addEventListener('change', updateCheckoutButton);

            // Function to update the href of the checkout button with the selected payment method and shipper
            function updateCheckoutButton() {
                const pmethodId = pmethodSelect.value;
                const shipperId = shipperSelect.value;
                const checkoutUrl = `{{ route('checkout') }}?pm_id=${pmethodId}&ship_id=${shipperId}`;
                checkoutButton.href = checkoutUrl;
            }
        </script> --}}
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Items in Cart!</h2>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
