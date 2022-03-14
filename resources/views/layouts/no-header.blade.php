<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@stack('title')</title>
    <link href="{{asset('assets/css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/SpinKit/css/spinkit.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('images/fav.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stack('styles')
<!-- Slim CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/slim.css')}}">

</head>
<body>
@yield('content')

<script src="{{asset('assets/js/jquery/js/jquery.js')}}"></script>

<script src="{{asset('assets/js/scripts.js')}}"></script>

<script src="{{asset('assets/js/popper.js/js/popper.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/jquery.cookie/js/jquery.cookie.js')}}"></script>
<script src="{{asset('assets/js/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>

@stack('scripts')

<script src="{{asset('assets/js/slim.js?v='.\Carbon\Carbon::now()->getTimestamp())}}"></script>

</body>
</html>
