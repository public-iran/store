@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/css/userlogin.css')}}">
@endsection
@section('style')
    <style>
        .text-md-right{
            text-align: left!important;
        }

    </style>
@endsection
@section('content')
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li class='active'>ورود</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in" style="margin: 0 auto;float: unset">
                        <h4 class="">ورود به حساب کاربری</h4>
                        <p class="">سلام، خوش آمدید به حساب کاربری.</p>

                        <form class="row login_form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">آدرس ایمیل <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">رمز عبور <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">مرا بخاطر بسپار!
                                </label>
                                <a href="/register" class="forgot-password pull-left">هنوز ثبت نام نکرده اید؟</a>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">ورود به حساب</button>
                        </form>
                    </div>
                    <!-- Sign-in -->


                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->





@endsection
