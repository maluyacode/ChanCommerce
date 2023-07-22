@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Add Stocks') }}</h1>
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
                            <form action="{{url('/stocks')}}"  method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group row">
                                  <label for="country">Item</label>
                                  <select class="form-select form-control" name="item_id">
                                    <option selected>Select Item</option>
                                      @foreach($items as $item)
                                        <option value={{$item->id}}>{{$item->item_name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                        
                                <div class="form-group row">
                                    <label for="country">Stock Quantity</label>
                                    <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity">
                                    @error('quantity')
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