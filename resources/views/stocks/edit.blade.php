@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Update Stocks Information') }}</h1>
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
                            <form action="{{route('stocks.update', $stock->item_id)}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                        {{-- {{dd($items)}} --}}
                                <div class="form-group row">
                                  
                                  <label for="country">Item</label>
                                  <select class="form-select form-control" name="item_id">
                                  <option selected value="{{$stock->item_id}}">{{$stock->item_name}}</option>
                                  @foreach($items as $item)
                                  <option value={{$item->id}}>{{$item->item_name}}</option>
                                @endforeach
                            </select>
                          </div>
                        
                          <div class="form-group row">
                            <label for="country">Quantity</label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Update Quantity" name="quantity" value="{{ old('quantity', $stock->quantity) }}">
                            @error('quantity')
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