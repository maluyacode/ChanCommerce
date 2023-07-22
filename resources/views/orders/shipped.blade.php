@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Orders') }}</h1>
                    <br>
                    <td align='right';>
                        
                    </td>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table" >
                                <thead>
                                    <tr>
                                      <th>Order ID</th>
                                      <th>Customer Name</th>
                                      <th>Item Image</th>
                                      <th>Item Name</th>
                                      <th>Quantity</th>
                                      <th>Status</th>
                                      <th>Payment Method</th>
                                      <th>Delivery Courier</th>
                                      <th>Date Placed</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                 
                                    <tr>
                                        <td><strong>{{$order->o_id}}</td>
                                            <td><strong>{{$order->customer_name}}</td>
                                      <td><img src="{{asset($order->img_path)}}" alt="" width="50px" height="50px"></td>
                                     
                                     <td><strong>{{$order->item_name}}</td>
                                      <td><strong>{{$order->quantity}}</td>
                                        <td><strong>{{$order->status}}</td>
                                            <td><strong>{{$order->Methods}}</td>
                                      <td><strong>{{$order->name}}</td>
                                      <td><strong>{{$order->created_at}}</td>
                                       
                                      
                                      
                                        <td>
                                           
                                                    
                                            {{-- <button class="btn btn-danger btn-delete" data-url="{{route('items.destroy', $item->id)}}"><i
                                                    class="fas fa-trash"></i></button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{ $orders->links() }}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection