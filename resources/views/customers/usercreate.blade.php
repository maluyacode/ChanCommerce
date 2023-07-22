@extends('layouts.transact')

@section('content')
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->

            <div class="content" style="justify-content: center; text-align:center; font-size:20px">
             
                    <h1 ><strong>{{ __('Add Account Profile') }}</h1>
                
                </div><!-- /.col -->
            
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('userstore')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name">Account Name</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" placeholder="Enter Account Name">
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="country">Account Contact</label>
                                    <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" placeholder="Enter Account Contact" name="contact">
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="country">Account Home Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter Account Home Address" name="address">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="form-check-label" for="file">Upload Account Image</label>
                                    <input type="file" class="form-control @error('img_pathC') is-invalid @enderror" id="img_pathC" name="img_pathC" accept='image/*'>
                                    @error('img_pathC')
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