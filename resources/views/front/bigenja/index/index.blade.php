@extends('front'.theme_name().'layout.master')
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
    <div class="header-area header-bg" style="background-image: url({{asset($slider->imgPath)}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
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

    <!-- new product area start -->
    <section class="new-product-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="section-title"><!-- section title -->
                        <span class="subtitle">محصولات جدید</span>
                        <h2 class="title">مجموعه های جدید</h2>
                    </div><!-- //. section title -->
                </div>
            </div>
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
                            <div class="content" style="border: none">
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
    </section>
    <!-- new product area end -->

    <!-- ladies cloths area start -->
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
    <!-- ladies cloths area end -->

    <!-- best sellers area start -->
    <section class="best-sellers-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="section-title"><!-- section title -->
                        <h2 class="title">پر فروش ترین ها</h2>
                    </div><!-- //. section title -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="best-sellter-filter">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="bestseller" role="tabpanel" aria-labelledby="bestseller-tab">
                                <div class="row">
                                    @foreach($sale_product as $item)
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
                                                <div class="content" style="border: none">
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
                            <div class="tab-pane fade" id="trendeseller" role="tabpanel" aria-labelledby="trendeseller-tab">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item "><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/01.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">کفش</span>
                                                <a href="product-details.html"><h4 class="title">کفش تیره</h4></a>
                                                <div class="price"><span class="sprice">37.00 تومان</span> <del class="dprice">83.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/02.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">لوازم جانبی</span>
                                                <a href="product-details.html"><h4 class="title">میلو هوروبرد</h4></a>
                                                <div class="price"><span class="sprice">83.00 تومان</span> <del class="dprice">120.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/03.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">کفش</span>
                                                <a href="product-details.html"> <h4 class="title">کفش پیاده روی</h4></a>
                                                <div class="price"><span class="sprice">78.00 تومان</span> <del class="dprice">83.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/04.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">ورزشی</span>
                                                <a href="product-details.html"><h4 class="title">تی شرت سیاه برک</h4></a>
                                                <div class="price"><span class="sprice">23.00 تومان</span> <del class="dprice">45.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/05.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">کلاه</span>
                                                <a href="product-details.html"> <h4 class="title">کلاه نجاری</h4></a>
                                                <div class="price"><span class="sprice">23.00 تومان</span> <del class="dprice">45.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/06.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">دوچرخه</span>
                                                <a href="product-details.html"><h4 class="title">دوچرخه معمولی</h4></a>
                                                <div class="price"><span class="sprice">120.00 تومان</span> <del class="dprice">350.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/07.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">موتور</span>
                                                <a href="product-details.html"><h4 class="title">دوچرخه موتوری</h4></a>
                                                <div class="price"><span class="sprice">980.00 تومان</span> <del class="dprice">1500.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/08.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">الکترونیکی</span>
                                                <a href="product-details.html"><h4 class="title">عنوان محصول</h4></a>
                                                <div class="price"><span class="sprice">47.00 تومان</span> <del class="dprice">99.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item "><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/01.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">کفش</span>
                                                <a href="product-details.html"><h4 class="title">کفش تیره</h4></a>
                                                <div class="price"><span class="sprice">37.00 تومان</span> <del class="dprice">83.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/02.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">لوازم جانبی</span>
                                                <a href="product-details.html"><h4 class="title">میلو هوروبرد</h4></a>
                                                <div class="price"><span class="sprice">83.00 تومان</span> <del class="dprice">120.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/03.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">کفش</span>
                                                <a href="product-details.html"> <h4 class="title">کفش پیاده روی</h4></a>
                                                <div class="price"><span class="sprice">78.00 تومان</span> <del class="dprice">83.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/04.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">ورزشی</span>
                                                <a href="product-details.html"><h4 class="title">تی شرت سیاه برک</h4></a>
                                                <div class="price"><span class="sprice">23.00 تومان</span> <del class="dprice">45.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/05.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">کلاه</span>
                                                <a href="product-details.html"> <h4 class="title">کلاه نجاری</h4></a>
                                                <div class="price"><span class="sprice">23.00 تومان</span> <del class="dprice">45.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/06.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">دوچرخه</span>
                                                <a href="product-details.html"><h4 class="title">دوچرخه معمولی</h4></a>
                                                <div class="price"><span class="sprice">120.00 تومان</span> <del class="dprice">350.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/07.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">موتور</span>
                                                <a href="product-details.html"><h4 class="title">دوچرخه موتوری</h4></a>
                                                <div class="price"><span class="sprice">980.00 تومان</span> <del class="dprice">1500.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="single-new-collection-item"><!-- single new collections -->
                                            <div class="thumb">
                                                <img src="bigenja/img/new-collections/08.jpg" alt="new collcetion image">
                                                <div class="hover">
                                                    <a href="#" class="addtocart">افزودن به سبد</a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="category">الکترونیکی</span>
                                                <a href="product-details.html"><h4 class="title">عنوان محصول</h4></a>
                                                <div class="price"><span class="sprice">47.00 تومان</span> <del class="dprice">99.00 تومان</del></div>
                                            </div>
                                        </div><!-- //. single new collections  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- best sellers area end -->

    <!-- free shipping area start -->
    @foreach($sliders as $slider)
        @if($slider->position=="bottom")
    <section class="free-shipping-area shipping-bg" style="background-image: url({{$slider->imgPath}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content-area"><!-- left content area -->
                        <div class="icon">
                          {{--  <i class="fas fa-shipping-fast"></i>--}}
                        </div>
                        <h2 class="title">{{$slider->title}}</h2>
                    </div><!-- //. left contetnt area -->
                    <div class="right-content-area"><!-- right content aera -->
                        <div class="btn-wrapper">
                            @if($slider->link)
                                <a href="{{$slider->link}}" class="boxed-btn">ادامه</a>
                            @endif
                        </div>
                    </div><!-- //. right content area -->
                </div>
            </div>
        </div>
    </section>
        @endif
    @endforeach
    <!-- free shipping area end -->

    <!-- feature area one start -->
    <section class="feature-one-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-featured-one-item"><!-- single featured item -->
                        <div class="inner-item">
                            <h3 class="title">ویژه</h3>
                        </div>
                        <ul>
                            @foreach($spacial_product as $item)
                            <li>
                                <div class="single-rated-box-one "><!-- single rated box one -->
                                    <div class="thumb">
                                        <img style="max-width: 125px;margin: 6px 2px 0 0;" src="{{asset($item->image)}}" alt="{{$item->title}}">
                                    </div>
                                    <div class="content" style="border-right: 2px solid #e5e5e5;border-radius: 5px">
                                     {{--   <ul class="ratings">
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
                                </div><!-- //.single rated box one -->
                            </li>
                                @endforeach
                        </ul>
                    </div><!-- //.single featured item -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-featured-one-item"><!-- single featured item -->
                        <div class="inner-item">
                            <h3 class="title">پربازدیدترین</h3>
                        </div>
                        <ul>
                            @foreach($products_view as $item)
                                <li>
                                    <div class="single-rated-box-one "><!-- single rated box one -->
                                        <div class="thumb">
                                            <img style="max-width: 125px;margin: 6px 2px 0 0;" src="{{asset($item->image)}}" alt="{{$item->title}}">
                                        </div>
                                        <div class="content" style="border-right: 2px solid #e5e5e5;border-radius: 5px">
                                            {{--   <ul class="ratings">
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
                                    </div><!-- //.single rated box one -->
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- //.single featured item -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-featured-one-item"><!-- single featured item -->
                        <div class="inner-item">
                            <span class="subtitle">محصول ویژه</span>
                            <h3 class="title">پیشنهاد تبلیغ</h3>
                        </div>
                        <ul>
                            @foreach($banners as $banner)
                                @if($banner->position=="bottom")
                            <li>
                                <div class="banner-add">
                                    <a href="{{$banner->link}}"><img src="{{$banner->imgPath}}" alt="{{$banner->alt}}"></a>
                                </div>
                            </li>
                                @endif
                            @endforeach
                        </ul>
                    </div><!-- //.single featured item -->
                </div>
            </div>
        </div>
    </section>
    <!-- feature area one end -->



@endsection
