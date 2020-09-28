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
                <div class="login_form_inner register_form_inner">
                    <h3>ایجاد حساب</h3>
                    <form class="row login_form" action="{{ route('register') }}" method="POST" id="register_form" >
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" placeholder="نام" onfocus="this.placeholder = ''" onblur="this.placeholder = 'نام'">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control{{ $errors->has('family') ? ' is-invalid' : '' }}" id="family" name="family" value="{{ old('family') }}" placeholder="نام خانوادگی" onfocus="this.placeholder = ''" onblur="this.placeholder = 'نام خانوادگی'">
                            @if ($errors->has('family'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="ایمیل" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ایمیل'">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder=" رمز ورود" onfocus="this.placeholder = ''" onblur="this.placeholder = 'رمز ورود'">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="تکرار رمز ورود" onfocus="this.placeholder = ''" onblur="this.placeholder = 'تکرار رمز ورود'">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account" style="text-align: right">
                                <input type="checkbox" id="f-option2" name="selector" {{ old('remember') ? 'checked' : '' }}>
                                <label for="f-option2">مرا به خاطر بسپار</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-register w-100">ایجاد حساب</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>ورود به حشاب </h4>
                        <p>اگر قبلا ثبت نام کرده اید از لینک زیر وارد شوید</p>
                        <a class="button button-account" href="/login">ورود</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
@endsection
