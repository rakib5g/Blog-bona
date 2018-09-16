<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}-@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset/backend/dist/css/AdminLTE.min.css') }}">
    <!-- Material Design -->
    <link rel="stylesheet" href="{{ asset('asset/backend/dist/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/backend/dist/css/ripples.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/backend/dist/css/MaterialAdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('asset/backend/dist/css/skins/all-md-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--toastr js for laravel-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.backend.includes.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.backend.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        @include('layouts.backend.includes.footer')
    </div>


    <!-- jQuery 3 -->
    <script src="{{ asset('asset/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('asset/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Material Design -->
    <script src="{{ asset('asset/backend/dist/js/material.min.js') }}"></script>
    <script src="{{ asset('asset/backend/dist/js/ripples.min.js') }}"></script>
    <script>
        $.material.init();
    </script>
    <!-- FastClick -->
    <script src="{{ asset('asset/backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('asset/backend/dist/js/adminlte.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('asset/backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('asset/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('asset/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('asset/backend/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('asset/backend/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('asset/backend/dist/js/demo.js') }}"></script>

    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script type="text/javascript">
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                     progressbar: true,
                });
            @endforeach
        @endif
    </script>

    @stack('scripts')

</body>

</html>
