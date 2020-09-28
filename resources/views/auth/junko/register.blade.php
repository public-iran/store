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
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">خانه</a></li>
                            <li>حساب کاربری</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- customer login start -->
    <div class="customer_login mt-60">
        <div class="container">
            <div class="row">

                <!--register area start-->
                <div class="col-lg-6 col-md-6" style="margin: 0 auto">
                    <div class="account_form register">
                        <h2>ثبت نام</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <p>
                                <label>نام<span>*</span></label>
                                <input name="name" value="" type="text">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>نام خانوادگی<span>*</span></label>
                                <input name="family" value="" type="text">
                                @if ($errors->has('family'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>آدرس ایمیل<span>*</span></label>
                                <input name="email" value="" type="text">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label>رمز عبور <span>*</span></label>
                                <input name="password" value="" type="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </p>
                            <p>
                                <label>تکرار رمز عبور <span>*</span></label>
                                <input name="password_confirmation" value="" type="password">
                            </p>
                            <div class="login_submit">
                                <button type="submit">ثبت نام</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div>


@endsection
