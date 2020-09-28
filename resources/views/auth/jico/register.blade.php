@extends('front'.theme_name().'layout.master')

@section('style')

    <style>
        .invalid-feedback{
            font-size: 12px;
            color: red;
        }
    </style>
@endsection
@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h2>ثبت نام</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li> ثبت نام</li>
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

                <!--Register Form Start-->
                <div class="col-md-6 col-sm-6" style="margin: 0 auto">
                    <div class="customer-login-register register-pt-0">
                        <div class="form-register-title">
                            <h2>ثبت نام</h2>
                        </div>
                        <div class="register-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-fild">
                                    <p><label>نام <span class="required">*</span></label></p>
                                    <input name="name" value="" type="text">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-fild">
                                    <p><label>نام خانوادگی <span class="required">*</span></label></p>
                                    <input name="family" value="" type="text">
                                    @if ($errors->has('family'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-fild">
                                    <p><label>نام کاربری یا آدرس ایمیل <span class="required">*</span></label></p>
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
                                <div class="form-fild">
                                    <p><label>تکرار رمز عبور <span class="required">*</span></label></p>
                                    <input name="password_confirmation" value="" type="password">
                                </div>
                                <div class="lost-password">

                                </div>
                                <div class="register-submit">
                                    <button type="submit" class="ht-btn black-btn">ثبت نام</button>
                                    <a href="/login" style="float: left;color: #a43d21;">قبلا ثبت نام کرده ام</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Register Form End-->
            </div>
        </div>
    </div>
    <!--Login Register section end-->



@endsection
