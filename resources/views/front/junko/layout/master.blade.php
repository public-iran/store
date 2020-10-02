@php
    $options=App\Setting::all();
    $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        //dd(Auth::user())


$carts = Gloudemans\Shoppingcart\Facades\Cart::content();
$countcart = Gloudemans\Shoppingcart\Facades\Cart::content()->count();
$total_price = Gloudemans\Shoppingcart\Facades\Cart::subtotal(00);
if(!isset($countcart)){
    $countcart = 0;
}
if(!isset($total_price)){
    $total_price = 0;
}
@endphp
    <!DOCTYPE html>
<html class="no-js" lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords" content="{{@$seo_title}}">
    <title>{{@$title}} </title>
    <meta name="description" content="{{@$seo_content}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('junko/img/favicon.ico')}}">

    <!-- CSS
    ========================= -->

    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#e5e5e5">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('junko/css/plugins.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('junko/css/style.css')}}">
    @yield('style_link')
    @yield('style')
    <style>
        .invalid-feedback{
            display: block;
        }
        .result-search{
            height: 200px;
            background: #fff;
            margin-top: 43px;
            overflow-y: scroll;
            z-index: 106;
            position: absolute;
            box-shadow:1px 1px 3px 0px #ccc;
            margin-right: 1px;
            display: none;
            overflow-x: hidden;
            top: 6px;
        }
        .categorie_subb.open {
            top: 100%;
            opacity: 1;
            visibility: visible;
            display: contents;
        }
        .categorie_subb {
            opacity: 0;
            z-index: 999;
            position: absolute;
            width: -webkit-calc(100% + 2px);
            width: -moz-calc(100% + 2px);
            width: calc(100% + 2px);
            right: -1px;
            border-right: 1px solid #ddd;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            background: #fff;
            -webkit-transition: .3s;
            -o-transition: .3s;
            -moz-transition: .3s;
            transition: .3s;
            top: 65%;
            visibility: hidden;
            padding-bottom: 15px;
        }

    </style>
</head>

<body>

<!--header area start-->

<!--Offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>
<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                </div>
                <div class="Offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    </div>
                    <div class="support_info">
                        <p>تلفن تماس: <a class="ltr-text" href="tel:+989123456789">{{$setting['tell']}}</a></p>
                    </div>
                    <div class="top_right text-right">
                        <ul>
                            @if(Auth::check())
                                <li><a href="/panel"> حساب کاربری </a></li>
                                @else
                                <li><a href="/register"> ثبت نام </a></li>
                                <li><a href="/login"> ورود </a></li>
                                @endif
                        </ul>
                    </div>
                    <div class="search_container">
                        <form action="#">

                            <div class="search_box">
                                <input onkeyup="search_header()" name="search" placeholder="جستجوی محصول ..." type="text">
                                <button onclick="search_header()" type="submit">جستجو</button>
                                <div class="result-search col-md-12">

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="middel_right_info">
                        <div class="header_wishlist">
                            <a href="/panel/favorites"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <i class="fa fa-angle-down"></i></a>
                            <span class="cart_quantity cart-total">{{$countcart}}</span>
                            <!--mini cart-->
                            <div class="mini_cart">
                                <div class="cart_items_container carts_table">
                                    @foreach($carts as $cart)
                                        <div class="cart_item">
                                            <div class="cart_img">
                                                <a href="/product/{{$cart->options->product_slug}}"><img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}"></a>
                                            </div>
                                            <div class="cart_info">
                                                <a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a>
                                                <p>تعداد: <span>{{$cart->qty}}</span> × <span> {{number_format($cart->price)}} تومان </span></p>
                                            </div>
                                            <div class="cart_remove">
                                                <a onclick="removecart(this, '{{$cart->rowId}}')"><i class="ion-android-close"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mini_cart_table">
                                    <div class="cart_total">
                                        <span>جمع :</span>
                                        <span class="price cart-total">{{$countcart}}</span>
                                    </div>
                                    <div class="cart_total mt-10">
                                        <span>جمع کل:</span>
                                        <span class="price"><span class="minicart-total">{{$total_price}}</span> تومان </span>
                                    </div>
                                </div>

                                <div class="mini_cart_footer">
                                    <div class="cart_button">
                                        <a href="/cart">مشاهده سبد</a>
                                    </div>
                                    <div class="cart_button">
                                        <a href="/checkout">پرداخت</a>
                                    </div>

                                </div>

                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li><a href="/">صفحه اصلی</a></li>
                            <li><a href="/shop">فروشگاه</a></li>
                            <li><a href="/blog">مقالات</a></li>
                            <li><a href="/about">درباره ما</a></li>
                            <li><a href="/contact"> تماس با ما</a></li>
                        </ul>
                    </div>

                    <div class="Offcanvas_footer">
                        <span><a><i class="fa fa-envelope-o"></i>{{$setting['email']}}</a></span>

                        <ul>
                            @if($setting['facebook']!="")
                               <li class="facebook"><a href="{{$setting['facebook']}}"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if($setting['twitter']!="")
                                <li class="twitter"><a href="{{$setting['twitter']}}"><i class="fa fa-twitter"></i></a></li>
                            @endif
                            @if($setting['instagram']!="")
                                <li class="pinterest"><a href="{{$setting['instagram']}}"><i class="fa fa-instagram"></i></a></li>
                            @endif
                            @if($setting['telegram']!="")
                                <li class="telegram"><a href="{{$setting['telegram']}}"><i class="fa fa-telegram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Offcanvas menu area end-->

