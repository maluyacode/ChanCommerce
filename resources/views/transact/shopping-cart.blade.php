@extends('layouts.main-navbar')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" style="display:inline-block">x</button>
            {{ session()->get('message') }}
        </div>
    @endif
    @if (Auth::id())
        <div class="container-fluid" style="padding-top: 50px;">
            <div class="text-center">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-4" style="width:1000px">
                            {{-- <div class="card-body text-center">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                      <h5 class="my-3">John Smith</h5>
                      <p class="text-muted mb-1">Full Stack Developer</p>
                      <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                      <div class="d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-primary">Follow</button>
                        <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                      </div>
                    </div> --}}
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" style="font-size: 17px">Item Image</th>
                                        <th scope="col" style="font-size: 17px;">Item Name</th>
                                        <th scope="col" style="font-size: 17px;">Quantity</th>
                                        <th scope="col" style="font-size: 17px;">Item Price</th>
                                        <th scope="col" style="font-size: 17px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $carts)
                                        <tr>
                                            <td><img src="{{ asset($carts->img_path) }}" alt="" width="80px"
                                                    height="80px" style="border:3px solid #000000;"></td>
                                            <td><strong><span
                                                        style="font-size: 17px; justify-content: center">{{ $carts->item_name }}</span></strong>
                                            </td>
                                            <td><span class="badge badge-primary rounded-pill"
                                                    style="font-size: 17px">{{ $carts->quantityC }}</span></td>

                                            <td><span class="label label-success"
                                                    style="font-size: 17px;">{{ $carts->sellprice }}</span></td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action <span class="caret"></span>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('increment', ['id' => $carts->item_id]) }}">Add
                                                            Quantity</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('decrement', ['id' => $carts->item_id]) }}">Reduce
                                                            Quantity</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('delete', ['id' => $carts->item_id]) }}">Remove
                                                            All</a>
                                                    </div>
                                                </div>
                                                {{-- <button type="button" class="btn btn-primary btn-xs dropdown-toggle"
                                                data-toggle="dropdown">
                                                Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('increment', ['id' => $carts->item_id]) }}">Add
                                                        Quantity</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('decrement', ['id' => $carts->item_id]) }}">Reduce
                                                        Quantity</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('delete', ['id' => $carts->item_id]) }}">Remove
                                                        All</a>
                                                </li>
                                            </ul> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer text-muted text-center">
                                <strong>Total Price: {{ $totalprice }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card mb-4" style="width:470px;height:430px">
                            <div class="card-header">
                                Transaction
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form method="POST" action="{{ route('checkout', ['id' => $user]) }}">
                                        @csrf
                                        <div class="container" style="padding:70px">
                                            <div class="row">
                                                <label for="pmethod_id">Payment Method</label>
                                                <select class="form-select form-control" name="pmethod_id" id="pmethod_id">
                                                    <option selected>Select Payment Method</option>
                                                    @foreach ($pmethod as $pm)
                                                        <option value={{ $pm->id }}>{{ $pm->Methods }}</option>
                                                    @endforeach
                                                </select>
                                            </div><br>

                                            <div class="row">
                                                <label for="country">Shipping Via</label>
                                                <select class="form-select form-control" name="shipper_id" id="shipper_id">
                                                    <option selected>Select Shipper</option>
                                                    @foreach ($shipper as $ship)
                                                        <option value={{ $ship->id }}>{{ $ship->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div><br>

                                            <div class="text-center" style="font-size: 20px">
                                                <button type="submit" class="btn btn-success"
                                                    id="checkout-button">Checkout</button>
                                            </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
@endsection
