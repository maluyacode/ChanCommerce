@extends('layouts.main-navbar')
@section('content')
    <div class="card">
        <img src="{{ asset($customers->img_pathC) }}" alt="" style="height:350px">
        <h1 style="font-size: 20px;">Name: {{ $customers->customer_name }}</h1>
        <p class="title">User Type: {{ $customers->usertype }}</p>
        <p>Address: {{ $customers->address }}</p>
        <p>Date Created: {{ $customers->created_at }}</p>
        <a href="{{ route('customersedit', ['id' => $customers->user_id]) }}" class="btn btn-primary">Edit Profile<i
                class="fas fa-edit"></i></a>
    </div>
    <br>
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" style="display:inline-block">x</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <br>
    <div class="container" style="background-color: #A52A2A; color: white; text-align:center">
        @foreach (['all', 'processing', 'delivered', 'shipped', 'cancelled', 'for delivery'] as $status)
            <a style="color:white; background-color:black" class="btn btn"
                href="{{ route('userprofile', ['id' => $user, 'status' => $status]) }}">{{ ucfirst($status) }}</a>
        @endforeach
        {{ $orders->links() }}
        @foreach ($orders->groupBy('o_id') as $orderId => $orderItems)
            <div class="card" style=" background-color: black">
                <div class="card-header" style="background-color: #F0E68C">
                    <h2 class="card-title" style="color: black">Order #{{ $orderId }}</h2>

                    @if ($orderItems->first()->status == 'Delivered')
                        <a class="btn btn-primary" disabled>Cancel Order</a>
                    @elseif($orderItems->first()->status == 'Shipped')
                        <a class="btn btn-primary" disabled>Cancel Order</a>
                    @elseif($orderItems->first()->status == 'Cancelled')
                        <a class="btn btn-primary" disabled>Order Cancelled</a>
                    @else
                        <a href="{{ route('cancelled', ['id' => $order->id]) }}" class="btn btn-primary">Cancel Order</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="color: black; background-color: #F0E68C;">
                            <thead>
                                <tr>
                                    <th>Item Picture</th>
                                    <th>Item Name</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $orderItem)
                                    <tr style="font-size: 20px; justify-content: center">
                                        <td><img src="{{ asset($orderItem->img_path) }}" alt="" style="width: 40%">
                                        </td>
                                        <td>{{ $orderItem->item_name }}</td>
                                        <td>{{ $orderItem->status }}</td>
                                        <td>{{ $orderItem->quantity }}</td>
                                        <td>{{ $orderItem->sellprice * $orderItem->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <main>
<center><label for="item-3" class="toggle" >{{'My Orders'}}</label>
<input type="checkbox" name="one" id="item-3" class="hide-input">
<div class="toggle-el">
  <div>
    @foreach ($orders->groupBy('o_id') as $orderId => $orderItems)

  <div class="card"style="max-width: 1150px; background-color:black ">
    <div class="card-header " style="background-color:#F0E68C" >
      <h2 class="card-title" style="color: black">Order #{{ $orderId }}</h2>
       <a href="{{route('cancelled',['id' => $order->id])}}" class="btn btn-primary">Cancel Order</a>
    </div>
    <div class="card-body" >
      <div class="table-responsive">
      <table class="table table-striped"style="color:red; background-color: #F0E68C; justify-content:right">
        <thead>
          <tr>
            <th>Item Picture</th>
            <th>Item Name</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Price</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($orderItems as $orderItem)
            <tr style="font-size: 20px; justify-content: center">
              <td><img src="{{asset($orderItem->img_path)}}" alt="" style="width:40%"></td>
              <td>{{ $orderItem->item_name }}</td>
              <td>{{ $orderItem->status }}</td>
              <td>{{ $orderItem->quantity }}</td>
              <td>{{ $orderItem->sellprice * $orderItem->quantity }}</td>

            </tr>
          </tbody>

          @endforeach

      </table>
    </div>
  </div>
  </div>

@endforeach

  </div>
</div>
<center><label for="item-3" class="toggle" >{{'My Orders'}}</label>
<input type="checkbox" name="one" id="item-3" class="hide-input">
<div class="toggle-el">
  <div>
    @foreach ($orders->groupBy('o_id') as $orderId => $orderItems)

  <div class="card"style="max-width: 1150px; background-color:black ">
    <div class="card-header " style="background-color:#F0E68C" >
      <h2 class="card-title" style="color: black">Order #{{ $orderId }}</h2>
       <a href="{{route('cancelled',['id' => $order->id])}}" class="btn btn-primary">Cancel Order</a>
    </div>
    <div class="card-body" >
      <div class="table-responsive">
      <table class="table table-striped"style="color:red; background-color: #F0E68C; justify-content:right">
        <thead>
          <tr>
            <th>Item Picture</th>
            <th>Item Name</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Price</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($orderItems as $orderItem)
            <tr style="font-size: 20px; justify-content: center">
              <td><img src="{{asset($orderItem->img_path)}}" alt="" style="width:40%"></td>
              <td>{{ $orderItem->item_name }}</td>
              <td>{{ $orderItem->status }}</td>
              <td>{{ $orderItem->quantity }}</td>
              <td>{{ $orderItem->sellprice * $orderItem->quantity }}</td>

            </tr>
          </tbody>

          @endforeach

      </table>
    </div>
  </div>
  </div>

@endforeach

  </div>
</div>
</main> --}}


    {{-- <style>
        main {
            width: 100%;
            max-width: 1000px;
            padding: 2rem;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
        }

        .toggle-el {
            padding: 2rem;
            height: 100%;
            background: #F0E68C;
            transition: all 0.2s ease;
            opacity: 1;
            margin-top: 1rem;
            overflow: hidden;
        }

        input[type=checkbox].hide-input:checked+.toggle-el {
            height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        input.hide-input {
            position: absolute;
            left: -999em;
        }

        label.toggle {
            text-align: center;
            text display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5em 1em;
            font-size: 2rem;
            color: #000000;
            background: #A52A2A;
            border-radius: 10px;
            user-select: none;
        }

        .table td,
        .table th {
            width: 33.33%;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: auto;
            text-align: justify;
        }

        .title {
            color: white;
            font-size: 20px;

        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .logo {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style> --}}
@endsection
