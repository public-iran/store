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

    <!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords" content="{{@$seo_title}}">
    <title>{{@$title}} </title>
    <meta name="description" content="{{@$seo_content}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link href="{{asset('jico/images/favicon.ico')}}" type="img/x-icon" rel="shortcut icon">
    <!-- All css files are included here. -->
    <link rel="stylesheet" href="{{asset('jico/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('jico/css/vendor/iconfont.min.css')}}">
    <link rel="stylesheet" href="{{asset('jico/css/vendor/helper.css')}}">
    <link rel="stylesheet" href="{{asset('jico/css/plugins/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('jico/css/style.css')}}">
    <!-- Modernizr JS -->
    <script src="{{asset('jico/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#e5e5e5">
    @yield('style_link')
    @yield('style')
    <style>
        .product-name{
            white-space: inherit;
        }
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
            box-shadow:1px 1px 3px 0px #ccc
            margin-right: 1px;
            display: none;
            overflow-x: hidden;
        }
    </style>
</head>

<body>

<div id="main-wrapper">


    <!--Header section start-->
    <header class="header header-transparent header-center header-sticky d-none d-lg-block">
        <div class="header-top">
            <div class="container-fluid">
                <div class="row">

                    <!--Links start-->
                    <div class="header-top-contact col-lg-12 col-md-12">
                        <ul>
                            <li>راه آسان برای صرفه جویی در هنگام خرید</li>
                        </ul>
                    </div>
                    <!--Links end-->
                </div>

            </div>
        </div>
        <div class="header-bottom menu-right">
            <div class="container-fluid pl-30 pr-30">
                <div class="row align-items-center">

                    <!--Logo start-->
                    <div class="col-xl-1 col-12 text-center mt-20 mb-20">
                        <div class="logo">
                            <a href="/"><img src="{{asset($setting['logo'])}}" alt="{{$setting['title']}}"></a>
                        </div>
                    </div>
                    <!--Logo end-->

                    <!--Menu start-->
                    <div class="col-xl-7 col-12">
                        <nav class="main-menu">
                            <ul>
                                <li><a href="/">صفحه  اصلی </a></li>
                                @php
                                    $categories = App\Category::where('parent', '0')->get();
                                @endphp
                                @foreach($categories as $category)
                                <li>
                                    <a href="/shop?cat={{$category->slug}}">{{$category->title}} <span class="lnr lnr-chevron-down"></span></a>
                                    @php
                                        $categories2=App\Category::where('parent',$category->id)->get();
                                    @endphp
                                    @if(count($categories2))
                                    <ul class="mega-menu four-column">

                                        <li>
                                            <?php
                                            $i=1;
                                            foreach($categories2 as $category2){
                                                if ($i % 5 == 0) {
                                                    $categories3=App\Category::where('parent',$category2->id)->get();
                                                    ?>
                                        </li>
                                        <li>
                                        <?php } ?>
                                            <a href="/shop?cat={{$category2->slug}}" class="item-link">{{$category2->title}}</a>
                                        <?php  $categories3=App\Category::where('parent',$category2->id)->get();   ?>
                                            <ul>
                                                <?php foreach($categories3 as $category3){?>
                                                <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}}</a></li>
                                                    <?php } ?>

                                            </ul>
                                        <?php $i++; } ?>
                                        </li>

                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                                <li><a href="/blog">وبلاگ </a></li>

                                <li><a href="/about">درباره ما</a></li>
                                <li><a href="/contact">تماس با ما</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--Menu end-->

                    <!-- Cart & Search Area Start -->
                    <div class="col-xl-4 col-12 d-flex justify-content-xl-end justify-content-center">
                        <div class="header-search-area">
                            <div class="header-search-form">
                                <form action="#">
                                    <button><span class="lnr lnr-magnifier"></span></button>
                                    <input onkeyup="search_header()" name="search" type="text" placeholder="جستجوی محصول ...">
                                </form>
                            </div>
                        </div>
                        <ul class="ht-us-menu">
                            <li><a href="/panel/favorites"><span class="lnr lnr-heart"></span></a></li>
                        </ul>
                        <div class="header-cart">
                            <a href="/cart"><span class="lnr lnr-cart"></span><span id="cart-total" class="count">{{$countcart}}</span></a>
                            <!--Mini Cart Dropdown Start-->
                            <div class="header-cart-dropdown">
                                <ul class="carts_table cart-items">
                                    @foreach($carts as $cart)
                                    <li class="single-cart-item">
                                        <div class="cart-img">
                                            <a href="/product/{{asset($cart->options->product_slug)}}"><img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}"></a>
                                        </div>
                                        <div class="cart-content">
                                            <h5 class="product-name"><a href="/product/{{asset($cart->options->product_slug)}}">{{$cart->name}}</a></h5>
                                            <span class="product-quantity">{{$cart->qty}} ×</span>
                                            <span class="product-price">{{number_format($cart->price)}} تومان</span>
                                        </div>
                                        <div class="cart-item-remove">
                                            <a onclick="removecart(this, '{{$cart->rowId}}')" title="برداشتن" href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="cart-total">
                                    <h5>مجموع سبد: <span class="float-right" id="cartCount">{{$countcart}}</span></h5>

                                    <h5>کل: <span class="float-right"><span class="minicart-total">{{$total_price}}</span> تومان</span></h5>
                                </div>
                                <div class="cart-btn">
                                    <a href="/cart">مشاهده سبد  </a>
                                    <a href="/checkout">پرداخت </a>
                                </div>
                            </div>
                            <!--Mini Cart Dropdown End-->
                        </div>
                        <ul class="ht-us-menu">
                            <li><a><span class="lnr lnr-menu-circle"></span></a>
                                <ul class="ht-dropdown right">
                                    @if(Auth::check())
                                    <li><a href="/panel">حساب من</a></li>
                                    <li><a href="/panel/favoritesl">لیست علاقه مندی</a></li>
                                        <li><a href="/logout">خروج</a></li>
                                    @else
                                        <li><a href="/login">ورود</a></li>
                                        <li><a href="/register">ثبت نام</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>

                        <div class="result-search col-md-12" style="position: absolute;top: 45px">

                        </div>
                    </div>
                    <!-- Cart & Search Area End -->
                </div>

            </div>
        </div>
    </header>
    <!--Header section end-->

    <!--Header Mobile section start-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-bottom menu-right">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-mobile-navigation d-block d-lg-none">
                            <div class="row align-items-center">
                                <div class="col-6 col-md-6">
                                    <div class="header-logo">
                                        <a href="index.html">
                                            <img src="jico/images/logo-dark.png" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="mobile-navigation text-right">
                                        <div class="header-icon-wrapper">
                                            <ul class="icon-list justify-content-end">
                                                <li>
                                                    <div class="header-cart-icon">
                                                        <a href="/cart"><i class="lnr lnr-cart"></i><span id="cartCount">{{$countcart}}</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="mobile-menu-icon" id="mobile-menu-trigger"><i class="lnr lnr-menu"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Mobile Menu start-->
                <div class="row">
                    <div class="col-12 d-flex d-lg-none">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
                <!--Mobile Menu end-->

            </div>
        </div>
    </header>
    <!--Header Mobile section end-->

    <!-- Offcanvas Menu Start -->
    <div class="offcanvas-mobile-menu" id="offcanvas-mobile-menu">
        <a href="javascript:void(0)" class="offcanvas-menu-close" id="offcanvas-menu-close-trigger">
            <i class="lnr lnr-cross"></i>
        </a>

        <div class="offcanvas-wrapper">

            <div class="offcanvas-inner-content">
                <div class="offcanvas-mobile-search-area">
                    <form action="#">
                        <input type="search" placeholder="جستجو کردن ...">
                        <button type="submit"><i class="lnr lnr-magnifier"></i></button>
                    </form>
                </div>
                <nav class="offcanvas-navigation">
                    <ul>
                        <li class="menu-item-has-children"><a href="/"> صفحه اصلی</a></li>

                        @php
                            $categories = App\Category::where('parent', '0')->get();
                        @endphp
                        @foreach($categories as $category)
                        <li class="menu-item-has-children"><a href="/shop?cat={{$category->slug}}">{{$category->title}}</a>
                            @php
                                $categories2=App\Category::where('parent',$category->id)->get();
                            @endphp
                            @if(count($categories2))
                            <ul class="submenu2">
                                @foreach($categories2 as $category2)
                                <li class="menu-item-has-children"><a href="/shop?cat={{$category2->slug}}">{{$category2->title}}</a>
                                    <?php  $categories3=App\Category::where('parent',$category2->id)->get();   ?>
                                    @if(count($categories3))
                                    <ul class="submenu2">
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
                        <li class="menu-item-has-children"><a href="/blog"> مقالات</a></li>
                        <li class="menu-item-has-children"><a href="/about">درباره ما</a></li>
                        <li class="menu-item-has-children"><a href="/contact">با ما تماس بگیرید</a></li>

                    </ul>
                </nav>

                <div class="offcanvas-settings">
                    <nav class="offcanvas-navigation">
                        <ul>
                            <li class="menu-item-has-children"><a href="#">حساب من </a>
                                <ul class="submenu2">
                                    @if(Auth::check())
                                        <li><a href="/panel">حساب من</a></li>
                                        <li><a href="/panel/favoritesl">لیست علاقه مندی</a></li>
                                        <li><a href="/logout">خروج</a></li>
                                    @else
                                        <li><a href="/login">ورود</a></li>
                                        <li><a href="/register">ثبت نام</a></li>
                                    @endif
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

                <div class="offcanvas-widget-area">
                    <div class="off-canvas-contact-widget">
                        <div class="header-contact-info">
                            <ul class="header-contact-info-list">
                                <li><i class="ion-android-phone-portrait"></i> <a href="tel://{{$setting['tell']}}">{{$setting['tell']}}</a></li>
                                <li><i class="ion-android-mail"></i> <a href="mailto:{{$setting['tell']}}">{{$setting['email']}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Off Canvas Widget Social Start-->
                    <div class="off-canvas-widget-social">
                        @if($setting['facebook']!="")
                            <a href="{{$setting['facebook']}}"><i class="fa fa-facebook"></i></a>
                        @endif
                        @if($setting['twitter']!="")
                            <a href="{{$setting['twitter']}}"><i class="fa fa-twitter"></i></a>
                        @endif
                        @if($setting['instagram']!="")
                            <a href="{{$setting['instagram']}}"><i class="fa fa-instagram"></i></a>
                        @endif
                        @if($setting['telegram']!="")
                            <a href="{{$setting['telegram']}}"><i class="fa fa-telegram"></i></a>
                        @endif

                    </div>
                    <!--Off Canvas Widget Social End-->
                </div>
            </div>
        </div>

    </div>
    <!-- Offcanvas Menu End -->
    @yield('content')

<!--Footer section start-->
    <footer class="footer-section section ">

        <!--Footer bottom start-->
        <div class="footer-bottom section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-12">
                        <div class="footer-logo text-lg-left text-center">
                            <a href="/"><img src="{{asset($setting['logo'])}}" alt="{{$setting['title']}}"></a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="copyright text-center">
                            <span>2020 طراحی و توسعه توسط شرکت <a style="color: #ffb400;" href="https://imtit.com/">فناوری ریزپردازنده فراهوش</a></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="footer-social">
                            @if($setting['facebook']!="")
                            <a href="{{$setting['facebook']}}"><i class="fa fa-facebook"></i></a>
                            @endif
                                @if($setting['twitter']!="")
                            <a href="{{$setting['twitter']}}"><i class="fa fa-twitter"></i></a>
                                @endif
                                @if($setting['instagram']!="")
                            <a href="{{$setting['instagram']}}"><i class="fa fa-instagram"></i></a>
                                @endif
                                @if($setting['telegram']!="")
                            <a href="{{$setting['telegram']}}"><i class="fa fa-telegram"></i></a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer bottom end-->

    </footer>
    <!--Footer section end-->


</div>

<!-- Placed js at the end of the document so the pages load faster -->

<!-- All jquery file included here -->
<script src="{{asset('jico/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('jico/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('jico/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('jico/js/plugins/plugins.js')}}"></script>
<script src="{{asset('jico/js/main.js')}}"></script>


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
                $('#cart-total').html(data.countcart);
                $('#cartCount').html(data.msg);
                $('.minicart-total').html(data.total);
                $('#p-t').html(data.total+' ت ');
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('.carts_table').append(' <li class="single-cart-item">\n' +
                        '                                        <div class="cart-img">\n' +
                        '                                            <a href="/product/'+value['options']['product_slug']+'"><img src="' + value['options']['image'] + '" alt="' + value['name'] + '"></a>\n' +
                        '                                        </div>\n' +
                        '                                        <div class="cart-content">\n' +
                        '                                            <h5 class="product-name"><a href="/product/'+value['options']['product_slug']+'">' + value['name'] + '</a></h5>\n' +
                        '                                            <span class="product-quantity">' + value['qty'] + ' ×</span>\n' +
                        '                                            <span class="product-price">'+number_3_3(value['price'])+' تومان</span>\n' +
                        '                                        </div>\n' +
                        '                                        <div class="cart-item-remove">\n' +
                        '                                            <a onclick="removecart(this, ' + rowId + ')" title="برداشتن" href="#"><i class="fa fa-trash"></i></a>\n' +
                        '                                        </div>\n' +
                        '                                    </li>');
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
                $(item).parents('.single-cart-item').remove();
                $('#cart-total').html(data.countcart);
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

