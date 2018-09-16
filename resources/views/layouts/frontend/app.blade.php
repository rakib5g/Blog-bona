<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}-@yield('title')</title>

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('asset/frontend/common-css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/frontend/common-css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/frontend/common-css/ionicons.css') }}" rel="stylesheet">

    <!--toastr js for laravel-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack('css')
</head>
<body>
    <header>
        @include('layouts.frontend.includes.header')
    </header>

    @yield('content')

    <footer>
        @include('layouts.frontend.includes.footer')
    </footer>
    <!-- SCIPTS -->

    <script src="{{ asset('asset/frontend/common-js/jquery-3.1.1.min.js') }}"></script>

    <script src="{{ asset('asset/frontend/common-js/tether.min.js') }}"></script>

    <script src="{{ asset('asset/frontend/common-js/bootstrap.js') }}"></script>

    <script src="{{ asset('asset/frontend/common-js/swiper.js') }}"></script>

    <script src="{{ asset('asset/frontend/common-js/scripts.js') }}"></script>

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
