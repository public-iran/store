@extends('front'.theme_name().'layout.master')
@section('style_link')
@endsection
@section('style')

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
                <!--login area start-->
                <div class="col-lg-6 col-md-6" style="margin: 0 auto">
                    <div class="account_form">
                        <h2>ورود</h2>
                        <form  method="POST" action="{{ route('login') }}">
                            @csrf
                            <p>
                                <label> آدرس ایمیل<span>*</span></label>
                                <input name="email" value="" type="email">
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
                            <div class="login_submit">
                                <a href="/register">هنوز ثبت نام نکرده ام</a>
                                <label for="remember">
                                    <input id="remember" type="checkbox"> به خاطر سپاری
                                </label>
                                <button type="submit">ورود</button>

                            </div>

                        </form>
                    </div>
                </div>
                <!--login area start-->


            </div>
        </div>
    </div>
    <!-- customer login end -->


@endsection
