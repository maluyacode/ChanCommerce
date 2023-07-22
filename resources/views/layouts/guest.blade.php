<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ 'CK Hardware Store' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset('/images/SQUARELOGO.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center;  backdrop-filter: blur(5px);  ">

  <div class = "content" style="background-color: white" img src="/images/Home.png" alt="" width="1085px" height="380px" >  
<div class="login-box"style=" outline: 4px solid red;">
    <div class="login-logo" style="background-color:black; color:white; opacity:.9 ">
        <a style="color:white" href="/">{{ ' QKHardware Store' }}</a>
    </div>
    <!-- /.login-logo -->
    
    <div class="card">
        
        @yield('content')
    </div>
</div>
</div>
<!-- /.login-box -->

@vite('resources/js/app.js')
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
</body>
</html>
