@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Supplier Information') }}</h1>
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
                            <form action="{{route('suppliers.update', $supplier->id)}}"  method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                        
                                <div class="form-group row">
                                    <label for="name">Supplier Name</label>
                                    <input type="text" class="form-control @error('sup_name') is-invalid @enderror" id="sup_name" name="sup_name" placeholder="Update Supplier Name" value="{{ old('sup_name', $supplier->sup_name) }}">
                                    @error('sup_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group row">
                                    <label for="country">Supplier Contact Number</label>
                                    <input type="text" class="form-control @error('sup_contact') is-invalid @enderror" id="sup_contact" placeholder="Update Supplier Contact" name="sup_contact" value="{{ old('sup_contact', $supplier->sup_contact) }}">
                                    @error('sup_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group row">
                                    <label for="country">Supplier Address</label>
                                    <input type="text" class="form-control @error('sup_address') is-invalid @enderror" id="sup_address" placeholder="Update Supplier Address" name="sup_address" value="{{ old('sup_address', $supplier->sup_address) }}">
                                    @error('sup_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group row">
                                    <label for="country">Supplier Email</label>
                                    <input type="text" class="form-control @error('sup_email') is-invalid @enderror" id="sup_email" placeholder="Update Supplier Email" name="sup_email" value="{{ old('sup_email', $supplier->sup_email) }}">
                                    @error('sup_email')
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