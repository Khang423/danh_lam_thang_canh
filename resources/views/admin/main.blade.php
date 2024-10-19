<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="{{asset('/assets/systems/favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Danh Lam Thắng Cảnh</title>
    @include('admin.global.style-import')
    @yield('css')
</head>
<body>
    <div class="wrapper">
        {{-- @include('admin.global.preloader') --}}
        @include('admin.global.navbar')
        @include('admin.global.asside')
        <div class="content-page">
            @yield('content')
            @include('admin.global.footer')
        </div>
    </div>
    @include('admin.global.script-import')
    @yield('script')
</body>
</html>
