@extends('layouts.transact')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content" style="justify-content: center; text-align:center; font-size:20px">
             
        <h1 ><strong>{{ __('Edit Account Profile') }}</h1>
    
    </div><!-- /.c
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('profupdate', ['id' => $customer->user_id])}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row" style="justify-content: center">
                                    <img src="{{asset($customer->img_pathC)}}" alt="" width="100" height="100">
                                </div>
                                <div class="form-group row">
                                    <label for="name">Account Name</label>
                                    <input type="text" class="form-control" id="customer_name"  name="customer_name" placeholder="Update Admin Name" value="{{$customer->customer_name}}">
                                    @if ($errors->has('customer_name'))
                                        <div class="alert alert-danger">{{ $errors->first('customer_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="country">Contact</label>
                                    <input type="text" class="form-control" id="contact" placeholder="Update Account Contact" name="contact" value="{{$customer->contact}}">
                                    @if ($errors->has('contact'))
                                        <div class="alert alert-danger">{{ $errors->first('contact') }}</div>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="country">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Update Account Address" name="address" value="{{$customer->address}}">
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label class="form-check-label" for="file">Image</label>
                                    <input type="file" class="form-control" id="file" name="img_pathC" accept='image/*'>
                                    @if ($errors->has('img_pathC'))
                                        <div class="alert alert-danger">{{ $errors->first('img_pathC') }}</div>
                                    @endif
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