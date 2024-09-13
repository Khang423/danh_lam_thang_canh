<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" href="{{ asset('assets/systems/logo.png') }}g" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/systems/logo-icon.png') }}" type="image/x-icon">
    @include('admin.global.meta-tag')
    @include('admin.global.style-import')
    @yield('css')
</head>
 
<body>
    @include('admin.global.preloader')
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper modern-type" id="pageWrapper">
        @include('admin.global.header')
        <div class="page-body-wrapper">
            @include('admin.global.aside')
            <div class="page-body">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <div class="container-fluid">
                    @include('admin.global.footer')
                </div>
            </div>
        </div>
    </div>
    @include('admin.global.script-import')
    @yield('scripts')
</body>

</html>
