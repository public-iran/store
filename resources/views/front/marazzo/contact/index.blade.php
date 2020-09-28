@extends('front'.theme_name().'layout.master')
@section('style')

@endsection
@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li class='active'>تماس با ما</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>


    <div class="container">
        <div class="contact-page">
            <div class="row">

                <div class="col-md-8 contact-form">
                    <div class="col-md-12 contact-title">
                        <h4>فرم تماس با ما</h4>
                    </div>
                    <form id="contact-form" action="{{route('contact_store')}}" method="post">
                        @csrf
                    <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">نام شما <span>*</span></label>
                                <input type="email" name="name" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">نام خانوادگی شما <span>*</span></label>
                                <input type="email" name="family" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                                @if ($errors->has('family'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="col-md-4">
                        <form class="register-form" role="form">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">آدرس ایمیل <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">دیدگاه تان<span>*</span></label>
                                <textarea name="message" class="form-control unicase-form-control" id="exampleInputComments"></textarea>
                                @if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="col-md-12 outer-bottom-small m-t-20">
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">ارسال پیام</button>
                    </div>
                    </form>
                </div>
                <div class="col-md-4 contact-info">
                    <div class="contact-title">
                        <h4>اطلاعات</h4>
                    </div>
                    <div class="clearfix address">
                        <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                        <span class="contact-span">{{$setting['address']}}</span>
                    </div>
                    <div class="clearfix phone-no">
                        <span class="contact-i"><i class="fa fa-mobile"></i></span>
                        <span class="contact-span">{{$setting['tell']}} <br>{{$setting['mobile']}}</span>
                    </div>
                    <div class="clearfix email">
                        <span class="contact-i"><i class="fa fa-envelope"></i></span>
                        <span class="contact-span"><a href="#">{{$setting['email']}}</a></span>
                    </div>
                </div>
            </div>
            <!-- /.contact-page -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">

            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

                    <!--/.item-->
                    @foreach($brands as $brand)
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{asset($brand->imgPath)}}" src="{{asset('marazzo/images/blank.gif')}}" alt="">
                        </a>
                    </div>
                @endforeach

                </div>
                <!-- /.owl-carousel #logo-slider -->
            </div>
            <!-- /.logo-slider-inner -->

        </div>
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>

@endsection
@section('script')
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
