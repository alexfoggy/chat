<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@stack('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="{{asset('front/build/css/libs.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/build/css/main.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('images/fav.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stack('styles')
</head>
<body>


<!-- Main Header start -->
<header class="main-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{url('/')}}" class="logo">Yolly.pro</a>
            <div class="menu">
                <div class="actions">
                    <a href="{{url('login')}}" class="login">Login</a>
                    <a href="{{url('register')}}" class="register">Register</a>
                </div>
            </div>
        </div>
    </div>
</header>
@yield('content')
<footer class="main-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <a href="{{url('/')}}" class="logo">Yolly.pro</a>
            <div class=""></div>
            <div class="menu-list">
                <a href="{{url('docs')}}">Docs</a>
                <a href="{{url('instruction')}}">Instruction</a>
                <a href="{{url('price')}}">Pricing</a>
            </div>
        </div>
    </div>
</footer>


@stack('scripts')

<script src="{{asset('front/build/js/libs.min.js')}}"></script>
<script src="{{asset('front/build/js/main.js')}}"></script>

</body>
</html>