<header>
    <div class="main_header">
        <!--header top start-->
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="support_info">
                            <p>تلفن تماس: <a class="ltr-text" href="tel:+989123456789">{{$setting['tell']}}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="top_right text-right">
                            <ul>
                                @if(Auth::check())
                                    <li><a href="/panel"> حساب کاربری </a></li>
                                @else
                                    <li><a href="/register"> ثبت نام </a></li>
                                    <li><a href="/login"> ورود </a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header top start-->
        <!--header middel start-->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="logo">
                            <a href="/"><img src="{{asset($setting['logo'])}}" alt="لوگو 1"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6">
                        <div class="middel_right">
                            <div class="search_container">
                                <form action="#">

                                    <div class="search_box">
                                        <input onkeyup="search_header()" name="search" placeholder="جستجوی محصول ..." type="text">
                                        <button onclick="search_header()" type="submit">جستجو</button>
                                        <div class="result-search col-md-12">

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="middel_right_info">
                                <div class="header_wishlist">
                                    <a href="/panel/favorites"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <i class="fa fa-angle-down"></i></a>
                                    <span class="cart_quantity cart-total">{{$countcart}}</span>
                                    <!--mini cart-->
                                    <div class="mini_cart">
                                        <div class="cart_items_container carts_table">
                                            @foreach($carts as $cart)
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="/product/{{$cart->options->product_slug}}"><img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}"></a>
                                                </div>
                                                <div class="cart_info">
                                                    <a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a>
                                                    <p>تعداد: <span>{{$cart->qty}}</span> × <span> {{number_format($cart->price)}} تومان </span></p>
                                                </div>
                                                <div class="cart_remove">
                                                    <a onclick="removecart(this, '{{$cart->rowId}}')"><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="mini_cart_table">
                                            <div class="cart_total">
                                                <span>جمع :</span>
                                                <span class="price cart-total" >{{$countcart}}</span>
                                            </div>
                                            <div class="cart_total mt-10">
                                                <span>جمع کل:</span>
                                                <span class="price"><span class="minicart-total">{{$total_price}}</span> تومان </span>
                                            </div>
                                        </div>

                                        <div class="mini_cart_footer">
                                            <div class="cart_button">
                                                <a href="/cart">مشاهده سبد</a>
                                            </div>
                                            <div class="cart_button">
                                                <a href="/checkout">پرداخت</a>
                                            </div>

                                        </div>

                                    </div>
                                    <!--mini cart end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header middel end-->
        <!--header bottom satrt-->
        <div class="main_menu_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle">دسته‌بندی ها</h2>
                            </div>
                            <div class="categories_menu_toggle">
                                <ul>
                                    @php
                                        $categories = App\Category::where('parent', '0')->get();
                                    @endphp
                                    @foreach($categories as $category)
                                    <li id="cat_toggle" class="has-sub"><span class="before-icon"></span><a href="/shop?cat={{$category->slug}}">{{$category->title}}</a>
                                        @php
                                            $categories2=App\Category::where('parent',$category->id)->get();
                                        @endphp
                                        @if(count($categories2))
                                        <ul class="categorie_sub">
                                            @foreach($categories2 as $category2)
                                            <li  id="cat_toggle2" class="has-sub"><span class="before-icon"></span><a href="/shop?cat={{$category2->slug}}">{{$category2->title}}</a>
                                                <?php  $categories3=App\Category::where('parent',$category2->id)->get();   ?>
                                                @if(count($categories3))
                                                <ul class="categorie_subb">
                                                    @foreach($categories3 as $category3)
                                                    <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}}</a></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>

                                    <li><a href="/">صفحه اصلی</a></li>
                                    <li><a href="/shop">فروشگاه</a></li>
                                    <li><a href="/blog">مقالات</a></li>
                                    <li><a href="/about">درباره ما</a></li>
                                    <li><a href="/contact"> تماس با ما</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header bottom end-->
    </div>
