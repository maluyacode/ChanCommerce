@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Stocks') }}</h1>
                    <br>
                    <td align='right';>
                    <a href="{{route('stocks.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Add Stocks to Items </a>
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
                                      <th scope="col">Item Name</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Action</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                      @foreach($stocks as $stock)
                                      
                                      <tr>
                                         
                                          {{-- <td><input type = "hidden" value ="{{$stock->item_id}}"></td>  --}}
                                          <td>{{$stock->item_name}}</td>
                                          <td>{{$stock->quantity}}</td>
                                       
                                      
                                      
                                        <td>
                                            <a href="{{ route('stocks.edit', $stock->item_id) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                                    <form action="{{route('stocks.destroy',$stock->item_id)}}" method="POST" style = "display:inline-block">
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