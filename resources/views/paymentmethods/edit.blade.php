@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Payment Method') }}</h1>
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
                            <form action="{{route('paymentmethods.update', $pmethods->id)}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                            
                                <div class="form-group row">
                                    <label for="name">Method Name</label>
                                    <input type="text" class="form-control @if($errors->has('Methods')) is-invalid @endif" id="Methods"  name="Methods" placeholder="Update Method Name" value="{{ old('Methods', $pmethods->Methods) }}">
                                    @if($errors->has('Methods'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('Methods') }}
                                        </div>
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