</header>

<!--sticky header area start-->
<div class="sticky_header_area sticky-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="logo">
                    <a href="/"><img src="{{asset($setting['logo'])}}" alt="لوگو 3"></a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="sticky_header_right menu_position">
                    <div class="main_menu">
                        <nav>
                            <ul>
                                <li><a href="/">صفحه اصلی</a></li>
                                <li><a href="/shop">فروشگاه</a></li>
                                <li><a href="/blog">مقالات</a></li>
                                <li><a href="/about">درباره ما</a></li>
                                <li><a href="/contact"> تماس با ما</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="middel_right_info">
                        <div class="header_wishlist">
                            <a href="/panel/favorites"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <i class="fa fa-angle-down"></i></a>
                            <span class="cart_quantity cart-total">{{$countcart}}</span>
                            <!--mini cart-->
                            <div class="mini_cart">
                                <div class="cart_items_container carts_table">
                                    @foreach($carts as $cart)
                                        <div class="cart_item">
                                            <div class="cart_img">
                                                <a href="/product/{{$cart->options->product_slug}}"><img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}"></a>
                                            </div>
                                            <div class="cart_info">
                                                <a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a>
                                                <p>تعداد: <span>{{$cart->qty}}</span> × <span> {{number_format($cart->price)}} تومان </span></p>
                                            </div>
                                            <div class="cart_remove">
                                                <a onclick="removecart(this, '{{$cart->rowId}}')"><i class="ion-android-close"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mini_cart_table">
                                    <div class="cart_total">
                                        <span>جمع :</span>
                                        <span class="price cart-total" >{{$countcart}}</span>
                                    </div>
                                    <div class="cart_total mt-10">
                                        <span>جمع کل:</span>
                                        <span class="price"><span class="minicart-total">{{$total_price}}</span> تومان </span>
                                    </div>
                                </div>

                                <div class="mini_cart_footer">
                                    <div class="cart_button">
                                        <a href="/cart">مشاهده سبد</a>
                                    </div>
                                    <div class="cart_button">
                                        <a href="/checkout">پرداخت</a>
                                    </div>

                                </div>

                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--sticky header area end-->

