@extends('layouts.transact')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('search')
<div class="container d-flex align-items-center justify-content-center"style="font-size: 18px; background-color: #A52A2A; display: flex; justify-content: center; height: 50px">
    
                <form action="{{ route('search') }}" method="get">
                    <input type="text" name="q" placeholder="Search items...">
                    <button type="submit" style="background-color: #F0E68C">Search</button>
                </form>
           
        </div>
@endsection
@section('categories')

@foreach ($categories as $category)
                <a class="btn btn" style="background-color:#000; color:#e5e7eb"
                    href="{{ route('category', $category->id) }}">{{ $category->cat_name }} </a>
            @endforeach
            @endsection
            @section('hover')
            <div class="gallery">
                <div class="box">
                    <img src="/images/pic1.jpg" alt="">
                </div>
                <div class="box">
                    <img src="/images/pic2.jpg" alt="">
                </div>
                <div class="box">
                    <img src="/images/pic3.jpg" alt="">
                </div>
            </div>
            @endsection
@section('content')
@if (Session::has('message'))
<div class="alert alert-success">
    {!! Session::get('message') !!}
</div>
<br>
@endif
<div class="container">
    
  <div class="row">
  
        @foreach($items as $item)
          <div class="col-md-4 mb-4">
              <div class="card h-100">
                  <div class="card-body">

                      <div class="thumbnail">
                          <img src="{{ asset($item->img_path) }}" class="card-img-top" alt="">

                          <div class="caption">
                              <h3 class="card-title">{{ $item->item_name }}
                              </h3>
                              <p class="card-text">P{{ $item->sellprice }}</p>
 
                              <p class="card-text">{{ $item->cat_name}}</p>
                              <div class="clearfix">
                                <form id="my-form" method="POST" action="{{ route('addcart', ['id' => $item->it_id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" role="button">
                                      <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                  </form>
                                  <script>
                                    var link = document.getElementById('my-form');
                                  
                                    $.get('/check-availability/{{ $item->it_id }}', function(response) {
                        if (response.available == false) {
                            link.querySelector('button').disabled = true;
                        }
                    });
               
                                  </script>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
       
  </div>
  
</div>

<script>
  src = "https://code.jquery-1.12.4.min.js" >
</script>
<script>
  src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
</script>
<style>
  .card-img-top {
      height: 200px;
      object-fit: cover;
  }

  .card {
      border: 1px solid #dee2e6;
      border-radius: 4px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .card-title {
      font-weight: bold;
      margin-bottom: 30px;
  }

  .card-text {
      margin-bottom: 5px;
  }

  .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
  }
</style>
@endsection
<b></b>