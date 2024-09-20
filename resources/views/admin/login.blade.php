<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Rica- login</title>
    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @include('admin.global.style-import')
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo" href="index.html">
                                <img class="img-fluid for-light"src="{{ asset('assets/systems/logo-icon.png') }}"
                                    alt="looginpage">
                                <img class="img-fluid for-dark" src="{{ asset('assets/systems/logo-icon.png') }}"
                                    alt="looginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form" action="{{ route('admin.login') }}" method="post">
                                @csrf 
                                <h4>Đăng Nhập Hệ Thống Du Lịch</h4>
                                <p>Nhập thông tin tài khoản để đăng nhập</p>
                                <div class="form-group">
                                    <label class="col-form-label form-label-title ">Tên đăng nhập</label>
                                    <input class="form-control"  name="user_identifier" required=""
                                        placeholder="Test@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label form-label-title ">Mật khẩu</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password" required=""
                                            placeholder="*********">
                                        <div class="show-hide">
                                            <span class="show"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="remember" type="checkbox" name="remember_me" value="on">
                                        <label class="text-muted" for="remember" > Ghi nhớ đăng nhập</label>
                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary btn-block w-100" type="submit"
                                                id="login-submit">
                                                Đăng Nhập
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
<script>
    $('document').ready(function() {
        $('#login-submit').click(function() {

        });
    });
</script>

</html>
