<!DOCTYPE html>
<html lang="zxx">
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
<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{@$seo_content}}">
    <meta name="keywords" content="{{@$seo_title}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{@$title}}</title>

    <!-- Google Font -->
{{--
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
--}}

<!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('ogani/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/shop.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('ogani/css/rtl_style.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('css/jquery.bootstrap-touchspin.css')}}">
    @yield('style_link')
    @yield('style')
    <style>
        .sidenav > .container {
            max-height: 360px;
            overflow-y: auto;
            overflow-x: hidden;
            margin-top: 10px;
        }
        .result-search{
            width: 609px;
            height: 200px;
            background: #ffffff;
            margin-top: 50px;
            overflow-y: scroll;
            z-index: 106;
            position: absolute;
            box-shadow: 3px 2px 3px 0px #ccc;
            margin-right: 1px;
            display: none;
        }
        .header__menu ul li{
            margin-left: 30px;
        }
    </style>
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="/"><img src="{{asset($setting['logo'])}}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a class="opencart" onclick="openNav()"><i class="fa fa-shopping-bag"></i>
                    <span>{{$countcart}}</span></a></li>
        </ul>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            @if(Auth::check())
                <a href="/login"><i class="fa fa-user"></i> ورود به پنل</a>
            @else
                <a href="/login"><i class="fa fa-user"></i> ورود</a>
            @endif
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">صفحه اصلی</a></li>
            <li><a href="/shop">فروشگاه</a></li>
            <li><a href="/blog">مقالات</a></li>
            <li><a href="/contact">تماس باما</a></li>
            <li><a href="/about"> درباره ما</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        @if($setting['facebook']!="")<a href="{{$setting['facebook']}}"><i class="fa fa-facebook"></i></a> @endif
        @if($setting['instagram']!="")<a href="{{$setting['instagram']}}"><i class="fa fa-instagram"></i></a> @endif
        @if($setting['twitter']!="")<a href="{{$setting['twitter']}}"><i class="fa fa-twitter"></i></a> @endif
        @if($setting['telegram']!="")<a href="{{$setting['telegram']}}"><i class="fa fa-telegram"></i></a> @endif
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i>{{$setting['email']}}</li>
            <li>ارسال رایگان برای همه سفارشات بالای 150 هزار تومان</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>{{$setting['email']}}</li>
                            <li>ارسال رایگان برای همه سفارشات بالای 150 هزار تومان</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__auth">
                            @if(Auth::check())
                                <a href="/login"><i class="fa fa-user"></i> ورود به پنل</a>
                            @else
                                <a href="/login"><i class="fa fa-user"></i> ورود</a>
                            @endif
                        </div>
                        <div class="header__top__right__social">
                            @if($setting['facebook']!="")<a href="{{$setting['facebook']}}"><i
                                    class="fa fa-facebook"></i></a> @endif
                            @if($setting['instagram']!="")<a href="{{$setting['instagram']}}"><i
                                    class="fa fa-instagram"></i></a> @endif
                            @if($setting['twitter']!="")<a href="{{$setting['twitter']}}"><i class="fa fa-twitter"></i></a> @endif
                            @if($setting['telegram']!="")<a href="{{$setting['telegram']}}"><i
                                    class="fa fa-telegram"></i></a> @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img style="max-width: 120px" src="{{asset($setting['logo'])}}" alt="logo"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="/">صفحه اصلی</a></li>
                        <li><a href="/shop">فروشگاه</a></li>
                        <li><a href="/blog">مقالات</a></li>
                        <li><a href="/contact">تماس باما</a></li>
                        <li><a href="/about"> درباره ما</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        @php
                            $favorites=App\Favorite::where('user_id',Auth::id())->get();
                        @endphp
                        <li><a class="openfavorites" href="/panel/favorites"><i class="fa fa-heart"></i>
                                <span>{{count($favorites)}}</span></a></li>

                        <li><a onclick="openNav()" class="opencart"><i class="fa fa-shopping-bag"></i>
                                <span>{{$countcart}}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
