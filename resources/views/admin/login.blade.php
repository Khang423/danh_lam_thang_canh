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

<body class="authentication-bg position-relative">
    <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
        <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
            <g fill-opacity='0.22'>
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100' />
            </g>
        </svg>
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header py-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="https://coderthemes.com/hyper/saas/assets/images/logo.png" alt="logo" height="22"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h3 class="text-dark-50 text-center pb-0 fw-bold">Hệ Thống Quản Lí Du Lịch Kiên Giang</h3>
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Đăng Nhập</h4>
                                <p class="text-muted mb-4">
                                    Nhập mật khẩu và Gmail để truy cập 
                                </p>
                            </div>

                            <form action="{{ route('admin.login') }}" method="post" id="form-login">
                                @csrf
                                <div class="mb-3">
                                    <label for="user_identifier" class="form-label">Email / Số điện
                                        thoại</label>
                                    <input class="form-control" type="text" id="emailaddress" required
                                        name="user_identifier" placeholder="Nhập vào Email / Số điện thoại của bạn">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input class="form-control" type="password" required name="password" id="password"
                                        placeholder="Nhập vào mật khẩu của bạn">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember"
                                            name="remember_me" value="on">
                                        <label class="form-check-label" for="remember">Ghi nhớ tôi</label>
                                    </div>
                                </div>
                                <div class="d-grid mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Đăng
                                        nhập</button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="pages-register.html"
                                    class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('libraries/hyper/vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('libraries/hyper/app.min.js') }}"></script>
</body>

</html>