<!--header area end-->
@yield('content')
<!--footer area start-->
<footer class="footer_widgets">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widgets_container contact_us">
                        <div class="footer_logo">
                            <a href="/"><img src="{{asset($setting['logo'])}}" alt="لوگو 2"></a>
                        </div>
                        <div class="footer_contact">
                            <p><span>آدرس: </span>{{$setting['address']}}</p>
                            <p><span>موبایل: </span><a class="ltr-text" href="tel:{{$setting['mobile']}}">{{$setting['mobile']}}</a> ، <a class="ltr-text" href="tel:{{$setting['tell']}}">{{$setting['tell']}}</a> </p>
                            <p><span>پشتیبانی: </span><a target="_blank" href="">{{$setting['email']}}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>دسترسی سریع</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="/">صفحه اصلی</a></li>
                                <li><a href="/shop">فروشگاه</a></li>
                                <li><a href="/blog">مقالات</a></li>
                                <li><a href="/about">درباره ما</a></li>
                                <li><a href="/contact"> تماس با ما</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>حساب کاربری</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="/panel">حساب کاربری</a></li>
                                <li><a href="/orders">سابقه خرید</a></li>
                                <li><a href="/panel/favorites">علاقه‌مندی‌ها</a></li>
                                <li><a href="/panel/profile">اطلاعات حساب</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widgets_container newsletter">
                        <h3>ما را دنبال کنید</h3>
                        <div class="footer_social_link">
                            <ul>
                                @if($setting['facebook']!="")
                                    <li><a class="facebook" href="{{$setting['facebook']}}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if($setting['twitter']!="")
                                    <li><a class="twitter" href="{{$setting['twitter']}}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if($setting['instagram']!="")
                                    <li><a class="instagram" href="{{$setting['instagram']}}"><i class="fa fa-instagram"></i></a></li>
                                @endif
                                @if($setting['telegram']!="")
                                    <li><a class="telegram" href="{{$setting['telegram']}}"><i class="fa fa-telegram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="subscribe_form">
                            <h3>هم اکنون عضو خبرنامه ما شوید</h3>
                            <form action="{{route('index.newslater-create')}}" class="mc-form " method="post">
                                @csrf
                                <input id="mc-email" name="email" type="email" placeholder="... آدرس ایمیل شما" dir="ltr" required>
                                <button id="mc-submit">اشتراک!</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div>
                                <!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div>
                                <!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div>
                                <!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <div class="copyright_area" style="text-align: center">
                        <span>2020 طراحی و توسعه توسط شرکت <a style="color: #ffb400;" href="https://imtit.com/">فناوری ریزپردازنده فراهوش</a></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<!--footer area end-->

{{--
<!-- modal area start-->
<div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div class="tab-content product-details-large">
                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="#"><img src="junko/img/product/product1.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="#"><img src="junko/img/product/product2.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="#"><img src="junko/img/product/product3.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="#"><img src="junko/img/product/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal_tab_button">
                                    <ul class="nav product_navactive owl-carousel" role="tablist">
                                        <li>
                                            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false"><img src="junko/img/product/product1.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><img src="junko/img/product/product2.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><img src="junko/img/product/product3.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><img src="junko/img/product/product5.jpg" alt=""></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="modal_title mb-10">
                                    <h2>گوشی موبایل Xiaomi Mi 9 Lite</h2>
                                </div>
                                <div class="modal_price mb-10">
                                    <span class="new_price">6,400,000 تومان</span>
                                    <span class="old_price">7,800,000 تومان</span>
                                </div>
                                <div class="modal_description mb-15">
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای </p>
                                </div>
                                <div class="variants_selects">
                                    <div class="variants_size">
                                        <h2>اندازه</h2>
                                        <select class="select_option">
                                            <option selected value="1">کوچک</option>
                                            <option value="1">متوسط</option>
                                            <option value="1">بزرگ</option>
                                        </select>
                                    </div>
                                    <div class="variants_color">
                                        <h2>رنگ</h2>
                                        <select class="select_option">
                                            <option selected value="1">بنفش</option>
                                            <option value="1">قرمز</option>
                                            <option value="1">مشکی</option>
                                            <option value="1">صورتی</option>
                                            <option value="1">نارنجی</option>
                                        </select>
                                    </div>
                                    <div class="modal_add_to_cart">
                                        <form action="#">
                                            <input min="0" max="100" step="2" value="1" type="number">
                                            <button type="submit">افزودن به سبد</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal_social">
                                    <h2>اشتراک گذاری این محصول</h2>
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li class="telegram"><a href="#"><i class="fa fa-telegram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal area end-->
--}}

