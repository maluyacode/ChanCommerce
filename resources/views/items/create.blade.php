@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Add Items') }}</h1>
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
                          <form action="{{url('/items')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                                                       
                            <div class="form-group row">
                                <label for="name">Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" required>
                                @error('item_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group row">
                                <label for="country">Sell Price</label>
                                <input type="text" class="form-control" id="sellprice" placeholder="Enter Sell Price" name="sellprice" required>
                                @error('sellprice')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group row">
                                <label class="form-check-label" for="file">Upload Item Image</label>
                                <input type="file" class="form-control"  id="img_path" name="img_path" accept='image/*' required>
                                @error('img_path')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group row">
                                <label for="country">Supplier</label>
                                <select class="form-select form-control" name="sup_id" required>
                                    <option selected>Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value={{$supplier->id}}>{{$supplier->sup_name}}</option>
                                    @endforeach
                                </select>
                                @error('sup_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group row">
                                <label for="country">Category</label>
                                <select class="form-select form-control" name="cat_id" required>
                                    <option selected>Select Item Category</option>
                                    @foreach($categories as $category)
                                        <option value={{$category->id}}>{{$category->cat_name}}</option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                    <span class="text-danger">{{ $message }}</span>
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