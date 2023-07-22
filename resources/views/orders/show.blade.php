@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<!-- Include JS -->

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Sales for Delivered Items') }}</h1>
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
                                      <th>Sellprice</th>
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
                                        <td><strong>{{$order->sellprice}}</td>
                                            <td><strong>{{$order->Methods}}</td>
                                      <td><strong>{{$order->name}}</td>
                                      <td><strong>{{$order->created_at}}</td>
                                       
                                      
                                      
                                        
                                    </tr>
                                    @endforeach
                                    {{-- {{ $orders->links() }} --}}

                                </tbody>
                            </table>
                            <h3 class="yow">{{ __('Total Sales:') }}{{$total}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: true
            });
        });
    </script>
    <!-- /.content -->
@endsection