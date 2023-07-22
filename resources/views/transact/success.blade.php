@extends('layouts.transact')
@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
<div class="content-header" style ="display:flex; justify-content:center;">
    <div class=" card" style ="display:flex; justify-content:center;">
        <div class="row mb-2" style ="display:flex; justify-content:center;">
            <div class="col-sm-6">
                
                <h1 style="font-size:50px; text-align:center"class="yow">{{ __('Order Successfully Placed!') }}</h1>
                <a style="display:flex; justify-content:center; "href="{{route('redirect')}}" class="btn btn-primary btn-round">
                    <i class= "fa fa-plus"></i>Home </a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
   
    <script
      src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
@endsection