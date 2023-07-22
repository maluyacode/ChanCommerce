@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Item Categories') }}</h1>
                    <br>
                    <td align='right';>
                    <a href="{{route('categories.create')}}" class="btn btn-primary btn-round">
                        <i class= "fa fa-plus"></i>Add Categories </a>
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
                                      <th scope="col">Category ID</th>
                                      <th scope="col">Category Name</th>
                                      
                                      <th scope="col">Date created</th>
                                      <th scope="col">Action</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($categories as $category)
                                      <tr>
                                        
                                          <td>{{$category->id}}</td>
                                          <td>{{$category->cat_name}}</td>
                                         
                                          <td>{{$category->created_at}}</td>
                                          
                                          <td>
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                                    <form action="{{route('categories.destroy',$category->id)}}" method="POST" style = "display:inline-block">
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