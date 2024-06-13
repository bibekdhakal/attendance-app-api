<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/app.css">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <x-toast />
<main>
    <div id="primary" class="p-t-b-100 height-full ">
        <div class="">
            <div class="row">
                <div class="col-lg-4 mx-md-auto">
                    <div class="text-center">
                        <!-- <img src="assets/img/dummy/u5.png" alt=""> -->
                        <h3 class="mt-2">{{ __('Reset Password') }}</h3>
                        <!-- <p class="p-t-b-20">Hey Soldier welcome back signin now there is lot of new stuff waiting for you</p> -->
                    </div>
                    <form method="POST" action={{url('resetpassword/'.$data[0]['token'].'/'.$data[0]['id'])}}>
                        @csrf

                        <div class="row">
                            <label for="password" class="offset-md-2 col-md-8 col-form-label">{{ __('Password') }}</label>

                            <div class="offset-md-2 col-md-8 form-group has-icon">
                                <i class="icon-user-secret"></i>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="confirm_password" class="offset-md-2 col-md-8 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="offset-md-2 col-md-8 form-group has-icon">
                                <i class="icon-user-secret"></i>
                                <input id="confirm_password" type="password" class="form-control form-control-lg @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="current-password">

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #primary -->
</main>
<div class="control-sidebar-bg shadow white fixed"></div>

</div>

<!--/#app -->
<script src="../../assets/js/app.js"></script>
</body>
</html>
