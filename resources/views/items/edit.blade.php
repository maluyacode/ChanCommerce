@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Item Information') }}</h1>
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
                            <form action="{{route('items.update', $item->it_id)}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row" >
                                    <img src="{{asset($item->img_path)}}" alt="" width="100" height="100">
                                </div>
                                <div class="form-group row">
                                    <label for="item_name">Item Name</label>
                                    <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name"  name="item_name" placeholder="Update Item Name" value="{{ old('item_name', $item->item_name) }}">
                                    @error('item_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="sellprice">Sell Price</label>
                                    <input type="text" class="form-control @error('sellprice') is-invalid @enderror" id="sellprice" placeholder="Update Sell Price" name="sellprice" value="{{ old('sellprice', $item->sellprice) }}">
                                    @error('sellprice')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="form-check-label" for="file">Update Item Image</label>
                                    <input type="file" class="form-control @error('img_path') is-invalid @enderror" id="file" name="img_path" accept='image/*'>
                                    @error('img_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="sup_id">Supplier</label>
                                    <select class="form-select form-control @error('sup_id') is-invalid @enderror" name="sup_id">
                                        <option selected value="{{ old('sup_id', $item->sup_id) }}">{{ $item->sup_name }}</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->sup_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sup_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="cat_id">Category</label>
                                    <select class="form-select form-control @error('cat_id') is-invalid @enderror" name="cat_id">
                                        <option selected value="{{ old('cat_id', $item->cat_id) }}">{{ $item->cat_name }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
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