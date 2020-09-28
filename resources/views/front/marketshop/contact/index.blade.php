@extends('front'.theme_name().'layout.master')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->

            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    <h1 class="title">تماس با ما</h1>
                    <h3 class="subtitle">محل ما</h3>
                    <div class="row">
                        <div class="col-sm-3"><img style="background-color: #dedede;" src="{{asset($setting['logo'])}}" alt="قالب مارکت شاپ" title="قالب مارکت شاپ" class="img-thumbnail" /></div>
                        <div class="col-sm-3"><strong>آدرس</strong><br />
                            <address>{{$setting['address']}}</address>
                        </div>
                        <div class="col-sm-3"><strong>شماره تلفن</strong><br>
                            {{$setting['tell']}}<br />
                            <br />
                            <strong>موبایل</strong><br>
                            {{$setting['mobile']}}</div>
                        <div class="col-sm-3"> <strong>ساعات کار</strong><br />
                            {{$setting['worktime']}}<br />
                           </div>
                    </div>
                       <form class="form-horizontal" action="{{route('contact_store')}}" method="post">
                            @csrf
                        <fieldset>
                            <h3 class="subtitle">با ما ارتباط برقرار کنید</h3>
                            <div class="form-group required">
                                <label class="col-md-2 col-sm-3 control-label" for="input-name">نام شما</label>
                                <div class="col-md-10 col-sm-9">
                                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 col-sm-3 control-label" for="input-email">آدرس ایمیل</label>
                                <div class="col-md-10 col-sm-9">
                                    <input type="text" name="email" value="" id="input-email" class="form-control" />
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">پرسش</label>
                                <div class="col-md-10 col-sm-9">
                                    <textarea name="message" rows="10" id="input-enquiry" class="form-control"></textarea>
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">
                                <input class="btn btn-primary" type="submit" value="ارسال" />
                            </div>
                        </div>
                    </form>
                </div>
            {{--    <aside id="column-right" class="col-sm-3 hidden-xs">
                    <div class="list-group">
                        <h2 class="subtitle">محتوای سفارشی</h2>
                        <p>این یک بلاک محتواست. هر نوع محتوایی شامل html، نوشته یا تصویر را میتوانید در آن قرار دهید. </p>
                        <p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                    </div>
                    <div class="banner owl-carousel">
                        <div class="item"> <a href="#"><img src="image/banner/small-banner1-265x350.jpg" alt="small banner" class="img-responsive" /></a> </div>
                        <div class="item"> <a href="#"><img src="image/banner/small-banner-265x350.jpg" alt="small banner1" class="img-responsive" /></a> </div>
                    </div>
                </aside>--}}
                <!--Middle Part End -->
            </div>
        </div>
    </div>


@endsection
