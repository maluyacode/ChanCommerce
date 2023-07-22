@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Payment Methods') }}</h1>
                    <br>
                    <td align='right';>
                    <a href="{{route('paymentmethods.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Add Payment Method </a>
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
                                      
                                      <th scope="col">Method ID</th>
                                      <th scope="col">Method Name</th>
                                      
                                      <th scope="col">Date created</th>
                                      <th scope="col">Action</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($pmethods as $pmethod)
                                      <tr>
                                          
                                          <td>{{$pmethod->id}}</td>
                                          <td>{{$pmethod->Methods}}</td>
                                
                                          <td>{{$pmethod->created_at}}</td>
                                          
                                          <td>
                                            <a href="{{ route('paymentmethods.edit', $pmethod) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{route('paymentmethods.destroy',$pmethod->id)}}" method="POST" style = "display:inline-block">
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