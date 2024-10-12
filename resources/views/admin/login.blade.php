<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    <meta charset="utf-8" />
    <title>Đăng nhập | Hytertech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/systems/short-cut.ico') }}">

    <script src="{{ asset('libraries/hyper/hyper-config.js') }}"></script>
    <link href="{{ asset('libraries/hyper/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('libraries/hyper/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg pb-0">
    <div class="auth-fluid">
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">
                <div class="auth-brand text-center text-lg-start">
                    <a href="{{ env('/') }}" class="logo-dark">
                        <span><img src="{{ asset('assets/systems/logo-light.png') }}" alt="dark logo" height="60"></span>
                    </a>
                    <a href="{{ env('/') }}" class="logo-light">
                        <span><img src="{{ asset('assets/systems/logo-dark.png') }}" alt="logo" height="60"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <h4 class="mt-0">Đăng nhập</h4>
                    <p class="text-muted mb-4">Nhập vào Email / Số điện thoại và mật khẩu để đăng nhập</p>
                    <form action="{{ route('admin.login') }}" method="post" id="form-login">
                        @csrf
                        <div class="mb-3">
                            <label for="user_identifier" class="form-label">Email / Số điện thoại</label>
                            <input class="form-control" type="text" id="emailaddress" required name="user_identifier"
                                placeholder="Nhập vào Email / Số điện thoại của bạn">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input class="form-control" type="password" required name="password" id="password"
                                placeholder="Nhập vào mật khẩu của bạn">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember_me" value="on">
                                <label class="form-check-label" for="remember">Ghi nhớ tôi</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Hệ thống giàn rau thủy canh thông minh</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Sản phẩm rau sạch và an toàn cho sức khỏe!
                    <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - Trang quản trị -
                </p>
        </div>
    </div>
    <!-- Vendor js -->
    <script src="{{ asset('libraries/hyper/vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('libraries/hyper/app.min.js') }}"></script>
</body>

</html>