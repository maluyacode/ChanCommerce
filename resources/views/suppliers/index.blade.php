@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Suppliers') }}</h1>
                    <br>
                    <td align='right';>
                    <a href="{{route('suppliers.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Add Supplier </a>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">Supplier Name</th>
                                      <th scope="col">Supplier Contact Number</th>
                                      <th scope="col">Supplier Address</th>
                                      <th scope="col">Supplier Email</th>
                                      <th scope="col">Date created</th>
                                      <th scope="col">Action</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($supplier as $supplier)
                                      <tr>
                                         
                                        
                                          <td>{{$supplier->sup_name}}</td>
                                          <td>{{$supplier->sup_contact}}</td>
                                          <td>{{$supplier->sup_address}}</td>
                                          <td>{{$supplier->sup_email}}</td>
                                          <td>{{$supplier->created_at}}</td>
                                          
                                          <td>
                                            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                                    <form action="{{route('suppliers.destroy',$supplier->id)}}" method="POST" style = "display:inline-block">
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