@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Add Shipper') }}</h1>
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
                            <form action="{{url('/shippers')}}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <label for="name">Shipper Name</label>
                                  <input type="text" class="form-control @error('Shipper') is-invalid @enderror" id="Shipper"  name="Shipper" placeholder="Enter Shipper Name">
                                  @error('Shipper')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection