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
    <!--slider section start-->
    <div class="hero-section section position-relative">
        <div class="hero-slider section">

            <!--Hero Item start-->
            @foreach($sliders as $slider)
            <div class="hero-item bg-image" data-bg="{{asset($slider->imgPath)}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">

                            <!--Hero Content start-->
                            <div class="hero-content-2 center">
                                <h1>{{$slider->title}}</h1>
                                <h5>{{$slider->text}}</h5>
                                @if($slider->link)
                                <a href="{{$slider->link}}" class="ht-btn white-btn">بیشتر</a>
                                @endif
                            </div>
                            <!--Hero Content end-->

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!--Hero Item end-->

        </div>
    </div>
    <!--slider section end-->

    <!--Categories section start-->
    <div class="categories-section section bg_color--3 pt-70 pt-lg-50 pt-md-40 pt-sm-30 pt-xs-20 pb-95 pb-lg-75 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">

                @foreach($categories_image as $category)
                        <div class="col-xl-2 col-md-4 col-sm-6 mt-30" >
                            <div class="single-categories-item" style="padding-top: 0;">
                                    <a href="shop?cat={{$category->slug}}">  <img src="{{asset($category->imgPath)}}" alt="{{$category->name}}"></a>
                            </div>
                        </div>
            @endforeach


            </div>
        </div>
    </div>
    <!--Categories section end-->

    <!--Product section start-->
    <div class="product-section section pt-75 pt-lg-55 pt-md-45 pt-sm-35 pt-xs-20 pb-55 pb-lg-35 pb-md-25 pb-sm-15 pb-xs-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-30 pt-20">
                        <h1>محصولات برتر ما</h1>
                    </div>
                    <!-- Product Tab Menu Start -->
                    <div class="product-tab-menu">
                        <ul class="nav justify-content-center">
                            <li><a class="active show" data-toggle="tab" href="#recent">جدیدترین</a></li>
                            <li><a data-toggle="tab" href="#toprated" class="">پربازدیدترین</a></li>
                            <li><a data-toggle="tab" href="#featured" class="">پرفروش ترین</a></li>
                            <li><a data-toggle="tab" href="#trending" class="">تخفیف</a></li>
                        </ul>
                    </div>
                    <!-- Product Tab Menu Start -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div id="recent" class="tab-pane fade show active">
                            <div class="row product-slider">
                            <?php
                                            $i=1;
                                            foreach($products_new as $item) {
                                                if ($i % 5 == 0) {?>
                            </div>
                            <div class="row product-slider">
                                <?php } ?>

                                <div class="col-lg-12">
                                    <!--  Single Grid product Start -->
                                    <div class="single-grid-product mb-40">
                                        <div class="product-image">
                                            @if($item->discount>0)
                                                <div class="product-label">
                                                    <span class="sale">{{$item->discount}}%</span>
                                                </div>
                                            @endif
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" class="img-fluid" alt="{{$item->title}}">
                                            </a>

                                            <div class="product-action d-flex justify-content-between">
                                                @if($item->depot>0)
                                                    <a class="product-btn" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد خرید</a>
                                                @else
                                                    <a class="product-btn">ناموجود</a>
                                                @endif
                                                <ul class="d-flex">
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @else
                                                        <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده "><i class="lnr lnr-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"> <a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                            <div class="product-category-rating">
                                                @if($item->discount>0)
                                                    <p class="product-price rtl" style="text-decoration: line-through;">{{number_format($item->price)}} تومان </p>
                                                    <p class="product-price rtl">{{number_format($item->price*(100-$item->discount)/100)}} تومان</p>
                                                @else
                                                    <p class="product-price rtl">{{number_format($item->price)}} تومان </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <!--  Single Grid product End -->
                                </div>
                                <?php $i++; } ?>
                            </div>
                        </div>

                        <div id="toprated" class="tab-pane fade">
                            <div class="row product-slider">
                                <?php
                                $i=1;
                                foreach($products_view as $item) {
                                if ($i % 5 == 0) {?>
                            </div>
                            <div class="row product-slider">
                                <?php } ?>

                                <div class="col-lg-12">
                                    <!--  Single Grid product Start -->
                                    <div class="single-grid-product mb-40">
                                        <div class="product-image">
                                            @if($item->discount>0)
                                                <div class="product-label">
                                                    <span class="sale">{{$item->discount}}%</span>
                                                </div>
                                            @endif
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" class="img-fluid" alt="{{$item->title}}">
                                            </a>

                                            <div class="product-action d-flex justify-content-between">
                                                @if($item->depot>0)
                                                    <a class="product-btn" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد خرید</a>
                                                @else
                                                    <a class="product-btn">ناموجود</a>
                                                @endif
                                                <ul class="d-flex">
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @else
                                                        <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده "><i class="lnr lnr-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"> <a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                            <div class="product-category-rating">
                                                @if($item->discount>0)
                                                    <p class="product-price rtl" style="text-decoration: line-through;">{{number_format($item->price)}} تومان </p>
                                                    <p class="product-price rtl">{{number_format($item->price*(100-$item->discount)/100)}} تومان</p>
                                                @else
                                                    <p class="product-price rtl">{{number_format($item->price)}} تومان </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <!--  Single Grid product End -->
                                </div>
                                <?php $i++; } ?>
                            </div>
                        </div>
                        <div id="featured" class="tab-pane fade">
                            <div class="row product-slider">
                                <?php
                                $i=1;
                                foreach($sale_product as $item) {
                                if ($i % 5 == 0) {?>
                            </div>
                            <div class="row product-slider">
                                <?php } ?>

                                <div class="col-lg-12">
                                    <!--  Single Grid product Start -->
                                    <div class="single-grid-product mb-40">
                                        <div class="product-image">
                                            @if($item->discount>0)
                                                <div class="product-label">
                                                    <span class="sale">{{$item->discount}}%</span>
                                                </div>
                                            @endif
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" class="img-fluid" alt="{{$item->title}}">
                                            </a>

                                            <div class="product-action d-flex justify-content-between">
                                                @if($item->depot>0)
                                                    <a class="product-btn" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد خرید</a>
                                                @else
                                                    <a class="product-btn">ناموجود</a>
                                                @endif
                                                <ul class="d-flex">
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @else
                                                        <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده "><i class="lnr lnr-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"> <a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                            <div class="product-category-rating">
                                                @if($item->discount>0)
                                                    <p class="product-price rtl" style="text-decoration: line-through;">{{number_format($item->price)}} تومان </p>
                                                    <p class="product-price rtl">{{number_format($item->price*(100-$item->discount)/100)}} تومان</p>
                                                @else
                                                    <p class="product-price rtl">{{number_format($item->price)}} تومان </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <!--  Single Grid product End -->
                                </div>
                                <?php $i++; } ?>
                            </div>
                        </div>
                        <div id="trending" class="tab-pane fade">
                            <div class="row product-slider">
                                <?php
                                $i=1;
                                foreach($products_discount as $item) {
                                if ($i % 5 == 0) {?>
                            </div>
                            <div class="row product-slider">
                                <?php } ?>

                                <div class="col-lg-12">
                                    <!--  Single Grid product Start -->
                                    <div class="single-grid-product mb-40">
                                        <div class="product-image">
                                            @if($item->discount>0)
                                                <div class="product-label">
                                                    <span class="sale">{{$item->discount}}%</span>
                                                </div>
                                            @endif
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" class="img-fluid" alt="{{$item->title}}">
                                            </a>

                                            <div class="product-action d-flex justify-content-between">
                                                @if($item->depot>0)
                                                    <a class="product-btn" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد خرید</a>
                                                @else
                                                    <a class="product-btn">ناموجود</a>
                                                @endif
                                                <ul class="d-flex">
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @else
                                                        <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده "><i class="lnr lnr-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"> <a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                            <div class="product-category-rating">
                                                @if($item->discount>0)
                                                    <p class="product-price rtl" style="text-decoration: line-through;">{{number_format($item->price)}} تومان </p>
                                                    <p class="product-price rtl">{{number_format($item->price*(100-$item->discount)/100)}} تومان</p>
                                                @else
                                                    <p class="product-price rtl">{{number_format($item->price)}} تومان </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <!--  Single Grid product End -->
                                </div>
                                <?php $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Product section end-->


    <div class="offer-banner-area section  pt-125 pb-125">
        <div class="container">
            <div class="row">
                @foreach($banners as $banner)
                    @if($banner->position=="center")
                        <div class="col-lg-6 col-md-6">
                            <div class="single_banner mb-30">
                                <div class="banner_thumb">
                                    <a href="{{$banner->link}}"><img src="{{asset($banner->imgPath)}}" alt="{{$banner->link}}"></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!--Product section start-->
    <div class="product-section section pt-75 pt-lg-55 pt-md-45 pt-sm-35 pt-xs-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-40 pt-20">
                        <h1>پیشنهادهای ویژه</h1>
                    </div>
                </div>
            </div>
            <div class="row product-slider-two">
                @foreach($spacial_product as $item)
                <div class="col-lg-12">
                    <!--  Single Grid product Start -->
                    <div class="single-grid-product mb-40">
                        <div class="product-image">
                            @if($item->discount>0)
                            <div class="product-label">
                                <span class="sale">{{$item->discount}}%</span>
                            </div>
                            @endif
                            <a href="/product/{{$item->slug}}">
                                <img src="{{asset($item->image)}}" class="img-fluid" alt="{{$item->title}}">
                            </a>

                            <div class="product-action d-flex justify-content-between">
                                @if($item->depot>0)
                                <a class="product-btn" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد خرید</a>
                                @else
                                    <a class="product-btn">ناموجود</a>
                                @endif
                                <ul class="d-flex">
                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                    <li><a onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                    @else
                                    <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                    @endif
                                    <li><a href="/product/{{$item->slug}}" title="مشاهده "><i class="lnr lnr-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="title"> <a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                            <div class="product-category-rating">
                                @if($item->discount>0)
                                    <p class="product-price rtl" style="text-decoration: line-through;">{{number_format($item->price)}} تومان </p>
                                    <p class="product-price rtl">{{number_format($item->price*(100-$item->discount)/100)}} تومان</p>
                                @else
                                    <p class="product-price rtl">{{number_format($item->price)}} تومان </p>
                                @endif
                            </div>

                        </div>
                    </div>
                    <!--  Single Grid product End -->
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!--Product section end-->

    <!--Blog section start-->
    <div class="blog-section section pt-30 pt-lg-10 pt-md-0 pt-sm-0 pt-xs-0">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-40 pt-20 pt-sm-10 pt-xs-0">
                        <h1> وبلاگ ما</h1>
                    </div>
                </div>
            </div>

            <div class="row blog-slider">
                <!-- Single Blog Start -->
                @foreach($posts as $post)
                <div class="blog col">
                    <div class="blog-inner">
                        <div class="media"><a href="/blog/{{$post->slug}}" class="image"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a></div>
                        <div class="content">
                            <h3 class="title"><a href="/blog/{{$post->slug}}">{{str_limit($post->title,70)}}</a></h3>
                            <ul class="meta">
                                <li>توسط <a href="#" tabindex="0">مدیر</a></li>
                                <li>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                            </ul>
                            <p class="text">{{str_limit($post->shortContent,100)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
                <!-- Single Blog End -->
            </div>
        </div>
    </div>
    <!--Blog section end-->

    <!-- Newsletter Section Start -->
    <div class="newslatter-section section pt-60 pt-lg-40 pt-md-30 pt-sm-30 pt-xs-20 pb-100 pb-lg-80 pb-md-65 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="newslatter-content">
                        <p>پیشنهادهای ویژه برای مشترکین</p>
                        <h3>ده درصد تخفیف عضو</h3>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="newslatter-form">
                        <form action="#">
                            <input type="text" name="email" placeholder="آدرس ایمیل شما ...">
                            <button class="ht-btn lg-btn dark-btn" type="submit">اشتراک </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Section End -->

    <!-- Instagram Area Start -->
    <div class="instagram-area section">
        <div class="instagram-block-4 fix">
            <ul id="Instafeed"></ul>
        </div>
    </div>
    <!-- Instagram Area End -->

@endsection
