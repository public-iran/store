@extends('front'.theme_name().'layout.master')
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
                            <li>تماس با ما</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--contact area start-->
    <div class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                        <h3>تماس با ما</h3>
                        <ul>
                            <li><i class="fa fa-fw fa-map-marker"></i> {{$setting['address']}}</li>
                            <li><i class="fa fa-fw fa-phone"></i> <span class="ltr-text">{{$setting['tell']}}</span> ، <span class="ltr-text">{{$setting['mobile']}}</span></li>
                            <li><i class="fa fa-fw fa-envelope-o"></i> <a>{{$setting['email']}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message form">
                        <h3>با ما در میان بگذارید</h3>
                            <form class="contact-form"  action="{{route('contact_store')}}" method="post">
                                @csrf
                            <p>
                                <label> نام شما (الزامی)</label>
                                <input name="name" placeholder="نام*" type="text" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label> نام خانوادگی شما (الزامی)</label>
                                <input name="family" placeholder="نام خانوادگی*" type="text" required>
                                @if ($errors->has('family'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>

                                <label> ایمیل شما (الزامی)</label>
                                <input name="email" placeholder="* ایمیل" type="email" dir="ltr" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <p>
                                <label> موضوع</label>
                                <input name="title" placeholder="موضوع" type="text" >
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <div class="contact_textarea">
                                <label> پیام شما</label>
                                <textarea placeholder="پیام *" name="message" class="form-control2" required></textarea>
                            </div>
                                @if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            <button type="submit"> ارسال</button>
                            <p class="form-messege"></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>




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
