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
        .invalid-feedback{
            font-size: 12px;
            color: red;
        }
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li class='active'>ثبت نام</li>
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

                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account" style="margin: 0 auto;float: unset">
                        <h4 class="checkout-subtitle">ایجاد حساب کاربری</h4>
                        <p class="text title-tag-line">حساب کاربری خودتان را بسازید.</p>

                            <form class="register-form outer-top-xs" action="{{ route('register') }}" method="POST" id="register_form" >
                                @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">آدرس ایمیل <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">نام <span>*</span></label>
                                <input type="text" name="name" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                                <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">نام خانوادگی <span>*</span></label>
                                <input type="text" name="family" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @if ($errors->has('family'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">رمز عبور <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">تکرار رمز عبور <span>*</span></label>
                                <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">ثبت نام</button>
                        </form>


                    </div>
                    <!-- create a new account -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->



@endsection
