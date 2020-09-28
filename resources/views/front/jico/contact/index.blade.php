@extends('front'.theme_name().'layout.master')
@section('style')

@endsection
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h2>تماس با ما</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="index.html">خانه</a></li>
                            <li>تماس با ما</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!--Contact section start-->
    <div class="conact-section section sb-border pt-95 pt-lg-75 pt-md-65 pt-sm-55 pt-xs-45 pb-100 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="contact-information">
                        <h3>با ما تماس بگیرید</h3>
                        <ul>
                            <li>
                                <span class="icon"><i class="fa fa-home"></i></span>
                                <h4 class="text">نشانی</h4>
                                <p>{{$setting['address']}}</p>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-envelope-open-o"></i></span>
                                <h4 class="text">پست الکترونیک</h4>
                                <p>{{$setting['email']}}<br>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-phone"></i></span>
                                <h4 class="text">تلفن</h4>
                                <p>موبایل: {{$setting['mobile']}} <br>
                                    خط تلفن ثابت: {{$setting['tell']}}  </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="contact-form-wrap">
                        <h3 class="contact-title">پیام خود را برای ما بگویید</h3>
                            <form class="contact-form"  action="{{route('contact_store')}}" method="post">
                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-form-style mb-20">
                                        <input name="name" placeholder="نام*" type="text">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="contact-form-style mb-20">
                                        <input name="family" placeholder="نام خانوادگی*" type="text">
                                        @if ($errors->has('family'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="contact-form-style mb-20">
                                        <input name="email" placeholder="پست الکترونیک*" type="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-form-style mb-20">
                                        <input name="title" placeholder="موضوع*" type="text">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-form-style">
                                        <textarea name="message" placeholder="پیام خود را اینجا بنویسید .."></textarea>
                                        @if ($errors->has('message'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                        @endif
                                        <button type="submit" class="ht-btn black-btn"><span>پیام فرستادن</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Contact section end-->



@endsection
@section('script')
    <script>
        $('.submit-btn').click(function () {
            $('form').submit();
        })
    </script>
    @if(session('save_comment'))
        <script>
            alertify.set('notifier','position', 'bottom-left');
            alertify.success('پیام شما با موفقیت ارسال شد!');
        </script>
    @endif

@endsection
@php
    Session::forget('save_comment');
@endphp
