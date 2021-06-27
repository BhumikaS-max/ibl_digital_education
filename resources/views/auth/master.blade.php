<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('auth.layouts.head')
    <style>
        body{
            color: #fff;
            background-image: url('public/images/bg.jpg') !important;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
        {{--@if(Request::segment(2) == 'password' || Request::segment(3) == 'user-reset-password')
            body{
                color: #fff;
                background-image: url('../../../images/bg.jpg') !important;
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
            }
        @endif--}}
    </style>
</head>
<body class="gray-bg auth_background">
@yield('content')
@include('auth.layouts.footer-script')
@include('sweet::alert')
@yield('page-script')
</body>
</html>
