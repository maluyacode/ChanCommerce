@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Category Information') }}</h1>
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
                            <form action="{{route('categories.update', $categories->id)}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                
                                <div class="form-group row">
                                  <label for="name">Category Name</label>                             
                                  <input type="text" class="form-control @error('cat_name') is-invalid @enderror" id="cat_name"  name="cat_name" placeholder="Enter Category Name" value="{{$categories->cat_name}}">
                                  @error('cat_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection