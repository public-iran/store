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
    <div class="header-area-two header-bg-2" style="background-image: url({{asset($slider->imgPath)}});">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-8">
                    <div class="header-inner "><!-- header inner -->
                        <h1 class="title">{{$slider->title}}</h1>
                        <p class="wow fadeInDown">{{$slider->text}}</p>
                        <div class="btn-wrapper">
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
    <!-- header area end -->

    <!-- protional area one start -->
    <div class="promotional-area-one">
        <div class="container-fluid">
            <div class="row">
                @foreach($banners as $banner)
                    @if($banner->position=="top")
                <div class="col-lg-6">
                    <div class="single-promotional-item left-text"><!-- single promotional item  -->
                        <div class="img-wrapper promotional-bg-5" style="background-image: url({{asset($banner->imgPath)}});">
                            <div class="hover">
                                <h3 class="title wow fadeIn" style="visibility: visible; animation-name: fadeIn;">{{$banner->title}}</h3>
                                <div class="btn-wrapper ">
                                    @if($banner->link)
                                    <a href="{{$banner->title}}" class="boxed-btn blank">ادامه</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- //.single promotional item  -->
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- protional area one end -->

    <!-- protional product showcase start -->
    <div class="promotional-product-showcase home-two">
        <div class="container-fluid">
            <div class="row">
                @foreach($products_new as $item)
                    <div class="col-xl-2 col-lg-3 col-md-6">
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
                                    <div class="price" style="height: 52px"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                @endif
                            </div>
                        </div><!-- //. single new collections  -->
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- protional product showcase end -->

    <!-- promotional area two start -->
    <div class="promotional-area-two home-two">
        <div class="container-fluid">
            <div class="row">
                @foreach($banners as $banner)
                    @if($banner->position=="center")
                        <div class="col-lg-6" style="margin-bottom: 20px">
                            <div class="single-promotional-item left-text"><!-- single promotional item  -->
                                <div class="img-wrapper promotional-bg-5" style="background-image: url({{asset($banner->imgPath)}});">
                                    <div class="hover">
                                        <h3 class="title wow fadeIn" style="visibility: visible; animation-name: fadeIn;">{{$banner->title}}</h3>
                                        <div class="btn-wrapper ">
                                            @if($banner->link)
                                                <a href="{{$banner->title}}" class="boxed-btn blank">ادامه</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div><!-- //.single promotional item  -->
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
    <!-- promotional area two end -->

    <!-- promotional center area start -->

    @foreach($sliders as $slider)
        @if($slider->position=="bottom")
    <div class="promotional-center-area promotional-center-area-bg" style="background-image: url({{asset($slider->imgPath)}});">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="single-promotional-cetner-item"><!-- single promotional item  -->
                        <h3 class="title">{{$slider->title}}</h3>
                        <p class="wow fadeInDown">{{$slider->text}}</p>
                        <div class="btn-wrapper  wow fadeInDown">
                            @if($slider->link)
                                <a href="{{$slider->link}}" class="boxed-btn blank">بیشتر بدانید</a>
                            @endif
                        </div>
                    </div><!-- //.single promotional item  -->
                </div>
            </div>
        </div>
    </div>
        @endif
    @endforeach
    <!-- promotional center area end -->
    <!-- protional product showcase start -->
    <div class="promotional-product-showcase-two">
        <div class="container-fluid">
            <div class="row">
                @foreach($products_discount as $item)
                    <div class="col-xl-2 col-lg-3 col-md-6">
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
                                    <div class="price" style="height: 52px"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                @endif
                            </div>
                        </div><!-- //. single new collections  -->
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- protional product showcase end -->

    <!-- brand logo carousel area one start -->
    <div class="brand-logo-carousel-area-one">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-logo-carousel-one" id="brand-logo-carousel-one"><!-- brand logo carousel one -->
                       @foreach($brands as $brand)
                        <div class="single-brang-logo-carousel-one-item">
                            <a href="{{$brand->link}}">
                                <img src="{{asset($brand->imgPath)}}" alt="{{$brand->alt}}">
                            </a>
                        </div>
                        @endforeach
                    </div><!-- //.brand logo carousel one -->
                </div>
            </div>
        </div>
    </div>
    <!-- brand logo carousel area one end -->

    <!-- header area start -->


  
@endsection
