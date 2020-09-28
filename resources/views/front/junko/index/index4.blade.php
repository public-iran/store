@extends('front.layout.master')
@section('style')
    <style>
        #owl-main .item{
            height: 332px;
        }
        #owl-main .owl-prev, #owl-main .owl-next{
            top: 6px;
        }
        #owl-main{
            height: 332px;
        }
        .owl-wrapper{
            left: 6px!important;
        }
        .row .single-new-collection-item{
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            overflow: hidden;
            padding-top: 7px;
        }

    </style>
@endsection
@section('content')

    <!-- header area start -->

    @foreach($sliders as $slider)
        @if($slider->position=="top")
    <div class="header-area-three header-bg-three" style="background-image: url({{asset($slider->imgPath)}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-inner "><!-- header inner -->
                        <h1 class="title">{{$slider->title}}</h1>
                        <p class="wow fadeInDown">{{$slider->text}}</p>
                        <div class="btn-wrapper wow fadeInDown">
                            @if($slider->link)
                                <a href="{{$slider->link}}" class="boxed-btn blank">بیشتر بدانید</a>
                            @endif
                        </div>
                    </div><!-- //. header inner -->
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    <div class="process-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 remove-col-padding">
                    <div class="single-process-item-one"><!-- single process item one -->
                        <h4 class="tiel">حمل رایگان</h4>
                        <span class="details">حمل و نقل رایگان در همه منظور</span>
                    </div><!-- //.single process item one -->
                </div>
                <div class="col-lg-4 col-md-6 remove-col-padding">
                    <div class="single-process-item-one border-left-none border-right-none"><!-- single process item one -->
                        <h4 class="tiel">بازگشت وجه</h4>
                        <span class="details">30 روز برای بازگشت وجه</span>
                    </div><!-- //.single process item one -->
                </div>
                <div class="col-lg-4 col-md-6 remove-col-padding">
                    <div class="single-process-item-one"><!-- single process item one -->
                        <h4 class="tiel">پشتیبانی آنلاین</h4>
                        <span class="details">پشتیبانی 24 ساعته هر روز</span>
                    </div><!-- //.single process item one -->
                </div>
            </div>
        </div>
    </div>
    <!-- best seller area two start -->
    <div class="best-seller-area-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="best-seller-two-filter-menu">
                        <ul class="nav nav-tabs"  role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" id="bestseller-tab" data-toggle="tab" href="#bestseller" role="tab" aria-controls="bestseller" aria-selected="false">جدیدترین ها</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="best-seller-two" >
                        <div class="tab-content" >
                            <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                                <div class="row">
                                    @foreach($products_new as $item)
                                        <div class="col-lg-3 col-md-6">
                                            <div class="single-new-collection-item" style=""><!-- single new collections -->
                                                <div class="thumb">
                                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                    <div class="hover">
                                                        @if($item->depot>0)
                                                            <a class="addtocart" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد</a>
                                                        @else
                                                            <a class="addtocartt">ناموجود</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="content" style="border: none;padding: 10px 0 10px 0;">
                                                    <a href="/product/{{$item->slug}}"><h4 class="title">{{str_limit($item->title,37)}}</h4></a>
                                                    @if($item->discount>0)
                                                        <div class="price"><span class="sprice">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <del class="dprice">{{number_format($item->price)}} تومان</del></div>
                                                    @else
                                                        <div class="price"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                                    @endif
                                                </div>
                                            </div><!-- //. single new collections  -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach($sliders as $slider)
        @if($slider->position=="center")
            <section class="ladies-cloths-area ladies-cloths-bg" style="background-image: url({{$slider->imgPath}});">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-6">
                            <div class="ladies-cloths-content-area"><!-- ladies cloths content area -->
                                {{--  <div class="countdown-area"><!-- countdown area start -->
                                      <ul>
                                          <li>
                                              <div class="single-countdown-box"><!-- single countdown box -->
                                                  <div class="day" id="days">03</div>
                                                  <span class="title">روز</span>
                                              </div><!-- //.single countdown box -->
                                          </li>
                                          <li>
                                              <div class="single-countdown-box"><!-- single countdown box -->
                                                  <div class="day" id="hours">12</div>
                                                  <span class="title">ساعت</span>
                                              </div><!-- //.single countdown box -->
                                          </li>
                                          <li>
                                              <div class="single-countdown-box"><!-- single countdown box -->
                                                  <div class="day" id="miniutes">17</div>
                                                  <span class="title">دقیقه</span>
                                              </div><!-- //.single countdown box -->
                                          </li>
                                          <li>
                                              <div class="single-countdown-box"><!-- single countdown box -->
                                                  <div class="day" id="seconds">45</div>
                                                  <span class="title">ثانیه</span>
                                              </div><!-- //.single countdown box -->
                                          </li>
                                      </ul>
                                  </div><!-- //. countdown area -->--}}
                                <div class="bottom-content">
                                    <h3 class="title">{{$slider->title}}</h3>
                                    <p>{{$slider->text}}</p>
                                    @if($slider->link)
                                        <a href="{{$slider->link}}" class="boxed-btn">ادامه</a>
                                    @endif
                                </div>
                            </div><!-- //.ladies cloths content area -->
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
    <!-- speakers area end -->

    <!-- best seller area four start -->
    <div class="best-seller-area-four">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="best-seller-two-filter-menu">
                        <ul class="nav nav-tabs"  role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" id="bestseller-tab_2" data-toggle="tab" href="#bestseller_2" role="tab" aria-controls="bestseller_2" aria-selected="false">محصولات دارای تخفیف</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="best-seller-four">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="popular_2" role="tabpanel" aria-labelledby="popular-tab_2">
                                <div class="row">
                                    @foreach($products_discount as $item)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-rated-box-two"><!-- single rated box two -->
                                            <div class="thumb">
                                                <img style="max-width: 130px" src="{{asset($item->image)}}" alt="{{$item->title}}">
                                            </div>
                                            <div class="content" style="padding: 22px 129px 27px 0;">
                                               {{-- <ul class="ratings">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>--}}
                                                <a href="/product/{{$item->slug}}"><h4 class="title">{{str_limit($item->title,40)}}</h4></a>
                                                @if($item->discount>0)
                                                    <div class="price"><span class="sprice">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <del class="dprice">{{number_format($item->price)}} تومان</del></div>
                                                @else
                                                    <div class="price"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                                @endif
                                            </div>
                                        </div><!-- //.single rated box two -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- best seller area four end -->

    <!-- banner add area two start -->
    <div class="banner-add-area">
        <div class="container">
            <div class="row">
                @foreach($banners as $banner)
                    @if($banner->position=="center")
                <div class="col-lg-6" style="margin-bottom: 20px">
                    <div class="banner-inner-wrapper">
                        <a href="{{$banner->link}}">
                            <img src="{{asset($banner->imgPath)}}" alt="{{$banner->alt}}">
                        </a>
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- banner add area two end -->
    <!-- best seller area two start -->
    <div class="best-seller-area-five">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="best-seller-two-filter-menu">
                        <ul class="nav nav-tabs"  role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" id="bestseller-tab_3" data-toggle="tab" href="#bestseller_3" role="tab" aria-controls="bestseller_3" aria-selected="false">پربازدیدترین ها</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="best-seller-two" >
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="popular_3" role="tabpanel" aria-labelledby="popular-tab_3">
                                <div class="row">
                                    @foreach($products_view as $item)
                                        <div class="col-lg-3 col-md-6">
                                            <div class="single-new-collection-item" style=""><!-- single new collections -->
                                                <div class="thumb">
                                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                    <div class="hover">
                                                        @if($item->depot>0)
                                                            <a class="addtocart" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد</a>
                                                        @else
                                                            <a class="addtocartt">ناموجود</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="content" style="border: none;padding: 10px 0 10px 0;">
                                                    <a href="/product/{{$item->slug}}"><h4 class="title">{{str_limit($item->title,37)}}</h4></a>
                                                    @if($item->discount>0)
                                                        <div class="price"><span class="sprice">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <del class="dprice">{{number_format($item->price)}} تومان</del></div>
                                                    @else
                                                        <div class="price"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                                    @endif
                                                </div>
                                            </div><!-- //. single new collections  -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- best seller area two end -->



@endsection
