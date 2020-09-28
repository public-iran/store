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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{@$seo_content}}">
    <meta name="author" content="">
    <meta name="keywords" content="{{@$seo_title}}">
    <title>{{@$title}} </title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('bigenja/css/bootstrap.min.css')}}">
    <!-- icofont -->
    <link rel="stylesheet" href="{{asset('bigenja/css/fontawesome.min.css')}}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{asset('bigenja/css/animate.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('bigenja/css/owl.carousel.min.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('bigenja/css/magnific-popup.css')}}">

    <!-- select 2  -->
    <link rel="stylesheet" href="{{asset('bigenja/css/select2.min.css')}}">
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{asset('bigenja/css/style.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('bigenja/css/responsive.css')}}">
    @yield('style_link')
    @yield('style')
    <style>
        .invalid-feedback{
            display: block;
        }
        .cart-sidebar-area .bottom-content .cart-products .single-product-item .content{
            padding-right: 90px;
        }
        .social li{
            float: right;
            margin-left: 11px !important;
        }
        .social li a {
            font-size: 16px;
            display: inline-block!important;
            text-align: center;
            padding: 0;
            background: #3C5B9B !important;
            color: #fff;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 4px;
        }
        .social li a i{
            margin-top: 11px;
        }

    </style>
</head>

<body>

<!-- top add area start -->
{{--<div class="top-add-area">
    <a href="#"><img src="bigenja/img/top-bar-add.jpg" alt="top bar add image"></a>
</div>--}}
<!-- top add area end -->

<!-- support bar area start -->
<div class="support-bar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="left-content-area"><!-- left content area -->
                    <div class="language-picker">
                        <div class="default">
                            <div class="slang-wrap">
                                <a href="/login" class="name">ورود</a>
                            </div>

                        </div>
                    </div>
                    <div class="currency-picker">
                        <div class="default">
                            <div class="slang-wrap">
                                <a href="/register" class="name">ثبت نام</a>
                            </div>

                        </div>
                    </div>

                </div><!-- //.left content area -->
                <div class="right-content-area"><!-- right content area -->
                    <ul>
                        <li>
                            سفارش قبل از 17:30، امروزه حمل می شود
                        </li>
                        <li>
                            <i class="fas fa-truck"></i>  حمل رایگان
                        </li>
                        <li>
                            <i class="fas fa-clock"></i> 24/7 پشتیبانی آنلاین
                        </li>
                    </ul>
                </div><!-- //. right content area -->
            </div>
        </div>
    </div>
</div>
<!-- support bar area end -->

<!-- navbar area start -->
<nav class="navbar navbar-area navbar-expand-lg navbar-light ">
    <div class="container nav-container">
        <div class="logo-wrapper navbar-brand">
            <a href="/" class="logo main-logo">
                <img style="width: 115px" src="{{asset($setting['logo'])}}" alt="logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="mirex">
            <!-- navbar collapse start -->
            <ul class="navbar-nav">
                <!-- navbar- nav -->
                <li class="nav-item active dropdown">
                    <a class="nav-link pl-0" href="/">خانه
                    </a>
                </li>

                @php
                    $categories = App\Category::where('parent', '0')->get();
                @endphp
                @foreach($categories as $category)

                <li class="nav-item dropdown mega-menu"><!-- mega menu start -->
                    <a class="nav-link dropdown-toggle" href="/shop?cat={{$category->slug}}" data-toggle="dropdown">{{$category->title}}</a>
                    @php
                        $categories2=App\Category::where('parent',$category->id)->get();
                    @endphp
                    @if(count($categories2))
                    <div class="mega-menu-wrapper">
                        <div class="container mega-menu-container">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12">

                                    <?php
                                    $i=1;
                                    foreach($categories2 as $category2){
                                        if ($i % 5 == 0) {

                                            $categories3=App\Category::where('parent',$category2->id)->get();
                                            ?>

                                </div>
                                    <div class="col-lg-3 col-sm-12">
                                    <?php } ?>
                                        <div class="mega-menu-columns">
                                            <h6 class="title"><a href="/shop?cat={{$category2->slug}}" style="padding: 0">{{$category2->title}}</a></h6>
                                        <?php  $categories3=App\Category::where('parent',$category2->id)->get();

                                                                ?>
                                            <ul class="menga-menu-page-links">
                                                <?php foreach($categories3 as $category3){?>
                                                <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}}</a></li>
                                                    <?php } ?>
                                                    <?php $i++; } ?>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </li><!-- mega menu start -->
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="/blog">مقالات</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about">درباره ما</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact"> تماس باما</a>
                </li>

            </ul>
            <!-- /.navbar-nav -->
        </div>

        <!-- /.navbar btn wrapper -->
        <div class="responsive-mobile-menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mirex" aria-controls="mirex"
                    aria-expanded="false" aria-label="تغییر ناوبری">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="right-btn-wrapper">
            <ul>
                <li class="search" id="search"><i class="fas fa-search"></i> </li>
                <li class="cart" id="cart"><i class="fas fa-shopping-basket"></i>
                    <span class="badge" id="cart-total">{{$countcart}}</span>
                </li>
            </ul>
        </div>
        <!-- navbar collapse end -->
    </div>
</nav>
<!-- navbar area end -->

@yield('content')

<!-- footer area one start -->
<footer class="footer-arae-one">
    <div class="footer-top-one blue-bg"><!-- footer top one-->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about">
                        <div class="widget-body">
                            <a href="/" class="footer-logo">
                                <img style="max-width: 120pxح" src="{{asset($setting['logo'])}}" alt="{{$setting['title']}}">
                            </a>
                            <ul class="contact-info-list">
                                <li>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="content">
                                            <span class="details">{{$setting['address']}}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="content">
                                            <span class="details">{{$setting['email']}}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="content">
                                            <span class="details">{{$setting['tell']}}</span><br>
                                            <span class="details">{{$setting['mobile']}}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h4 class="title">خدمات مشتریان</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="page-list">
                                <li class="first"><a href="/panel" title="">حساب من</a></li>
                                <li><a href="/panel/orders" title="">تاریخچه سفارشات</a></li>
                                <li><a href="/panel/favorites" title="">علاقه مندیها</a></li>
                                <li><a href="/panel/profile" title="">اطلاعات حساب</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h4 class="title">دسترسی سریع</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="page-list">
                                <li class="first"><a title="Your Account" href="/">صفحه اصلی</a></li>
                                <li><a title="Information" href="/shop">فروشگاه</a></li>
                                <li><a title="Addresses" href="/blog">مقالات</a></li>
                                <li><a title="Addresses" href="/about">درباره ما</a></li>
                                <li class="last"><a title="Orders History" href="/contact">تماس با ما</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h4 class="title">امروز به ما بپیوندید</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="page-list social">
                                @if($setting['twitter']!="")
                                    <li class="twitter">
                                        <a href="{{$setting['twitter']}}" data-toggle="tooltip" target="_blank" title="توییتر">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($setting['facebook']!="")
                                    <li class="facebook">
                                        <a href="{{$setting['facebook']}}" data-toggle="tooltip" target="_blank" title="فیسبوک">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($setting['instagram']!="")
                                    <li class="instagram">
                                        <a href="{{$setting['instagram']}}" data-toggle="tooltip" target="_blank" title="اینستاگرام">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($setting['telegram']!="")
                                    <li class="telegram">
                                        <a href="{{$setting['telegram']}}" data-toggle="tooltip" target="_blank" title="اینستاگرام">
                                            <i class="fab fa-telegram-plane"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- //.footer top one -->
    <div class="copyright-area blue-bg"><!-- copyright area -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-inner"><!-- copyright inner -->
                        <div class="left-content-area">
                            <span>2020 طراحی و توسعه توسط شرکت <a style="color: #fff" href="https://imtit.com/">فناوری ریزپردازنده فراهوش</a></span>                        </div>
                    </div><!-- //. copyright inner -->
                </div>
            </div>
        </div>
    </div><!-- //. copyright area -->
</footer>
<!-- footer area one end -->

