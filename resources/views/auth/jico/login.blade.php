@extends('front'.theme_name().'layout.master')
@section('style_link')
@endsection
@section('style')

@endsection
@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h2>ورود </h2>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>ورود </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!--Login Register section start-->
    <div class="login-register-section section sb-border pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-70 pb-lg-50 pb-md-40 pb-sm-30 pb-xs-20">
        <div class="container">
            <div class="row">
                <!--Login Form Start-->
                <div class="col-md-6 col-sm-6" style="margin: 0 auto">
                    <div class="customer-login-register">
                        <div class="form-login-title">
                            <h2>ورود</h2>
                        </div>
                        <div class="login-form">
                            <form  method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-fild">
                                    <p><label> آدرس ایمیل <span class="required">*</span></label></p>
                                    <input name="email" value="" type="email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-fild">
                                    <p><label>رمز عبور <span class="required">*</span></label></p>
                                    <input name="password" value="" type="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="login-submit">
                                    <button type="submit" class="ht-btn black-btn">ورود</button>
                                    <label>
                                        <input class="checkbox" name="rememberme" value="" type="checkbox">
                                        <span>مرا به خاطر بسپار</span>
                                    </label>
                                </div>
                                <div class="lost-password">
                                    <a href="/register">هنوز ثبت نام نکرده ام</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Login Form End-->

            </div>
        </div>
    </div>
    <!--Login Register section end-->



@endsection
