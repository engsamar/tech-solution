<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard">
    <meta name="author" content="Admin">
    <link rel="shortcut icon" href="{{ asset('/images/fav.png') }}">

    <!-- Title -->
    <title> Admin - Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

    <!-- Master CSS -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

</head>

<body class="authentication">

    <!-- Container start -->
    <div class="container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="row justify-content-md-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="login-screen">
                        <div class="login-box">
                            <a href="#" class="login-logo">
                                <img src="{{ asset('/images/logo.png') }}" alt="Admin">
                            </a>
                            <h5>مرحبًا بعودتك,<br>يرجى تسجيل الدخول إلى حسابك.</h5>
                            <div class="form-group">
                                <input value="{{ old('email') }}" name="email" type="text" class="form-control" placeholder="البريد الإلكتروني">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="كلمة المرور">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            @if ($errors->any())
                                <br />
                                <h5 class="text-danger float-left">{{ $errors->first() }}</h5>
                                <br />
                            @endif
                            <div class="actions mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember_pwd">
                                    <label class="custom-control-label" for="remember_pwd">تذكرني</label>
                                </div>
                                <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Container end -->

</body>

</html>