<!--news letter popup start (uncomment lines 763-788 in main.js to show this)-->
<div class="newletter-popup">
    <div id="boxes" class="newletter-container">
        <div id="dialog" class="window">
            <div id="popup2">
                <span class="b-close"><span>بستن</span></span>
            </div>
            <div class="box">
                <div class="newletter-title">
                    <h2>خبرنامه</h2>
                </div>
                <div class="box-content newleter-content">
                    <label class="newletter-label">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</label>
                    <div id="frm_subscribe">
                        <form name="subscribe" id="subscribe_popup">
                            <input type="text" value="" name="subscribe_pemail" id="subscribe_pemail" placeholder="آدرس ایمیل خود را وارد کنید ...">
                            <input type="hidden" value="" name="subscribe_pname" id="subscribe_pname">
                            <div id="notification"></div>
                            <a class="theme-btn-outlined" onclick="email_subscribepopup()"><span>اشتراک</span></a>
                        </form>
                        <div class="subscribe-bottom">
                            <input type="checkbox" id="newsletter_popup_dont_show_again">
                            <label for="newsletter_popup_dont_show_again">دیگر این پاپ آپ را نشان نده</label>
                        </div>
                    </div>
                    <!-- /#frm_subscribe -->
                </div>
                <!-- /.box-content -->
            </div>
        </div>

    </div>
    <!-- /.box -->
</div>
<!--news letter popup start-->




<!-- JS
============================================ -->

<!-- Plugins JS -->
<script src="{{asset('junko/js/plugins.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('junko/js/main.js')}}"></script>


<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>


@yield('script_link')
@yield('script')
@if(session('save_newslater'))
    <script>
        alertify.set('notifier','position', 'bottom-left');
        alertify.success('ایمیل شما با موفقیت ثبت شد!');
    </script>
@endif
<script>
    function number_3_3(num, sep) {
        var number = typeof num === "number" ? num.toString() : num,
            separator = typeof sep === "undefined" ? ',' : sep;
        return number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1" + separator);
    }

    function search_header() {
        var search=$('input[name=search]').val();
        $('.result-search').empty();
        if (search.length>=3){
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('search.search')}}';
            var data = {_token: CSRF_TOKEN,search:search};
            $.post(url, data, function (msg) {
                $('.result-search').show();
                $('.result-search').append(msg)
            });
        }else{
            $('.result-search').hide();
        }
    }
    $('main').click(function () {
        $('.result-search').empty();
        $('.result-search').hide();
    })
    $('.header').click(function () {
        $('.result-search').empty();
        $('.result-search').hide();
    })

    function header(header) {
        window.location.replace(header);
    }
</script>
<script>

    function openNav() {
        document.getElementById("mySidenav").style.width = "320px";
        $('.humberger__menu__overlay').addClass('active');
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $('.humberger__menu__overlay').removeClass('active')
    }

    $('.humberger__menu__overlay').click(function () {
        document.getElementById("mySidenav").style.width = "0";
    })
    /*   $("input[name='demo3']").TouchSpin({
           min: 1,
       });*/