<!-- back to top start -->
<div class="back-to-top">
    <i class="fas fa-rocket"></i>
</div>
<!-- back to top end -->

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->


<!-- header area end -->
<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <form action="#" class="search-popup-form">
        <div class="form-element">
            <input type="text"  class="input-field" placeholder="جستجو.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fas fa-search"></i></button>
    </form>
</div>
<!-- slide sidebar area start -->

<!-- slide sidebar area end -->
<!-- cart sidebar area start -->
<div class="cart-sidebar-area" id="cart-sidebar-area">
    <div class="top-content"><!-- top content -->
        <a href="/" class="logo">
            <img style="max-width: 120px" src="{{asset($setting['logo'])}}" alt="logo">
        </a>
        <span class="side-sidebar-close-btn" ><i class="fas fa-times"></i></span>
    </div><!-- //. top content -->
    <div class="bottom-content"><!-- bottom content -->
        <div class="cart-products"><!-- cart product -->
            <h4 class="title">سبد خرید</h4>
            <div style="max-height: 395px;overflow-y: auto;overflow-x: hidden;width: 110%;" class="carts_table">
                @foreach($carts as $cart)
                    <div class="single-product-item"><!-- single product item -->
                        <div class="thumb">
                            <img style="max-width: 80px" src="{{asset($cart->options->image)}}" alt="{{$cart->name}}">
                        </div>
                        <div class="content" style="max-width: 280px">
                            <h4 class="title" style="width: 110%">{{$cart->name}}</h4>
                            <div class="price"><span class="pprice">{{number_format($cart->price)}}</span>
                                <a style="margin-right: 10px" onclick="removecart(this, '{{$cart->rowId}}')" class="remove-cart">حذف</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="btn-wrapper">
                <a href="/cart" class="boxed-btn">بررسی و پرداخت</a>
            </div>
        </div> <!-- //. cart product -->
    </div><!-- //. bottom content -->
</div>
<!-- cart sidebar area end -->

<!-- jquery -->
<script src="{{asset('bigenja/js/jquery.js')}}"></script>
<!-- popper -->
<script src="{{asset('bigenja/js/popper.min.js')}}"></script>
<!-- bootstrap -->
<script src="{{asset('bigenja/js/bootstrap.min.js')}}"></script>
<!-- way poin js-->
<script src="{{asset('bigenja/js/waypoints.min.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('bigenja/js/owl.carousel.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('bigenja/js/jquery.magnific-popup.js')}}"></script>
<!-- wow js-->
<script src="{{asset('bigenja/js/wow.min.js')}}"></script>
<!-- counterup js-->
<script src="{{asset('bigenja/js/jquery.counterup.min.js')}}"></script>

<script src="{{asset('bigenja/js/countdown.js')}}"></script>
<!-- select 2 -->
<script src="{{asset('bigenja/js/select2.min.js')}}"></script>
<!-- main -->
<script src="{{asset('bigenja/js/main.js')}}"></script>
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
                $('.minicart-total span').html(data.total);
                $('#p-t').html(data.total+' ت ');
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('.carts_table').append('<div class="single-product-item"><!-- single product item -->\n' +
                        '                        <div class="thumb">\n' +
                        '                            <img style="max-width: 80px" src="' + value['options']['image'] + '" alt="' + value['name'] + '">\n' +
                        '                        </div>\n' +
                        '                        <div class="content" style="max-width: 280px">\n' +
                        '                            <h4 class="title" style="width: 110%"><a style="color: #fff" href="/product/'+value['options']['product_slug']+'">' + value['name'] + ' </a></h4>\n' +
                        '                            <div class="price"><span class="pprice">'+number_3_3(value['price'])+'</span>\n' +
                        '                                <a style="margin-right: 10px" onclick="removecart(this, ' + rowId + ')" class="remove-cart">حذف</a>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                    </div>' +
                        ' ');
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
                $(item).parents('.minicart-product-list li').remove();
                $('#cart-total').html(data.countcart);
                $('#cartCount').html(data.countcart);
                $('.minicart-total span').html(data.total);
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
