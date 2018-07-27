<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <script src='https://www.google.com/recaptcha/api.js'></script> 
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

    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase.js"></script>
    <script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDvN0Pywabdl8U8J2hxM0b32h7ErOZuXZ8",
        authDomain: "dorr-app.firebaseapp.com",
        databaseURL: "https://dorr-app.firebaseio.com",
        projectId: "dorr-app",
        storageBucket: "dorr-app.appspot.com",
        messagingSenderId: "243311451130"
    };
    firebase.initializeApp(config);
    </script>


    <script>
             var url = ''
    </script>
    @stack('begScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/ar.js"></script>
    <script  src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/getmdl-select.min.js') }}"></script>
    @stack('scripts')
</body>
</html>