@if (!Request::is('/'))
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>همه بخش ها</span>
                        </div>
                        <ul class="list-unstyled">
                            @php
                                $categories=App\Category::where('parent','0')->get();
                            @endphp
                            @foreach($categories as $category)
                                <li class="">
                                    @php
                                        $categories2=App\Category::where('parent',$category->id)->get();
                                    @endphp
                                    <a @if(count($categories2))href="#homeSubmenu{{$category->id}}" ondblclick="header('{{'shop?cat='.$category->slug}}')"
                                       data-toggle="collapse" aria-expanded="false"
                                       @else href="{{'shop?cat='.$category->slug}}"
                                       @endif class="@if(count($categories2)) dropdown-toggle @endif ">{{$category->title}} </a>
                                    <ul class="collapse" id="homeSubmenu{{$category->id}}">

                                        @foreach($categories2 as $category2)
                                            @php
                                                $categories3=App\Category::where('parent',$category2->id)->get();
                                            @endphp
                                            <a @if(count($categories3))href="#homeSubmenu{{$category2->id}}" ondblclick="header('{{'shop?cat='.$category2->slug}}')"
                                               data-toggle="collapse" aria-expanded="false"
                                               @else href="{{'shop?cat='.$category2->slug}}"
                                               @endif class="@if(count($categories3)) dropdown-toggle @endif">{{$category2->title}} </a>
                                            <ul class="collapse" id="homeSubmenu{{$category2->id}}">

                                                @foreach($categories3 as $category3)
                                                    <li>
                                                        <a href="{{'shop?cat='.$category3->slug}}" class="category_click"
                                                           onclick="">{{$category3->title}} </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input name="search" onkeyup="search_header()" type="text" placeholder="به چه چیزی نیاز دارید؟">
                                <button type="submit" class="site-btn">جستوجو</button>
                            </form>

                        </div>
                        <div class="result-search">

                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{$setting['tell']}}</h5>
                                <span>با پشتیبانی 7/24</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
@endif
<div id="mySidenav" class="sidenav">
    <div class="card">
        <div class="card-body">
            <div class="row" align="center">
                @if(Auth()->check())
                    <div class="col-6">
                    </div>
                @else
                    <div class="col-6">
                        <a style="border-radius: 20px !important; font-size: 12px !important;" class="btn btn-primary"
                           href="/login">لطفا وارد شوید</a>
                    </div>
                @endif
                <div class="col-6">
                    <a style="border-radius: 20px !important; font-size: 12px !important;" href="javascript:void(0)"
                       class="btn btn-danger" onclick="closeNav()">بستن سبد خرید</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" align="center" id="w-basket-items">

            @foreach($carts as $cart)
                <div class="col-12" style="margin-bottom: 10px">
                    <div class="card" style="box-shadow: 0px 3px 3px -2px #bbbbbbb8;">
                        <div class="card-body" style="padding: 0px 2px 12px 14px;">
                            <div class="row">
                                <div class="col-10"></div>
                                <div class="col-2" style="padding-left: 2px">
                                    <a style="padding: 0 0 0 0;cursor: pointer"
                                       onclick="removecart(this, '{{$cart->rowId}}')"><i
                                            style="color: #dadada;font-size: 14px" class="fa fa-close"></i></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3" style="padding-right: 21px;padding-left: 0">
                                    <img width="100%" src="{{$cart->options->image}}" alt="">
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 style="font-size: 10px;text-align: right; line-height: 2;">{{$cart->name}}</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6" style="padding:0;">
                                            <span style="font-size: 13px;color: #00ad9c">{{number_format($cart->price)}} تومان</span>
                                        </div>
                                        <div class="col-6" style="padding:0 5px 0 5px">
                                            <input type="text" data-product-id="{{$cart->id}}" value="{{$cart->qty}}"
                                                   name="demo3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="card"
         style="z-index:999;box-shadow: 0px 3px 3px -2px #bbbbbbb8;bottom: 75px;position: fixed;width: 320px">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6" style="text-align: center;">
                    <span style="font-size: 14px" class="d-block mb-2">مجموع اقلام</span>
                    <div class="offcanvas-header_price">
                        <div style="font-size: 14px;color: #1f91f3 !important;"
                             class="offcanvas-header_price-value text-secondary text-center"><span
                                id="cartCount">{{$countcart}}</span> <span
                                class="offcanvas-header_price-currency">مورد</span></div>
                    </div>
                </div>

                <div class="col-6" style="text-align: center;border-right: 1px solid #E6E6E6">
                    <span style="font-size: 14px" class="d-block mb-2">مبلغ قابل پرداخت</span>
                    <div class="offcanvas-header_price">
                        <div style="font-size: 14px" class="offcanvas-header_price-value text-secondary text-center">
                            <span id="cartDiscountT">{{$total_price}}</span> <span
                                class="offcanvas-header_price-currency">تومان</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="z-index:999;position: fixed;bottom: 0;width: 320px">
        @if(Auth()->check())
            <a style="width: 100%;padding: 20px 0 !important;background: #fa725f" class="btn" href="/checkout">تکمیل
                سفارش</a>
        @else
            <a style="width: 100%;padding: 20px 0 !important;background: #fa725f;color: #fff" class="btn">شما هنوز وارد
                نشده اید!</a>
        @endif
    </div>
</div>
<main>
    @yield('content')
</main>

<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="/"><img style="max-width: 120px;" src="{{asset($setting['logo'])}}" alt=""></a>
                    </div>
                    <ul>
                        <li>آدرس:{{$setting['address']}}</li>
                        <li>تلفن: {{$setting['tell']}}</li>
                        <li>ایمیل: {{$setting['email']}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>آخرین مقالات</h6>
                    @php
                        $posts = App\Post::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(2)->get();
                    @endphp
                    <div class="row">

                     @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img style="height: 105px" src="{{asset($post->imgPath)}}" alt="">
                                    </div>
                                    <div class="blog__item__text" style="padding-top: 10px;">
                                        <ul style="float: right; width: 100%;margin-bottom: 0;">
                                            <li style="font-size: 12px;"><i class="fa fa-calendar-o"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                                            <li style="font-size: 12px;"><i class="fa fa-comment-o"></i> 5</li>
                                        </ul>
                                        <h5><a style="font-size: 13px;" href="/blog/{{$post->slug}}">{{$post->title}}</a></h5>
                                        <p style="font-size: 12px;">{{str_limit($post->shortContent,50)}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>اکنون به خبرنامه ما بپیوندید</h6>
                    <p>در مورد آخرین محصولات و پیشنهادات ویژه ما ،ایمیل را دریافت کنید.</p>
                    <form action="#">
                        <input type="email" name="email" placeholder="ایمیل خود را وارد کنید">
                        <button type="submit" class="site-btn">اشتراک</button>
                    </form>
                    <div class="footer__widget__social">
                        @if($setting['facebook']!="")<a href="{{$setting['facebook']}}"><i
                                class="fa fa-facebook"></i></a> @endif
                        @if($setting['instagram']!="")<a href="{{$setting['instagram']}}"><i
                                class="fa fa-instagram"></i></a> @endif
                        @if($setting['twitter']!="")<a href="{{$setting['twitter']}}"><i
                                class="fa fa-twitter"></i></a> @endif
                        @if($setting['telegram']!="")<a href="{{$setting['telegram']}}"><i
                                class="fa fa-telegram"></i></a> @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            <script>document.write(new Date().getFullYear());</script>
                            طراحی و توسعه توسط شرکت<i class="fa fa-heart" aria-hidden="true"></i> <a
                                href="https://imtit.com" target="_blank">فناوری ریزپردازنده فراهوش</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                    {{--<div class="footer__copyright__payment"><img src="{{asset('front/img/payment-item.png')}}" alt=""></div>--}}
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{asset('ogani/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('ogani/js/bootstrap.min.js')}}"></script>
<script src="{{asset('ogani/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('ogani/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('ogani/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('ogani/js/mixitup.min.js')}}"></script>
<script src="{{asset('ogani/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('ogani/js/main.js')}}"></script>
<script src="{{asset('js/pages/ui/notifications.js')}}"></script>
<script src="{{asset('js/jquery.bootstrap-touchspin.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
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

        $('#w-basket-items').html('');
        $.ajax({
            type: "post",
            url: "/addcart",
            data: {
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                $('.opencart span').html(data.countcart);
                $('#cartCount').html(data.countcart);
                $('#cartDiscountT').html(data.total);
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('#w-basket-items').append('<div class="col-12" style="margin-bottom: 10px">\n' +
                        '                <div class="card" style="box-shadow: 0px 3px 3px -2px #bbbbbbb8;">\n' +
                        '                    <div class="card-body" style="padding: 0px 2px 12px 14px;">\n' +
                        '                        <div class="row">\n' +
                        '                            <div class="col-10"></div>\n' +
                        '                            <div class="col-2" style="padding-left: 2px">\n' +
                        '                                <a style="padding: 0 0 0 0;cursor: pointer"  onclick="removecart(this, ' + rowId + ')"><i style="color: #dadada;font-size: 14px" class="fa fa-close"></i></a>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '\n' +
                        '                        <div class="row">\n' +
                        '                            <div class="col-3" style="padding-right: 21px;padding-left: 0">\n' +
                        '                                <img width="100%" src="' + value['options']['image'] + '" alt="">\n' +
                        '                            </div>\n' +
                        '                            <div class="col-9">\n' +
                        '                                <div class="row">\n' +
                        '                                    <div class="col-12">\n' +
                        '                                        <h6 style="font-size: 10px;text-align: right; line-height: 2;">' + value['name'] + '</h6>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                                <div class="row align-items-center">\n' +
                        '                                    <div class="col-6" style="padding: 0">\n' +
                        '                                        <span style="font-size: 13px;color: #00ad9c">' + number_3_3(value['price']) + ' تومان</span>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="col-6" style="padding:0 5px 0 5px">\n' +
                        '                                        <input type="text" data-product-id="' + value['id'] + '" value="' + value['qty'] + '" name="demo3">\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div>');
                });

                $("input[name='demo3']").TouchSpin({
                    min: 1,
                });


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
                $(item).parents('.col-12').remove();
                $('.opencart span').html(data.countcart);
                $('#cartCount').html(data.countcart);
                $('#cartDiscountT').html(data.total);
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
