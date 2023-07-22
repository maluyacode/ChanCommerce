@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Add Suppliers') }}</h1>
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
                            <form action="{{url('/suppliers')}}"  method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group row">
                                    <label for="name">Supplier Name</label>
                                    <input type="text" class="form-control" id="sup_name"  name="sup_name" placeholder="Enter Supplier Name">
                                    @error('sup_name')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group row">
                                    <label for="country">Supplier Contact Number</label>
                                    <input type="text" class="form-control" id="sup_contact" placeholder="Enter Supplier Contact" name="sup_contact">
                                    @error('sup_contact')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group row">
                                    <label for="country">Supplier Address</label>
                                    <input type="text" class="form-control" id="sup_address" placeholder="Enter Supplier Address" name="sup_address">
                                    @error('sup_address')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group row">
                                    <label for="country">Supplier Email</label>
                                    <input type="text" class="form-control" id="sup_email" placeholder="Enter Supplier Email" name="sup_email">
                                    @error('sup_email')
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