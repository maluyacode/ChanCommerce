@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Items') }}</h1>
                    <br>
                    <td align='right';>
                    <a href="{{route('items.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Create Item </a>
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
                                      <th>Image</th>
                                      <th>Item ID</th>
                                      <th>Item Name</th>
                                      <th>Category</th>
                                      <th>Supplier</th>
                                      <th>Sell Price</th>
                                      <th>Date created</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                 
                                    <tr>
                                      <td><img src="{{asset($item->img_path)}}" alt="" width="50px" height="50px"></td>
                                     
                                     <td><strong>{{$item->it_id}}</td>
                                      <td><strong>{{$item->item_name}}</td>
                                        <td><strong>{{$item->cat_name}}</td>
                                            <td><strong>{{$item->sup_name}}</td>
                                      <td><strong>{{$item->sellprice}}</td>
                                      <td><strong>{{$item->created_at}}</td>
                                       
                                      
                                      
                                        <td>
                                            <a href="{{ route('items.edit', $item->it_id) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                                    
                                                        {{-- <button type="submit" class = "btn btn-danger btn-delete" >
                                                            <i class= "fas fa-trash"  style="color:white"></i>
                                                        </button> --}}
                                                        <form action="{{route('items.destroy',$item->it_id)}}" method="POST" style = "display:inline-block">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"class = "btn btn-danger btn-delete">
                                                                <i class="fas fa-trash" style="color:white"></i>
                                                            </button>
                                                        </form>
                                            {{-- <button class="btn btn-danger btn-delete" data-url="{{route('items.destroy', $item->id)}}"><i
                                                    class="fas fa-trash"></i></button> --}}
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