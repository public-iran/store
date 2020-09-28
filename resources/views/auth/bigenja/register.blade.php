@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/css/userlogin.css')}}">
@endsection
@section('style')

    <style>

        .invalid-feedback{
            font-size: 12px;
            color: red;
        }
        .text-md-right{
            text-align: left!important;
        }
        .login-page-content-area .login-page-wrapper:after{
            display: none;
        }
        .login-page-content-area .right-contnet-area .bottom-content .login-form .form-element .input-field{
            margin-bottom: 0;
        }
        .form-element{
            margin-bottom: 20px;
        }
    </style>
@endsection
@section('content')

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">ثبت نام</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">خانه</a></li>
                                <li>ثبت نام</li>
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
                                        <h4 class="title">امروز ثبت نام کنید</h4>
                                    </div>
                                    <div class="bottom-content">
                                        <form class="login-form" method="POST" action="{{ route('register') }}">
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
                                                <input name="name" type="text" class="input-field" placeholder="نام خود را وارد کنید">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-element">
                                                <input name="family" type="text" class="input-field" placeholder="نام خانوادگی خود را وارد کنید">
                                                @if ($errors->has('family'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
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
                                            <div class="form-element">
                                                <input type="password" name="password_confirmation" class="input-field" placeholder="تکرار رمز عبور">

                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="submit-btn">ثبت نام</button>
                                                {{--<a href="#" class="link">فراموشی رمز عبور</a>--}}
                                                <span class="link">قبلا ثبت نام کرده اید از این قسمت  <a href="/login" class="">وارد شوید</a></span>

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
