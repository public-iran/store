@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/css/userlogin.css')}}">
@endsection
@section('style')
    <style>
        h3{
            font-family: Vazir!important;
        }
        .button{
            background: #7fad39;
            border: 1px solid #7fad39;
            border-radius: 0;
        }
        .button:hover{
            border-color: #7fad39;
        }
        .login_box_area .login_box_img:before{
            background: #7fad39;
        }
        .form-control.is-invalid, .was-validated .form-control:invalid{
            background-position: right calc(23.375em + .1875rem) center;
        }
    </style>
@endsection
@section('content')




<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>وارد شوید</h3>
                    <form class="row login_form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="name"  name="email" value="{{ old('email') }}" placeholder="ایمیل" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ایمیل'">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="name" name="password" placeholder="رمز ورود" onfocus="this.placeholder = ''" onblur="this.placeholder = 'رمز ورود'">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account" style="text-align: right">
                                <input type="checkbox" id="f-option2" name="selector" {{ old('remember') ? 'checked' : '' }}>
                                <label for="f-option2">مرا به خاطر بسپار</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-login w-100">ورود</button>
                            <a href="#">رمز ورود خود را فراموش کرده اید؟</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>حساب جدید</h4>
                        <p>اگر قبلا ثبت نام نکرده اید و حسابی ندارید یک حساب جدید ایجاد کنید</p>
                        <a class="button button-account" href="/register">ایجاد حساب</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->

@endsection
