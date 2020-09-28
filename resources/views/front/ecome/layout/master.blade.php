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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ایکام | قالب HTML فروشگاهی و چندمنظوره ایکام</title>
    <link rel="stylesheet" href="{{asset('ecome/css/owl.carousel.min.css')}}">
    <link rel="shortcut icon" href="{{asset('ecome/img/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('ecome/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('ecome/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('ecome/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('ecome/css/style.css')}}">


    <style>
        .icon-wishlist2 {
            background-image: url({{asset('ecome/img/icon-heart3.png')}});
            background-repeat: no-repeat;
            height: 18px;
            width: 21px;
        }
        @media (min-width: 1200px){
            .header-search input {
                width: 647px;
            }
        }
        .header-search input {
            border-radius: 31px;
            border-left: unset;
        }
    </style>
</head>

<body>
<!-- push menu-->
<div class="pushmenu menu-home5">
    <div class="menu-push">
        <span class="close-left js-close"><i class="icon-close f-20"></i></span>
        <div class="clearfix"></div>
        <form role="search" method="get" id="searchform" class="searchform" action="/search">
            <div>
                <label class="screen-reader-text" for="q"></label>
                <input type="text" placeholder="جستجو در میان محصولات ..." value="" name="q" id="q" autocomplete="off"><input type="hidden" name="type" value="product"><button type="submit" id="searchsubmit"><i class="ion-ios-search-strong"></i></button>
            </div>
        </form>
        <ul class="nav-home5 js-menubar">
            <li class="level1 active dropdown"><a href="#">صفحه نخست</a>
                <span class="icon-sub-menu"></span>
                <ul class="menu-level1 js-open-menu">
                    <li class="level2"><a href="home1.html" title="">سبک یک</a></li>
                    <li class="level2"><a href="home2.html" title="">سبک دو</a></li>
                    <li class="level2"><a href="home3.html" title="">سبک سه</a></li>
                    <li class="level2"><a href="home4.html" title="">سبک چهار</a></li>
                    <li class="level2"><a href="home5.html" title="">سبک پنج</a></li>
                    <li class="level2"><a href="#" title="">سبک شش</a></li>

                </ul>
            </li>
            <li class="level1 active dropdown"><a href="#">لیست محصولات</a>
                <span class="icon-sub-menu"></span>
                <div class="menu-level1 js-open-menu">
                    <ul class="level1">
                        <li class="level2">
                            <a href="#">سبک های مختلف</a>
                            <ul class="menu-level-2">
                                <li class="level3"><a href="shop_full.html" title="">سبک تمام عرض</a></li>
                                <li class="level3"><a href="shopgrid_v1.html" title="">سبک گرید یک</a></li>
                                <li class="level3"><a href="shopgrid_v2.html" title="">سبک گرید دو</a></li>
                                <li class="level3"><a href="shoplist.html" title="">سبک عادی</a></li>
                                <li class="level3"><a href="shopleft_sidebar.html" title="">با ستون کناری چپ</a></li>
                                <li class="level3"><a href="shopright_sidebar.html" title="">با ستون کناری راست</a></li>
                            </ul>
                        </li>
                        <li class="level2">
                            <a href="#">سبک دسته بندیها</a>
                            <ul class="menu-level-2">
                                <li class="level3"><a href="cat_fullwidth.html" title="">سبک تمام عرض</a></li>
                                <li class="level3"><a href="cat_left_sidebar.html" title="">با ستون کناری چپ</a></li>
                                <li class="level3"><a href="cat_right_sidebar.html" title="">با ستون کناری راست</a></li>
                            </ul>
                        </li>
                        <li class="level2">
                            <a href="#">سبک های نمونه محصول</a>
                            <ul class="menu-level-2">
                                <li class="level3"><a href="bundle.html" title="">سبک عادی</a></li>
                                <li class="level3"><a href="pin_product.html" title="">پین محصول</a></li>
                                <li class="level3"><a href="360degree.html" title="">حالت 360 درجه</a></li>
                                <li class="level3"><a href="feature_video.html" title="">با امکان ویدیوی محصول</a></li>
                                <li class="level3"><a href="simple.html">سبک ساده</a></li>
                                <li class="level3"><a href="variable.html">سبک متغیر</a></li>
                                <li class="level3"><a href="affilate.html">سبک همکاری در فروش</a></li>
                                <li class="level3"><a href="grouped.html">سبک گروهی</a></li>
                                <li class="level3"><a href="outofstock.html">سبک ناموجودی محصول</a></li>
                                <li class="level3"><a href="onsale.html">سبک حراجی</a></li>
                            </ul>
                        </li>
                        <li class="level2">
                            <a href="#">طرح های نمونه محصول</a>
                            <ul class="menu-level-2">
                                <li class="level3"><a href="product_extended.html" title="">طرح عادی</a></li>
                                <li class="level3"><a href="product_sidebar.html" title="">با ستون کناری چپ</a></li>
                                <li class="level3"><a href="product_right_sidebar.html" title="">با ستون کناری راست</a></li>
                            </ul>
                        </li>
                        <li class="level2">
                            <a href="#">دیگر صفحات</a>
                            <ul class="menu-level-2">
                                <li class="level3"><a href="shop_full.html" title="">لیست محصولات</a></li>
                                <li class="level3"><a href="cart.html" title="">سبد خرید</a></li>
                                <li class="level3"><a href="wishlist.html" title="">علاقه مندیها</a></li>
                                <li class="level3"><a href="checkout.html" title="">صورتحساب</a></li>
                                <li class="level3"><a href="myaccount.html" title="">حساب من</a></li>
                                <li class="level3"><a href="track.html" title="">رهگیری سفارشات</a></li>
                                <li class="level3"><a href="quickview.html" title="">نمایش سریع</a></li>

                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </li>
            <li class="level1 active dropdown"><a href="#">مگامنو</a></li>
            <li class="level1">
                <a href="#">صفحات</a>
                <span class="icon-sub-menu"></span>
                <ul class="menu-level1 js-open-menu">
                    <li class="level2"><a href="aboutus.html" title="">درباره ما </a></li>
                    <li class="level2"><a href="contactus.html" title="">ارتباط با ما</a></li>
                    <li class="level2"><a href="faq.html" title="">پرسش های متداول</a></li>
                    <li class="level2"><a href="404.html" title="">404</a></li>
                    <li class="level2"><a href="commingsoon.html" title="">بزودی</a></li>
                </ul>
            </li>
            <li class="level1">
                <a href="#">نوشته های وبلاگ</a>
                <span class="icon-sub-menu"></span>
                <ul class="menu-level1 js-open-menu">
                    <li class="level2"><a href="blog-standar.html" title="">سبک استاندارد</a></li>
                    <li class="level2"><a href="blog_grid.html" title="">سبک گرید</a></li>
                    <li class="level2"><a href="blog-standar.html" title="">با ستون کناری</a></li>
                    <li class="level2"><a href="blog-single-post.html" title="">نوشته وبلاگ</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end push menu-->
<div class="wrappage">
    <header id="header" class="header-v2">
        <div class="header-top-banner">
            <a href="#"><img src="{{asset('ecome/img/banner-top.jpg')}}" alt="" class="img-reponsive"></a>
        </div>
        <div class="header-center">
            <div class="container container-240">
                <div class="row flex">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 v-center header-logo">
                        <a href="#"><img src="img/logo.png" alt="" class="img-reponsive"></a>
                    </div>
                    <div class="col-lg-7 col-md-7 v-center header-search hidden-xs hidden-sm">
                        <form method="get" class="searchform ajax-search" action="/search" role="search">
                            <input onkeyup="searchproduct()" type="text" name="q45" class="form-control" placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید ...">
                            <ul style="width: 100%" class="list-product-search hidden-xs hidden-sm wrq">
                            </ul>
                            <span class="input-group-btn">
                                          <button class="button_search" type="button"><i class="ion-ios-search-strong"></i></button>
                                </span>
                        </form>
                    </div>
                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-6 v-center header-sub">
                        <div class="right-panel">
                            <div class="header-sub-element row">
                                <a class="hidden-xs hidden-sm" href=""><img src="img/icon-user.png" alt=""></a>
                                <a href="#"><img src="img/icon-heart.png" alt=""></a>
                                <div class="cart">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="label5">
                                        <img src="img/icon-cart.png" alt="">
                                        <span class="count cart-count">0</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-cart">
                                        <ul class="mini-products-list">
                                            <li class="item-cart">
                                                <div class="product-img-wrap">
                                                    <a href="#"><img src="img/cart1.jpg" alt="" class="img-reponsive"></a>
                                                </div>
                                                <div class="product-details">
                                                    <div class="inner-left">
                                                        <div class="product-name"><a href="#">ظرف غذای سفری گودی مدل ۷۱۰۸ </a></div>
                                                        <div class="product-price">
                                                            99 هزار تومان <span>( x2)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="e-del"><i class="ion-ios-close-empty"></i></a>
                                            </li>
                                            <li class="item-cart">
                                                <div class="product-img-wrap">
                                                    <a href="#"><img src="img/cart1.jpg" alt="" class="img-reponsive"></a>
                                                </div>
                                                <div class="product-details">
                                                    <div class="inner-left">
                                                        <div class="product-name"><a href="#">ظرف غذای سفری گودی مدل ۷۱۰۸ </a></div>
                                                        <div class="product-price">
                                                            99 هزار تومان <span>( x2)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="e-del"><i class="ion-ios-close-empty"></i></a>
                                            </li>
                                        </ul>
                                        <div class="bottom-cart">
                                            <div class="cart-price">
                                                <span>جمع کل</span>
                                                <span class="price-total">99 هزار تومان</span>
                                            </div>
                                            <div class="button-cart">
                                                <a href="#" class="cart-btn btn-viewcart">سبد خرید</a>
                                                <a href="#" class="cart-btn e-checkout btn-gradient">صورتحساب</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="hidden-md hidden-lg icon-pushmenu js-push-menu">
                                    <i class="fa fa-bars f-15"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom hidden-xs hidden-sm">
            <div class="flex lr">
                <div class="box-header-nav">
                    <nav class="main-menu">
                        <ul class="nav navbar-nav">
                            <li class="level1 active hassub"><a href="#">صفحه نخست</a>
                                <span class="plus js-plus-icon"></span>
                                <div class="menu-level-1 ver2 dropdown-menu">
                                    <div class="row">
                                        <div class="cate-item col-md-4 col-sm-12">
                                            <div class="demo-img">
                                                <a href="home1.html">
                                                    <img src="img/demo/demo1.jpg" alt="" class="img-reponsive">
                                                </a>
                                            </div>
                                            <div class="demo-text">سبک یک</div>
                                        </div>
                                        <div class="cate-item col-md-4 col-sm-12">
                                            <div class="demo-img">
                                                <a href="home2.html"><img src="img/demo/demo2.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="demo-text">سبک دو</div>
                                        </div>
                                        <div class="cate-item col-md-4 col-sm-12">
                                            <div class="demo-img">
                                                <a href="home3.html"><img src="img/demo/demo3.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="demo-text">سبک سه</div>
                                        </div>
                                        <div class="cate-item col-md-4 col-sm-12">
                                            <div class="demo-img">
                                                <a href="home4.html"><img src="img/demo/demo4.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="demo-text">سبک چهار</div>
                                        </div>
                                        <div class="cate-item col-md-4 col-sm-12">
                                            <div class="demo-img">
                                                <a href="home5.html"><img src="img/demo/demo5.jpg" alt="" class="img-reponsive"></a>
                                            </div>
                                            <div class="demo-text">سبک پنج</div>
                                        </div>
                                        <div class="cate-item col-md-4 col-sm-12">
                                            <div class="demo-img">
                                                <a href="#"><img src="img/demo/demo6.jpg" alt="" class="img-reponsive"></a>
                                                <div class="overlay-img box-center">
                                                    <a href="#" class="btn-gradient btn-csoon">بزودی</a>
                                                </div>
                                            </div>
                                            <div class="demo-text">بزودی</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="level1"><a style="cursor: pointer" class=" e-icon-menu icon-pushmenu js-push-menu">دسته بندی ها</a></li>
                            <li class="level1"><a href="#">سیستم های صوتی <span class="h-ribbon h-pos v4 e-skyblue">ویژه</span></a></li>
                            <li class="level1"><a href="#">دوربین های دیجیتال <span class="h-ribbon h-pos v4 e-red">جدید</span></a></li>
                            <li class="level1"><a href="#"> گوشی موبایل</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- /header -->

    @yield('content')



    <footer>
        <div class="f-top">
            <div class="container container-240">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="footer-block footer-about">
                            <div class="f-logo">
                                <a href="#"><img src="img/logo.png" alt="" class="img-reponsive"></a>
                            </div>
                            <ul class="footer-block-content">
                                <li class="address">
                                    <span>ایران، تهران، شهرک غرب یک، خیابان فلان فلانی نسب</span>
                                </li>
                                <li class="phone">
                                    <span>(+123) 456 789 - (+123) 666 888</span>
                                </li>
                                <li class="email">
                                    <span>Contact@yourcompany.com</span>
                                </li>
                                <li class="time">
                                    <span>شنبه تا چهارشنبه 9:00 - 5:00  &nbsp;&nbsp;&nbsp;  یکشنبه : تعطیل</span>
                                </li>
                            </ul>
                            <div class="footer-social social">
                                <h3 class="footer-block-title">شبکه های اجتماعی</h3>
                                <a href="#" class="fa fa-twitter"></a>
                                <a href="#" class="fa fa-dribbble"></a>
                                <a href="#" class="fa fa-behance"></a>
                                <a href="#" class="fa fa-instagram"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                        <div class="footer-block">
                            <h3 class="footer-block-title">دسترسی سریع</h3>
                            <ul class="footer-block-content">
                                <li><a href="#">موبایل و تبلت</a></li>
                                <li><a href="#">کامپیوتر های خانگی</a></li>
                                <li><a href="#">صوتی و تصویری</a></li>
                                <li><a href="#">لوازم خانگی</a></li>
                                <li><a href="#">زیبایی و بهداشت</a></li>
                                <li><a href="#">کنسول های بازی</a></li>
                                <li><a href="#">هایپرمارکت</a></li>
                                <li><a href="#">خودرو و لوازم</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                        <div class="footer-block">
                            <h3 class="footer-block-title">خمات مشتریان</h3>
                            <ul class="footer-block-content">
                                <li><a href="#">حساب من</a></li>
                                <li><a href="#">رهگیری سفارشات</a></li>
                                <li><a href="#">همکاری در فروش</a></li>
                                <li><a href="#">پرسش و پاسخ</a></li>
                                <li><a href="#">خدمات بیشتر</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="footer-block">
                            <div class="footer-block-phone">
                                <h3 class="footer-block-title">سوالی دارید، مطرح کنید</h3>
                                <p class="phone-desc">تماس بگیرید، پاسخگو هستیم</p>
                                <p class="phone-light">(+123) 456 789 یا (+123) 666 888</p>
                            </div>
                            <div class="footer-block-newsletter">
                                <h3 class="footer-block-title">عضویت در خبرنامه</h3>
                                <p>برای دریافت تازه ترین کوپن های تخفیف ایمیل خود را وارد کنید</p>
                                <form class="form_newsletter" action="#" method="post">
                                    <input type="email" value="" placeholder="ایمیل خود را وارد کنید" name="EMAIL" id="mail" class="newsletter-input form-control">
                                    <button id="subscribe2" class="button_mini btn btn-gradient" type="submit">
                                        عضویت
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="f-bottom">
            <div class="container container-240">
                <div class="row flex lr">
                    <div class="col-xs-6 f-copyright"><span>کپی رایت © 2010-2018. کلیه حقوق محفوظ است.</span></div>
                    <div class="col-xs-6 f-payment hidden-xs">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{asset('ecome/js/jquery.js')}}"></script>
<script src="{{asset('ecome/js/bootstrap.js')}}"></script>
<script src="{{asset('ecome/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('ecome/js/slick.min.js')}}"></script>
<script src="{{asset('ecome/js/countdown.js')}}"></script>
<script src="{{asset('ecome/js/main.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
<!-- JS Part End-->
@yield('script_link')
@yield('script')
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
    $("input[name='demo3']").TouchSpin({
        min: 1,
    });

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
                $('#cart-total span').html(data.countcart);
                $('#countcard').html(data.countcart);
                $('#cartDiscountT span').html(data.total);
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('.carts_table').append('  <tr>\n' +
                        '                                            <td style="width: 60px" class="text-center"><a href="/product/'+value['options']['product_slug']+'"><img class="img-thumbnail" title="' + value['name'] + '" alt="' + value['name'] + '" src="' + value['options']['image'] + '"></a></td>\n' +
                        '                                            <td style="padding: 1px 10px;" class="text-left"><a href="/product/'+value['options']['product_slug']+'">' + value['name'] + '</a></td>\n' +
                        '                                            <td class="text-right">' + value['qty'] + '</td>\n' +
                        '                                            <td style="min-width: 105px;padding: 8px 0;" class="text-right">' + number_3_3(value['price']) + '  تومان</td>\n' +
                        '                                            <td class="text-center"><button onclick="removecart(this, ' + rowId + ')" class="btn btn-danger btn-xs remove" title="حذف" onClick="" type="button"><i class="fa fa-times"></i></button>' +
                        '                                            <input type="hidden" data-product-id="' + value['id'] + '" value="' + value['qty'] + '" name="demo3"></td>\n' +
                        '                                        </tr>');
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
                            $('#cartCount span').html(data.countcart);
                            $('#cartDiscountT span').html(data.total);
                            alertify.set('notifier', 'position', 'bottom-center');
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
                alertify.set('notifier', 'position', 'bottom-center');
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
        $.ajax({
            type: "post",
            url: "/removecart",
            data: {
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                $(item).parents('tr').remove();
                // $('#cart-total span').html(data.countcart);
                $('#countcard').html(data.countcart);
                // $('#cartDiscountT span').html(data.total);
                $('#cartCount').html(data.countcart);
                $('#cartDiscountT').html(data.total);
                alertify.set('notifier', 'position', 'bottom-center');
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
                if(data.msg3 == 'notproduct'){
                    alertify.set('notifier', 'position', 'bottom-center');
                    alertify.success('اتمام موجودی انبار');
                }else{
                    $('#cartCount').html(data.countcart);
                    $('#cartDiscountT').html(data.total);
                    alertify.set('notifier', 'position', 'bottom-center');
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
                $(tag).find('span').removeClass('icon-wishlist').addClass('icon-wishlist2');
                alertify.set('notifier', 'position', 'bottom-center');
                count=parseInt(count)+1;
                $('.openfavorites span').html(count);
                alertify.success('با موفقیت به لیست علاقه مندی اضافه شد');
            } else if (msg == "deleted") {
                $(tag).find('span').removeClass('icon-wishlist2').addClass('icon-wishlist');
                count=parseInt(count)-1;
                $('.openfavorites span').html(count);
                alertify.set('notifier', 'position', 'bottom-center');
                alertify.success('با موفقیت از لیست علاقه مندی حذف شد');
            }
        });
        @else
            window.location = "/login";

        @endif
    }

    function searchproduct() {
        $('.wrq').html('');
        var qw = $("input[name='q45']").val();
        if(qw.length >= 2){
            $('.wrq').html('');
            $.ajax({
                type: "post",
                url: "/searchproduct",
                data: {
                    qw: qw,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function (data) {
                    $('.wrq').html('');
                    $.each(data.products, function (i, value) {
                        $('.wrq').append('<li>\n' +
                            '    <a class="flex align-center" href="/product/'+ value.slug +'">\n' +
                            '        <div class="product-img">\n' +
                            '\t\t\t<img src="/'+ value.image +'" alt="">\n' +
                            '        </div>\n' +
                            '\t\t<h3 class="product-title">'+ value.title +'</h3>\n' +
                            '    </a>\n' +
                            '</li>')
                    });
                },
                error: function (err) {
                    if (err.status == 422) {
                        $('#error_user').slideDown(100);
                        $.each(err.responseJSON.errors, function (i, error) {
                            console.log(error[0]);
                        });
                    }
                }
            });
        }

    }

</script>

<script>

    function qtycart(item) {

        var qyt = $(item).val();
        var id = $(item).attr('data-product-id');

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
                if (data.msg3 == 'notproduct') {
                    alertify.set('notifier', 'position', 'bottom-center');
                    alertify.success('اتمام موجودی انبار');
                } else if (data.msg4 == 'notexistproduct') {
                    alertify.set('notifier', 'position', 'bottom-center');
                    alertify.success('این محصول هنوز به سبد خرید اضافه نشده است');
                } else {
                    $('#cartCount').html(data.countcart);
                    $('#cartDiscountT').html(data.total);
                    alertify.set('notifier', 'position', 'bottom-center');
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
    }
</script>

</body>
</html>
