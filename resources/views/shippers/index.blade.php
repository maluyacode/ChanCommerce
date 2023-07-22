@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Shippers') }}</h1>
                    <br>
                    <td align='right';>
                    <a href="{{route('shippers.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Add Shippers </a>
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
                                      
                                      <th scope="col">Shipper ID</th>
                                      <th scope="col">Shipper Name</th>
                                      
                                      <th scope="col">Date created</th>
                                      <th scope="col">Action</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($shippers as $shipper)
                                      <tr>
                                          
                                          <td>{{$shipper->id}}</td>
                                          <td>{{$shipper->name}}</td>
                                
                                          <td>{{$shipper->created_at}}</td>
                                          
                                          <td>
                                            <a href="{{ route('shippers.edit', $shipper) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                            
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