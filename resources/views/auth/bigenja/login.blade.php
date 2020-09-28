@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/css/userlogin.css')}}">
@endsection
@section('style')
    <style>
        .text-md-right{
            text-align: left!important;
        }
        .login-page-content-area .login-page-wrapper:after{
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- ============================================== HEADER : END ============================================== -->

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">ورود</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="index.html">خانه</a></li>
                                <li>ورود</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- login page content area start -->
    <div class="login-page-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-page-wrapper"><!-- login page wrapper -->

                        <div class="row">

                            <div class="col-lg-6" style="margin: 0 auto">
                                <div class="right-contnet-area">
                                    <div class="top-content">
                                        <h4 class="title">ورود به حساب</h4>
                                    </div>
                                    <div class="bottom-content">
                                        <form class="login-form" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-element">
                                                <input name="email" type="email" class="input-field" placeholder="نام کاربری یا ایمیل خود را وارد کنید">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-element">
                                                <input type="password" name="password" class="input-field" placeholder="رمز عبور">
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="submit-btn">ورود</button>
                                                <a href="#" class="link">فراموشی رمز عبور</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- //.login page wrapper -->
                </div>
            </div>
        </div>
    </div>
    <!-- login page content area end -->




@endsection
