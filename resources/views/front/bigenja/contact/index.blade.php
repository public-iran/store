@extends('front.layout.master')
@section('style')

@endsection
@section('content')
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">تماس</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="index.html">خانه</a></li>
                                <li>تماس</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- contact infor area start -->
    <div class="contact-info-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="left-content-area">
                        <div class="inner-section-title">
                            <span class="subtitle">تماس با ما</span>
                            <h2 class="title">برای دریافت به روز رسانی</h2>
                        </div>
                        <ul>
                            <li>
                                <div class="single-contact-info-item"><!-- single contact info item -->
                                    <div class="icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="content">
                                        <span class="subtitle">دریغ نکنید با ما تماس بگیرید!</span>
                                        <span class="title">{{$setting['tell']}}</span> |
                                        <span class="title">{{$setting['mobile']}}</span>
                                    </div>
                                </div><!-- //.single contact info item -->
                            </li>
                            <li>
                                <div class="single-contact-info-item"><!-- single contact info item -->
                                    <div class="icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="content">
                                        <span class="subtitle">{{$setting['worktime']}}</span>
                                        <span class="title">زمان کار</span>
                                    </div>
                                </div><!-- //.single contact info item -->
                            </li>
                            <li>
                                <div class="single-contact-info-item"><!-- single contact info item -->
                                    <div class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="content">
                                        <span style="margin-top: 11px;display: inline-block;" class="subtitle">{{$setting['address']}}</span>

                                    </div>
                                </div><!-- //.single contact info item -->
                            </li>
                            <li>
                                <div class="single-contact-info-item"><!-- single contact info item -->
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="content">
                                        <span class="subtitle">با ما در تماس باشید</span>
                                        <span class="title">{{$setting['email']}}</span>
                                    </div>
                                </div><!-- //.single contact info item -->
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <img style="width: 100%;" src="{{asset('images/unnamed.jpg')}}">
                </div>
            </div>
        </div>
    </div>
    <!-- contact infor area end -->

    <!-- contact form area start -->
    <section class="contact-form-area gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title-two"><!-- section title two -->
                        <span class="subtitle">در ذهن شما</span>
                        <h2 class="title">تماس بودن همیشه باشد.</h2>
                    </div><!-- //. section title two -->
                </div>
            </div>

                <form class="contact_form"  action="{{route('contact_store')}}" method="post">
                    @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-element margin-bottom-20">
                            <input type="text" name="name" id="first_name" class="input-field" placeholder="نام شما">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-element margin-bottom-20">
                            <input type="text" name="family" id="last_name" class="input-field" placeholder="نام خانوادگی شما">
                            @if ($errors->has('family'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-element margin-bottom-20">
                            <input type="text" name="email" id="email" class="input-field" placeholder="آدرس ایمیل شما">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-element margin-bottom-20">
                            <input type="text" name="title" id="subject" class="input-field" placeholder="موضوع شما">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-element textarea margin-bottom-20">
                            <textarea  id="message" name="message" cols="30" rows="10" placeholder="پیام شما" class="input-field textarea"></textarea>
                            @if ($errors->has('message'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="btn-wrapper">
                    <button type="submit" class="submit-btn">الان ارسال کن</button>
                </div>
            </form>
        </div>
    </section>
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
