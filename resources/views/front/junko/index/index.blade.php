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

    <!--slider area start-->
    <section class="slider_section mb-70">
        <div class="slider_area owl-carousel">
            @foreach($sliders as $slider)
            <div class="single_slider d-flex align-items-center" data-bgimg="{{asset($slider->imgPath)}}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider_content">
                                <h2>{{$slider->title}}</h2>
                                <p> {{$slider->text}} </p>
                                @if($slider->link)
                                    <a href="{{$slider->link}}" class="button">بیشتر</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </section>
    <!--slider area end-->

    <!--shipping area start-->
    <section class="shipping_area mb-70">
        <div class="container">
            <div class=" row">
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="{{asset('junko/img/about/shipping1.png')}}" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>ارسال رایگان</h2>
                            <p>ارسال رایگان به تمام نقاط کشور</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="{{asset('junko/img/about/shipping2.png')}}" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>پشتیبانی 24 ساعته</h2>
                            <p>هر ساعت از شبانه روز تماس بگیرید</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="{{asset('junko/img/about/shipping3.png')}}" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>100% بازگشت وجه</h2>
                            <p>30 روز مهلت بازگشت وجه</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="{{asset('junko/img/about/shipping4.png')}}" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>پرداخت ایمن</h2>
                            <p>امنیت پرداخت تضمین شده</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--shipping area end-->

    <!--banner area start-->
    <div class="banner_area mb-40">
        <div class="container">
            <div class="row">
                @foreach($banners as $banner)
                    @if($banner->position=="top")
                <div class="col-lg-3 col-md-3">
                    <div class="single_banner mb-30">
                        <div class="banner_thumb">
                            <a href="{{$banner->link}}"><img src="{{asset($banner->imgPath)}}" alt="{{$banner->alt}}"></a>
                        </div>
                    </div>
                </div>
                    @endif
                    @endforeach
            </div>
        </div>
    </div>
    <!--banner area end-->

    <!--product area start-->
    <section class="product_area mb-46">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>جدیدترین ها</h2>
                    </div>
                </div>
            </div>
            <div class="product_carousel product_column5 owl-carousel">
                @foreach($products_new as $item)
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a class="primary_img" href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}"></a>
                            @if($item->discount>0)
                            <div class="label_product">
                                <span class="label_sale">{{$item->discount}}%</span>
                            </div>
                            @endif
                            <div class="action_links">
                                <ul>
                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                    <li class="wishlist"><a onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    @else
                                        <li class="wishlist"><a style="color: red" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    @endif
                                    <li class="quick_button">
                                        <a href="/product/{{$item->slug}}" title="مشاهده "> <span class="ion-ios-search-strong"></span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="add_to_cart">
                                @if($item->depot>0)
                                <a style="color: #fff" onclick="addcart(this,'{{$item->id}}')" title="افزودن به سبد">افزودن به سبد</a>
                                @else
                                <a style="color: #fff" title="ناموجود">ناموجود</a>
                                @endif
                            </div>
                           {{-- <div class="product_timing">
                                <div data-countdown="2043/12/15"></div>
                            </div>--}}
                        </div>
                        <figcaption class="product_content">
                            <div class="price_box">
                                @if($item->discount>0)
                                <span class="old_price">{{number_format($item->price)}} تومان</span>
                                <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                @else
                                    <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($item->price)}} تومان</span>
                                @endif
                            </div>
                            <h3 class="product_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                        </figcaption>
                    </figure>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    <!--product area end-->

    <!--banner area start-->
    <div class="banner_area mb-40">
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
    <!--banner area end-->

    <!--top- category area start-->
    <section class="top_category_product mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <div class="top_category_header">
                        <h3>محبوب ترین دسته های این هفته</h3>

                    </div>
                </div>
                <div class="col-lg-10 col-md-9">
                    <div class="top_category_container category_column5 owl-carousel">
                        @foreach($categories_image as $category)
                        <div class="col-lg-2">
                            <article class="single_category" style="padding: 0">
                                <figure>
                                    <div class="category_thumb">
                                        <a href="shop?cat={{$category->slug}}"><img src="{{asset($category->imgPath)}}" alt="{{$category->name}}"></a>
                                    </div>
                                    {{--<figcaption class="category_name">
                                        <h3><a href="shop.html">بازی و کنسول </a></h3>
                                    </figcaption>--}}
                                </figure>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--top- category area end-->

    <!--featured product area start-->
    <section class="featured_product_area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>محصولات ویژه</h2>
                    </div>
                </div>
            </div>
            <div class="row featured_container featured_column3">
                @foreach($spacial_product as $item)
                <div class="col-lg-4">
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}"></a>
                                @if($item->discount>0)
                                <div class="label_product">
                                    <span class="label_sale">{{$item->discount}}%</span>
                                </div>
                                @endif
                            </div>
                            <figcaption class="product_content">
                                <div class="price_box">
                                    @if($item->discount>0)
                                    <span class="old_price">{{number_format($item->price)}} تومان</span>
                                    <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                    @else
                                        <span style="height: 53px;" class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                    @endif
                                </div>
                                <h3 class="product_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                <div class="add_to_cart">
                                    @if($item->depot>0)
                                    <a title="افزودن به سبد" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد</a>
                                    @else
                                    <a title="ناموجود">ناموجود</a>
                                    @endif
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--featured product area end-->

    <!--product area start-->
    <section class="product_area mb-46">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>محصولات دارای تخفیف</h2>
                    </div>
                </div>
            </div>
            <div class="product_carousel product_column5 owl-carousel">
                @foreach($products_discount as $item)
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}"></a>
                                @if($item->discount>0)
                                    <div class="label_product">
                                        <span class="label_sale">{{$item->discount}}%</span>
                                    </div>
                                @endif
                                <div class="action_links">
                                    <ul>
                                        @php
                                            $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                        @endphp
                                        @if(empty($favorite))
                                            <li class="wishlist"><a onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                        @else
                                            <li class="wishlist"><a style="color: red" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                        @endif
                                        <li class="quick_button">
                                            <a href="/product/{{$item->slug}}" title="مشاهده "> <span class="ion-ios-search-strong"></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add_to_cart">
                                    @if($item->depot>0)
                                        <a style="color: #fff" onclick="addcart(this,'{{$item->id}}')" title="افزودن به سبد">افزودن به سبد</a>
                                    @else
                                        <a style="color: #fff" title="ناموجود">ناموجود</a>
                                    @endif
                                </div>
                                {{-- <div class="product_timing">
                                     <div data-countdown="2043/12/15"></div>
                                 </div>--}}
                            </div>
                            <figcaption class="product_content">
                                <div class="price_box">
                                    @if($item->discount>0)
                                        <span class="old_price">{{number_format($item->price)}} تومان</span>
                                        <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                    @else
                                        <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($item->price)}} تومان</span>
                                    @endif
                                </div>
                                <h3 class="product_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                            </figcaption>
                        </figure>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <!--product area end-->

    <!--banner area start-->
    <div class="banner_area mb-40">
        <div class="container">
            <div class="row">
                @foreach($banners as $banner)
                @if($banner->position=="bottom")
                        <div class="col-lg-12 col-md-12">
                            <div class="single_banner mb-30">
                                <div class="banner_thumb">
                                    <a href="{{$banner->link}}"><img style="width: 100%;" src="{{asset($banner->imgPath)}}" alt="{{$banner->alt}}"></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!--banner area end-->

    <!--product area start-->
    <section class="product_area mb-46">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="product_left_area">
                        <div class="section_title">
                            <h2>پربازدید ترین</h2>
                        </div>
                        <div class="product_carousel product_column4 owl-carousel">
                            @foreach($products_view as $item)
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}"></a>
                                            @if($item->discount>0)
                                                <div class="label_product">
                                                    <span class="label_sale">{{$item->discount}}%</span>
                                                </div>
                                            @endif
                                            <div class="action_links">
                                                <ul>
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li class="wishlist"><a onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                                    @else
                                                        <li class="wishlist"><a style="color: red" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                                    @endif
                                                    <li class="quick_button">
                                                        <a href="/product/{{$item->slug}}" title="مشاهده "> <span class="ion-ios-search-strong"></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="add_to_cart">
                                                @if($item->depot>0)
                                                    <a style="color: #fff" onclick="addcart(this,'{{$item->id}}')" title="افزودن به سبد">افزودن به سبد</a>
                                                @else
                                                    <a style="color: #fff" title="ناموجود">ناموجود</a>
                                                @endif
                                            </div>
                                            {{-- <div class="product_timing">
                                                 <div data-countdown="2043/12/15"></div>
                                             </div>--}}
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="price_box">
                                                @if($item->discount>0)
                                                    <span class="old_price">{{number_format($item->price)}} تومان</span>
                                                    <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                @else
                                                    <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($item->price)}} تومان</span>
                                                @endif
                                            </div>
                                            <h3 class="product_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                        </figcaption>
                                    </figure>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->

    <!--blog area start-->
    <section class="blog_section mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>بلاگ</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog_carousel blog_column4 owl-carousel">

                    @foreach($posts as $post)
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="/blog/{{$post->slug}}"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                                </div>
                                <figcaption class="blog_content">
                                    <p class="post_author">توسط <a>مدیر</a> {{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</p>
                                    <h3 class="post_title"><a href="/blog/{{$post->slug}}">{{str_limit($post->shortContent,100)}}</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--blog area end-->

    <!--brand area start-->
    <div class="brand_area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="brand_container owl-carousel">
                        @foreach($brands as $brand)
                        <div class="brand_items">

                            <div class="single_brand">
                                <a href="{{$brand->link}}"><img src="{{asset($brand->imgPath)}}" alt="{{$brand->alt}}"></a>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--brand area end-->


@endsection