</script>
<script>

    function addcart(item, id) {

        $('.carts_table').html('');
        $.ajax({
            type: "post",
            url: "/addcart",
            data: {
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                $('.cart-total').html(data.countcart);
                $('#cartCount').html(data.msg);
                $('.minicart-total ').html(data.total);
                $('#p-t').html(data.total+' ت ');
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('.carts_table').append(' <div class="cart_item">\n' +
                        '                                            <div class="cart_img">\n' +
                        '                                                <a href="/product/'+value['options']['product_slug']+'"><img src="' + value['options']['image'] + '" alt="' + value['name'] + '"></a>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="cart_info">\n' +
                        '                                                <a href="/product/'+value['options']['product_slug']+'">' + value['name'] + '</a>\n' +
                        '                                                <p>تعداد: <span>' + value['qty'] + '</span> × <span> '+number_3_3(value['price'])+' تومان </span></p>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="cart_remove">\n' +
                        '                                                <a onclick="removecart(this, ' + rowId + ')"><i class="ion-android-close"></i></a>\n' +
                        '                                            </div>\n' +
                        '                                        </div>');
                });

                /*   $("input[name='demo3']").TouchSpin({
                       min: 1,
                   });*/


                $('.input-group-btn button').on("click touchstart", function (event) {

                    var el = $(this).parents('.bootstrap-touchspin').find('.form-control');

                    var qyt = el.val();
                    var id = $(el).attr('data-product-id');

                    $.ajax({
                        type: "post",
                        url: "/updatecart",
                        data: {
                            qyt: qyt,
                            id: id,
                            _token: '{{csrf_token()}}',
                        },
                        dataType: 'json',
                        success: function (data) {
                            console.log(data.msg);
                            $('#cartCount').html(data.countcart);
                            $('#cartDiscountT').html(data.total);
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success('سبد خرید بروزرسانی شد');
                        },
                        error: function (err) {
                            if (err.status == 422) {
                                $('#error_user').slideDown(100);
                                $.each(err.responseJSON.errors, function (i, error) {
                                    $('#error_item').append($('<span style="color: white;">' + error[
                                            0] +
                                        '</span><br>'));
                                });
                            }
                        }
                    });
                });
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('به سبد خرید اضافه شد');
            },
            error: function (err) {
                if (err.status == 422) {
                    $('#error_user').slideDown(100);
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('#error_item').append($('<span style="color: white;">' + error[
                                0] +
                            '</span><br>'));
                    });
                }
            }
        });

    }
</script>
<script>
    function removecart(item, id) {
        console.log(id);
        $.ajax({
            type: "post",
            url: "/removecart",
            data: {
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                $(item).parents('.cart_item').remove();
                $('.cart-total').html(data.countcart);
                $('#cartCount').html(data.countcart);
                $('.minicart-total').html(data.total);
                $('#p-t').html(data.total+' ت ');
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('محصول از سبد خرید حذف شد');
            },
            error: function (err) {
                if (err.status == 422) {
                    $('#error_user').slideDown(100);
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('#error_item').append($('<span style="color: white;">' + error[
                                0] +
                            '</span><br>'));
                    });
                }
            }
        });
    }


    $('.input-group-btn button').on("click touchstart", function (event) {
        var tag=this;
        var el = $(this).parents('.bootstrap-touchspin').find('.form-control');

        var qyt = el.val();
        var id = $(el).attr('data-product-id');

        $.ajax({
            type: "post",
            url: "/updatecart",
            data: {
                qyt: qyt,
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if(data.msg3){
                    alertify.set('notifier', 'position', 'bottom-left');
                    alertify.success('تعداد محصول بیش از حد مجاز است');
                }else{
                    $('#cartCount').html(data.countcart);
                    $('#cartDiscountT').html(data.total);
                    console.log(tag)
                    $(tag).parents('tr').find('.cartprice').html(data.price);
                    alertify.set('notifier', 'position', 'bottom-left');
                    alertify.success('سبد خرید بروزرسانی شد');
                }

            },
            error: function (err) {
                if (err.status == 422) {
                    $('#error_user').slideDown(100);
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('#error_item').append($('<span style="color: white;">' + error[
                                0] +
                            '</span><br>'));
                    });
                }
            }
        });
    });

</script>
<script>


    function favorite(tag, id) {
            @if(Auth::check())
        var count = $('.openfavorites span').html();
        var CSRF_TOKEN = '{{ csrf_token() }}';
        var url = '{{route('panel.add_remove_favorite')}}';
        var data = {_token: CSRF_TOKEN, id: id};
        $.post(url, data, function (msg) {
            if (msg == "add") {
                $(tag).css('color', 'red');
                alertify.set('notifier', 'position', 'bottom-left');
                count=parseInt(count)+1;
                $('.openfavorites span').html(count);
                alertify.success('با موفقیت به لیست علاقه مندی اضافه شد');
            } else if (msg == "deleted") {
                $(tag).css('color', '#000000');
                count=parseInt(count)-1;
                $('.openfavorites span').html(count);
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('با موفقیت از لیست علاقه مندی حذف شد');
            }
        });
        @else
            window.location = "/login";

        @endif
    }


</script>
</body>

</html>
