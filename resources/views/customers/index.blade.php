@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Accounts') }}</h1>
                    <br>
                    {{-- <td align='right';>
                    <a href="{{route('customers.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Add Customer </a>
                    </td> --}}
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
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">Image</th>
                                      <th scope="col">Accounts ID</th>
                                      <th scope="col">Accounts Name</th>
                                      <th scope="col">Accounts Email</th>
                                      <th scope="col">Accounts Type</th>
                                      <th scope="col">Contact</th>
                                      <th scope="col">Address</th>
                                      <th scope="col">Date created</th>
                                      <th scope="col">Action</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($customers as $customer)
                                      <tr>
                                          <td><img src="{{asset($customer->img_pathC)}}" alt="" width="50px" height="50px"></td>
                                          {{-- <td><img src="{{asset($artist->img_path)}}" alt="" width="250px" height="250px"></td> --}}
                                          <td>{{$customer->cus_id}}</td>
                                          <td>{{$customer->customer_name}}</td>
                                          <td>{{$customer->email}}</td>
                                          <td>{{$customer->usertype}}</td>
                                          <td>{{$customer->contact}}</td>
                                          <td>{{$customer->address}}</td>
                                          <td>{{$customer->created_at}}</td>
                                          
                                          <td>
                                            <a href="{{ route('customers.edit', $customer->cus_id) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{route('customers.destroy',$customer->cus_id)}}" method="POST" style = "display:inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"class = "btn btn-danger btn-delete">
                                                    <i class="fas fa-trash" style="color:white"></i>
                                                </button>
                                            </form>
                                        </td>
                                              
                                                  
                                              
                                          
                                         
                                      </tr>
                                     @endforeach
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