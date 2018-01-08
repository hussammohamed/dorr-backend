<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://bareeqstudio.com/dorr/public/">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dorr @yield('title')</title>

    <!-- Styles -->
    @if(App::getLocale()=="en" )
        <link href="{{ asset('css/app_en.css') }}" rel="stylesheet">
            @else
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            @endif
    
    @stack('styles')
</head>
<body>
    <div id="app" class="app--container">
        <!--header-->
        @include('layouts.header')
        <!-- main content -->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- footer -->
        @include('layouts.footer')
    </div>
    <!-- Scripts -->
    <script>
             var url = 'http://bareeqstudio.com/dorr/public'
    </script>
    <script  src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/getmdl-select.min.js') }}"></script>
    @stack('scripts')
</body>
</html>