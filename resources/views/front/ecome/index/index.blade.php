@extends('front'.theme_name().'layout.master')
@section('style')
@endsection
@section('content')

    <!-- Slide -->
    <div class="slide-fullw">
        <div class="js-slider-home2">
            @foreach($sliders as $slider)
                <div class="e-slide-img">
                    <img src="{{$slider->imgPath}}" alt="">
                    <div class="slide-content v4 box-center">
                        <div class="container container-240 text-center">
                            {{--                        <p class="cate">{{$slider->imgName}}</p>--}}
                            {{--                        <h3 class="v4">به آینده سلام کن</h3>--}}
                            {{--                        <p class="sale v3">تخفیف تا <span class="red">60%</span></p>--}}
                            <a href="{{$slider->link}}" class="slide-btn e-orange-gradient" tabindex="0">مشاهده<i class="ion-ios-arrow-back"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- End Slide -->
    <!-- Homepage banner -->
    <div class="homepage-banner spc2">
        <div class="container container-240">
            <div class="row">
                @foreach($banners as $banner)
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="banner-img effect-img3 plus-zoom">
                        <a href="{{$banner->link}}" class=""><img src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}" class="img-responsive"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Homepage banner -->

    <!-- Start feature product -->
    <div class="feature-product spc2">
        <div class="container container-240">
            <div class="ecome-heading style2">
                <h1>محصولات ویژه</h1>
                {{--                <a href="#" class="btn-show">بیشتر ببینید<i class="ion-ios-arrow-back"></i></a>--}}
            </div>
            <p class="ecome-info spc2"></p>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div id="tv" class="tab-pane fade in active">
                            <div class="row">
                                @foreach($spacial_product as $item)
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                @if($item->discount>0)
                                                    <div class="ribbon-price red"><span>- {{$item->discount}}% </span></div>
                                                @endif
                                                <a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="element-list element-list-middle">
                                                    <p class="product-cate" style="padding-top: 20px">
                                                        @foreach ($item->categories as $category)
                                                            {{$category->title}} /
                                                        @endforeach
                                                    </p>
                                                    <h3 class="product-title"><a href="/product/{{$item->slug}}">{{str_limit($item->title,80)}}</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price">
                                                            @if($item->discount>0)
                                                                <span style="text-decoration: line-through">{{number_format($item->price)}} تومان</span>
                                                                <br>
                                                                <span style="color: #00d500">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                            @else
                                                                <span style="color: #00d500">{{number_format($item->price)}} تومان</span>
                                                            @endif
                                                        </div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    {{--                                                    <div class="product-bottom-group">--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-wishlist"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-compare"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                <div class="product-button-group">
                                                    <a style="cursor: pointer" class="btn-icon">
                                                        <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>
                                                    </a>
                                                    <a href="/product/{{$item->slug}}" class="">
                                                        <span class="text-primary">جزئیات محصول</span>
                                                    </a>

                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                    @else
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist2"></span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End feature product -->

    <!-- Start feature product -->
    <div class="feature-product spc2">
        <div class="container container-240">
            <div class="ecome-heading style2">
                <h1>محصولات دارای تخفیف</h1>
                {{--                <a href="#" class="btn-show">بیشتر ببینید<i class="ion-ios-arrow-back"></i></a>--}}
            </div>
            <p class="ecome-info spc2"></p>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div id="tv" class="tab-pane fade in active">
                            <div class="row">
                                @foreach($products_discount as $item)
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                @if($item->discount>0)
                                                    <div class="ribbon-price red"><span>- {{$item->discount}}% </span></div>
                                                @endif
                                                <a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="element-list element-list-middle">
                                                    <p class="product-cate" style="padding-top: 20px">
                                                        @foreach ($item->categories as $category)
                                                            {{$category->title}} /
                                                        @endforeach
                                                    </p>
                                                    <h3 class="product-title"><a href="/product/{{$item->slug}}">{{str_limit($item->title,80)}}</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price">
                                                            @if($item->discount>0)
                                                                <span style="text-decoration: line-through">{{number_format($item->price)}} تومان</span>
                                                                <br>
                                                                <span style="color: #00d500">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                            @else
                                                                <span style="color: #00d500">{{number_format($item->price)}} تومان</span>
                                                            @endif
                                                        </div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    {{--                                                    <div class="product-bottom-group">--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-wishlist"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-compare"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                <div class="product-button-group">
                                                    <a style="cursor: pointer" class="btn-icon">
                                                        <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>
                                                    </a>
                                                    <a href="/product/{{$item->slug}}" class="">
                                                        <span class="text-primary">جزئیات محصول</span>
                                                    </a>

                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                    @else
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist2"></span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End feature product -->

    <!-- Start feature product -->
    <div class="feature-product spc2">
        <div class="container container-240">
            <div class="ecome-heading style2">
                <h1>جدیدترین محصولات</h1>
                {{--                <a href="#" class="btn-show">بیشتر ببینید<i class="ion-ios-arrow-back"></i></a>--}}
            </div>
            <p class="ecome-info spc2"></p>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div id="tv" class="tab-pane fade in active">
                            <div class="row">
                                @foreach($products_new as $item)
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                @if($item->discount>0)
                                                    <div class="ribbon-price red"><span>- {{$item->discount}}% </span></div>
                                                @endif
                                                <a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="element-list element-list-middle">
                                                    <p class="product-cate" style="padding-top: 20px">
                                                        @foreach ($item->categories as $category)
                                                            {{$category->title}} /
                                                        @endforeach
                                                    </p>
                                                    <h3 class="product-title"><a href="/product/{{$item->slug}}">{{str_limit($item->title,80)}}</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price">
                                                            @if($item->discount>0)
                                                                <span style="text-decoration: line-through">{{number_format($item->price)}} تومان</span>
                                                                <br>
                                                                <span style="color: #00d500">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                            @else
                                                                <span style="color: #00d500">{{number_format($item->price)}} تومان</span>
                                                            @endif
                                                        </div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    {{--                                                    <div class="product-bottom-group">--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-wishlist"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-compare"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                <div class="product-button-group">
                                                    <a style="cursor: pointer" class="btn-icon">
                                                        <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>
                                                    </a>
                                                    <a href="/product/{{$item->slug}}" class="">
                                                        <span class="text-primary">جزئیات محصول</span>
                                                    </a>

                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                    @else
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist2"></span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End feature product -->

    <!-- Start feature product -->
    <div class="feature-product spc2">
        <div class="container container-240">
            <div class="ecome-heading style2">
                <h1>محبوب ترین محصولات</h1>
                {{--                <a href="#" class="btn-show">بیشتر ببینید<i class="ion-ios-arrow-back"></i></a>--}}
            </div>
            <p class="ecome-info spc2"></p>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div id="tv" class="tab-pane fade in active">
                            <div class="row">
                                @foreach($products_view as $item)
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 product-item">
                                        <div class="pd-bd product-inner">
                                            <div class="product-img">
                                                @if($item->discount>0)
                                                    <div class="ribbon-price red"><span>- {{$item->discount}}% </span></div>
                                                @endif
                                                <a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" class="img-reponsive"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="element-list element-list-middle">
                                                    <p class="product-cate" style="padding-top: 20px">
                                                        @foreach ($item->categories as $category)
                                                            {{$category->title}} /
                                                        @endforeach
                                                    </p>
                                                    <h3 class="product-title"><a href="/product/{{$item->slug}}">{{str_limit($item->title,80)}}</a></h3>
                                                    <div class="product-bottom">
                                                        <div class="product-price">
                                                            @if($item->discount>0)
                                                                <span style="text-decoration: line-through">{{number_format($item->price)}} تومان</span>
                                                                <br>
                                                                <span style="color: #00d500">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                            @else
                                                                <span style="color: #00d500">{{number_format($item->price)}} تومان</span>
                                                            @endif
                                                        </div>
                                                        <a href="#" class="btn-icon btn-view">
                                                            <span class="icon-bg icon-view"></span>
                                                        </a>
                                                    </div>
                                                    {{--                                                    <div class="product-bottom-group">--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-wishlist"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="#" class="btn-icon">--}}
                                                    {{--                                                            <span class="icon-bg icon-compare"></span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                <div class="product-button-group">
                                                    <a style="cursor: pointer" class="btn-icon">
                                                        <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>
                                                    </a>
                                                    <a href="/product/{{$item->slug}}" class="">
                                                        <span class="text-primary">جزئیات محصول</span>
                                                    </a>

                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist"></span>
                                                        </a>
                                                    @else
                                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                                            <span class="icon-bg icon-wishlist2"></span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End feature product -->


    <!-- Our blog -->
    <div class="our-blog bg">
        <div class="container container-240">
            <div class="ecome-heading style2">
                <h1 class="v2">نوشته های وبلاگ</h1>
                <a href="/blog" class="btn-show">بیشتر ببینید<i class="ion-ios-arrow-back"></i></a>
            </div>
            <p class="ecome-info spc2"></p>
            <div class="product-tab-pd owl-carousel owl-theme js-owl-blog owl-custom-dots v2">
                @foreach($posts as $post)
                    <div class="blog-post-item v3">
                        <div class="blog-img">
                            <a href="/blog/{{$post->slug}}" class="hover-images"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}" class="img-reponsive"></a>
                        </div>
                        <div class="heading-blog flex align-center">
                            <div class="blog-post-date e-gradient">
                                <span class="b-date text-center" style="font-size: 16px">{{Verta::instance($post->created_at)->format('%d')}}<br>{{Verta::instance($post->created_at)->format('%B')}}</span>
                            </div>
                            <h3 class="blog-post-title"><a href="/blog/{{$post->slug}}">{{str_limit($post->title,50)}}</a></h3>
                        </div>
                        <p class="blog-post-desc">{{str_limit($post->shortContent,100)}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End blog -->
    <!-- / end content -->

@endsection
