<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    @yield('styles')
    @yield('headscripts')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        body {
            overflow-x: hidden;
        }

        .brand-link {
            height: 50px;
            margin-bottom: 30px;
        }

        .brand-link img {
            width: 50px;
        }

        .header {
            text-decoration: none;
            color: #F4F2DE;
            font-style: 'Times New Roman', Times, serif !important;
            font-size: 16px;
            font-weight: normal;
            width: inherit;
        }

        aside {}

        .brand-link {
            text-decoration: none;
            text-transform: uppercase;
        }

        .user-panel {
            background-color: #00000000 !important;
            margin: 1px 0px 0px 10px !important;
            padding: 0px !important;

        }

        .user-div a {
            text-decoration: none;
            color: #F4F2DE;
        }


        .user-name {
            text-decoration: none;
            color: #6c757d;
            font-style: 'Times New Roman' !important;
            font-weight: 400;
            letter-spacing: 2px
        }

        .card-body {
            background-color: #2B2730;
        }

        .card-body .card {
            opacity: 0.8;
            background-color: #2B2730;
            background-blend-mode: darken;
        }

        .nav-item a p,
        .toggle-mode,
        .account-settings {
            font-weight: 600;
            font-style: 'Pro';
            text-transform: uppercase;
            font-size: 15px;
            font-weight: 400;
            color: #F4F2DE;
        }

        .toggle-mode,
        .account-settings {
            text-decoration: none;
            margin-right: 20px;
        }

        .pushmenu {
            font-size: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
        }

        .main-sidebar,
        .sidebar {
            background-color: #2B2730 !important;
        }

        .mt-2 {
            background-color: #2B2730 !important;
        }

        .nav-link i:not(.fa-angle-left) {
            font-size: 30px;
        }

        li {
            max-width: 234px !important;
            background-color: #00000000;
        }

        .main-footer {
            color: #F4F2DE !important;
            font-size: 14px;
            letter-spacing: 1.5px;
        }

        .main-footer a {
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-red navbar-dark"style="background-color:#A52A2A ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pushmenu" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars" style="color: #000000"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">

                    <a class="nav-link account-settings" data-toggle="dropdown" href="#" aria-expanded="false"
                        style="color: white; text-align:right">
                        {{ 'Account Settings' }}
                    </a>
                    <span style="margin-left: auto;">
                        <strong>
                            <a class="toggle-mode" href="{{ route('redirectadmin') }}" style="color: white;">Toggle
                                Customer Mode</a>
                        </strong>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="mr-2 fas fa-file"></i>
                            {{ __('My profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar "style="height: 138vh !important;">
            <!-- Brand Logo -->
            <a href="/" class="brand-link" id="brand">
                <img src="/images/SQUARELOGO.png">
                <span class="header"> QK Hardware Store</span>
            </a>

            @include('layouts.navigation')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #A52A2A; color:white">

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer"style="background-color: #A52A2A; border-top: 1px solid #2B2730; margin: 0;">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Copyright &copy; 2023 <a href="">CQ Hardware Store </a> All
                rights reserved.
            </div>
            <!-- Default to the left -->
            <span>Anthing you want</span>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @vite('resources/js/app.js')
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            let size = $('.brand-link').width();

            $('.main-sidebar').on("mouseenter", function() {
                if (size > 100) {
                    $('.header').fadeIn(300, function() {
                        $(this).css({
                            display: "inline-block",
                        })
                    })
                    $('.brand-link img').css({
                        "margin-left": "0px"
                    })
                }
            });
            $('.main-sidebar').on("mouseleave", function() {
                if (size > 100) {
                    $('.header').fadeOut(300, function() {
                        $(this).css({
                            display: "none",
                        })
                    })
                    $('.brand-link img').css({
                        "margin-left": "5px"
                    })
                }
            });


            $('.pushmenu').on("click", function() {
                size = $('.brand-link').width();
                if (size < 100) {
                    $('.header').fadeIn(300, function() {
                        $(this).css({
                            display: "inline-block",
                        })
                    })
                    $('.brand-link img').css({
                        "margin-left": "0px"
                    })
                } else {
                    $('.header').fadeOut(300, function() {
                        $(this).css({
                            display: "none",
                        })
                    })
                    $('.brand-link img').css({
                        "margin-left": "5px"
                    })
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
