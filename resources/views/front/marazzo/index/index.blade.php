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
    </style>
@endsection
@section('content')
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="body-content outer-top-vs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    <div class="side-menu animate-dropdown outer-bottom-xs">
                        <?php $i=1; ?>
                        @foreach($banners as $banner)

                            @if($banner->position=="top")

                                <div class=" li-banner" @if($i!="1") style="margin-top: 10px" @endif>
                                    <a href="{{$banner->link}}">
                                        <img style="width: 100%;border-radius: 10px" src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}">
                                    </a>
                                </div>
                                <?php $i++ ?>
                            @endif

                        @endforeach
                    </div>
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS ============================================== -->
                    <div class="sidebar-widget hot-deals outer-bottom-xs">
                        <h3 class="section-title">پیشنهادات ویژه</h3>
                        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                            @foreach($spacial_product as $item)
                            <div class="item">
                                <div class="products">
                                    <div class="hot-deal-wrapper">
                                        <div class="image">
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                            </a>
                                        </div>
                                        @if($item->discount>0)
                                        <div class="sale-offer-tag"><span>{{$item->discount}}%<br>
                    تخفیف</span></div>
                                        @endif

                                    </div>
                                    <!-- /.hot-deal-wrapper -->

                                    <div class="product-info text-right m-t-20">
                                        <h3 class="name"><a href="/product/{{$item->slug}}">{{$item->title}}</a></h3>
                                        {{--<div class="rating rateit-small"></div>--}}
                                        @if($item->discount>0)
                                            <div class="product-price"> <span class="price" style="float: right;width: 100%"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> <span class="price-before-discount">{{number_format($item->price)}} تومان</span> </div>
                                        @else
                                            <div class="product-price"> <span class="price"> {{number_format($item->price)}} تومان </span></div>
                                    @endif                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->

                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            @if($item->depot>0)
                                            <div class="add-cart-button btn-group" onclick="addcart(this,'{{$item->id}}')">
                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">افزودن به سبد</button>
                                            </div>
                                            @else
                                                <div class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">ناموجود</button>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.sidebar-widget -->
                    </div>
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== SPECIAL OFFER ============================================== -->

                    <div class="sidebar-widget outer-bottom-small">
                        <h3 class="section-title">پرفروش ترین ها</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                <?php
                                $ii=1;
                                foreach ($sale_product as $item){
                                if ($ii % 3 == 0) {
                                ?>
                                </div>
                                <div class="item">
                                    <?php } ?>
                                    <div class="products special-product">

                                        <div class="product">

                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="/product/{{$item->slug}}"> <img src="{{asset($item->image)}}" alt="{{$item->title}}"> </a> </div>
                                                            <!-- /.image -->
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7" style="padding-right: 0">
                                                        <div class="product-info">
                                                            <h3 class="name"><a style="max-width: 129px;display: block" href="/product/{{$item->slug}}">{{str_limit($item->title,100)}}</a></h3>
                                                            {{--<div class="rating rateit-small"></div>--}}
                                                            <div class="product-price"> <span class="price"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                        <?php $ii++; } ?>
                                </div>

                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                    <!-- ============================================== PRODUCT TAGS ============================================== -->

                    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter outer-bottom-small">
                        <h3 class="section-title">عضویت در خبرنامه</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>برای دریافت تازه ترین ها اولین نفر باشید!</p>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">آدرس ایمیل</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="آدرس ایمیل را وارد کنید">
                                </div>
                                <button class="btn btn-primary">عضویت</button>
                            </form>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->


                </div>
                <!-- /.sidemenu-holder -->
                <!-- ============================================== SIDEBAR : END ============================================== -->

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            @foreach($sliders as $slider)

                            <div class="item" style="background-image: url({{asset($slider->imgPath)}});background-size: cover;">
                                <a href="{{$slider->link}}" class="container-fluid" style="height: 100%;display: block;width: 100%">
                                </a>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->
                            @endforeach
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->


                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-right">محصولات جدید</h3>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                        @foreach($products_new as $item)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="/product/{{$item->slug}}">
                                                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                        @if($item->discount>0)
                                                            <div class="tag new"><span>{{$item->discount}}%</span></div>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-right">
                                                        <h3 class="name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,37)}}</a></h3>
                                                        {{--<div class="rating rateit-small"></div>
                                                        <div class="description"></div>--}}
                                                        @if($item->discount>0)
                                                        <div class="product-price"> <span class="price"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> <span class="price-before-discount">{{number_format($item->price)}} تومان</span> </div>
                                                        @else
                                                            <div class="product-price"> <span class="price"> {{number_format($item->price)}} تومان </span></div>
                                                        @endif

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                @if($item->depot>0)
                                                                <li class="add-cart-button btn-group" onclick="addcart(this,'{{$item->id}}')">
                                                                    <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="button">افزودن به سبد</button>
                                                                </li>
                                                                @else
                                                                    <li class="add-cart-button btn-group">
                                                                        <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> ناموجود</button>
                                                                    </li>
                                                                @endif
                                                                    @php
                                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                                    @endphp
                                                                    @if(empty($favorite))
                                                                <li class="lnk wishlist"  onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    @else
                                                                        <li class="lnk wishlist" style="color: red" onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    @endif
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.scroll-tabs -->
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners outer-bottom-xs">
                        <div class="row">
                            <?php $i=1; ?>
                            @foreach($banners as $banner)

                                @if($banner->position=="center")

                                        <div class="col-md-4 col-sm-4">
                                            <a href="{{$banner->link}}">
                                                <div class="wide-banner cnt-strip">
                                                    <div class="image"> <img class="img-responsive" src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}"> </div>
                                                </div>
                                            </a>

                                            <!-- /.wide-banner -->
                                        </div>
                                    <?php $i++ ?>
                                @endif

                            @endforeach

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->

                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-right">محصولات دارای تخفیف</h3>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                        @foreach($products_discount as $item)
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="/product/{{$item->slug}}">
                                                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                                </a>
                                                            </div>
                                                            <!-- /.image -->
                                                            @if($item->discount>0)
                                                                <div class="tag new"><span>{{$item->discount}}%</span></div>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-image -->

                                                        <div class="product-info text-right">
                                                            <h3 class="name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,37)}}</a></h3>
                                                            {{--<div class="rating rateit-small"></div>
                                                            <div class="description"></div>--}}
                                                            @if($item->discount>0)
                                                                <div class="product-price"> <span class="price"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> <span class="price-before-discount">{{number_format($item->price)}} تومان</span> </div>
                                                            @else
                                                                <div class="product-price"> <span class="price"> {{number_format($item->price)}} تومان </span></div>
                                                            @endif

                                                        </div>
                                                        <!-- /.product-info -->
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    @if($item->depot>0)
                                                                        <li class="add-cart-button btn-group" onclick="addcart(this,'{{$item->id}}')">
                                                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> <i class="fa fa-shopping-cart"></i> </button>
                                                                            <button class="btn btn-primary cart-btn" type="button">افزودن به سبد</button>
                                                                        </li>
                                                                    @else
                                                                        <li class="add-cart-button btn-group">
                                                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> ناموجود</button>
                                                                        </li>
                                                                    @endif
                                                                    @php
                                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                                    @endphp
                                                                    @if(empty($favorite))
                                                                        <li class="lnk wishlist"  onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    @else
                                                                        <li class="lnk wishlist" style="color: red" onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product -->

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners outer-bottom-xs">
                        <div class="row">
                            <?php $i=1; ?>
                            @foreach($banners as $banner)

                                @if($banner->position=="bottom")


                                        <div class="col-md-6">
                                            <a href="{{$banner->link}}">
                                                <div class="wide-banner1 cnt-strip">
                                                    <div class="image"> <img style="height: 150px" class="img-responsive" src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}"> </div>
                                                </div>
                                            </a>

                                            <!-- /.wide-banner -->
                                        </div>
                                    <?php $i++ ?>
                                @endif

                            @endforeach


                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->



                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs">
                        <h3 class="section-title">نوشته های وبلاگ</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                @foreach($posts as $post)
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="/blog/{{$post->slug}}"><img src="{{asset($post->imgPath)}}" alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-right">
                                            <h3 class="name"><a href="/blog/{{$post->slug}}">{{str_limit($post->title,50)}}</a></h3>
                                            <span class="info">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                                            <p class="text">{{str_limit($post->shortContent,100)}}</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                @endforeach
                                <!-- /.item -->
                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-right">پربازدیدترین محصولات </h3>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                        @foreach($products_view as $item)
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="/product/{{$item->slug}}">
                                                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                                </a>
                                                            </div>
                                                            <!-- /.image -->
                                                            @if($item->discount>0)
                                                                <div class="tag new"><span>{{$item->discount}}%</span></div>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-image -->

                                                        <div class="product-info text-right">
                                                            <h3 class="name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,37)}}</a></h3>
                                                            {{--<div class="rating rateit-small"></div>
                                                            <div class="description"></div>--}}
                                                            @if($item->discount>0)
                                                                <div class="product-price"> <span class="price"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> <span class="price-before-discount">{{number_format($item->price)}} تومان</span> </div>
                                                            @else
                                                                <div class="product-price"> <span class="price"> {{number_format($item->price)}} تومان </span></div>
                                                            @endif

                                                        </div>
                                                        <!-- /.product-info -->
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    @if($item->depot>0)
                                                                        <li class="add-cart-button btn-group" onclick="addcart(this,'{{$item->id}}')">
                                                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> <i class="fa fa-shopping-cart"></i> </button>
                                                                            <button class="btn btn-primary cart-btn" type="button">افزودن به سبد</button>
                                                                        </li>
                                                                    @else
                                                                        <li class="add-cart-button btn-group">
                                                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> ناموجود</button>
                                                                        </li>
                                                                    @endif
                                                                    @php
                                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                                    @endphp
                                                                    @if(empty($favorite))
                                                                        <li class="lnk wishlist"  onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    @else
                                                                        <li class="lnk wishlist" style="color: red" onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product -->

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->


                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                </div>
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider">
                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        @foreach($brands as $brand)
                        <div class="item m-t-15"> <a href="{{$brand->link}}" class="image"> <img data-echo="{{asset($brand->imgPath)}}" src="{{asset($brand->imgPath)}}" alt=""> </a> </div>
                        @endforeach
                        <!--/.item-->
                    </div>
                    <!-- /.owl-carousel #logo-slider -->
                </div>
                <!-- /.logo-slider-inner -->

            </div>
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#top-banner-and-menu -->

    <!-- ============================================== INFO BOXES ============================================== -->
    <div class="row our-features-box">
        <div class="container">
            <ul>
                <li>
                    <div class="feature-box">
                        <div class="icon-truck"></div>
                        <div class="content-blocks">ما به تمام دنیا ارسال میکنیم</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-support"></div>
                        <div class="content-blocks">تماس {{$setting['tell']}}</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-money"></div>
                        <div class="content-blocks">تضمین بازگشت پول</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-return"></div>
                        <div class="content">7 روز بازگشتی</div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <!-- /.info-boxes -->


@endsection
