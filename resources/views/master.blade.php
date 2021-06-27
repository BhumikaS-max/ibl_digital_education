<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('layouts.head')
</head>
<body>
<div id="loader"></div>
<div id="wrapper">
    @include('layouts.sidebar-nav')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
@include('layouts.footer-scripts')
@include('sweet::alert')
@yield('page-script')
</body>
</html>
