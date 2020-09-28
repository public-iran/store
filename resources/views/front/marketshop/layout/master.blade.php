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
<html dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="image/favicon.png" rel="icon" />
    <title>{{@$title}}</title>
    <meta name="keywords" content="{{@$seo_title}}">
    <meta name="description" content="{{@$seo_content}}">
    <!-- CSS Part Start-->
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/js/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/js/bootstrap/css/bootstrap-rtl.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/stylesheet.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/owl.carousel.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/owl.transitions.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/stylesheet-rtl.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/responsive-rtl.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/stylesheet-skin2.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('marketshop/css/style.css')}}" />

    <!-- CSS Part End-->
    @yield('style_link')

    <style>
        #header #cart .dropdown-menu{
            width: 500px;
        }
        #container{
            margin-bottom: 0;
        }
        .result-search{
            width: 303px;
            height: 200px;
            background: #131313;
            margin-top: 36px;
            overflow-y: scroll;
            z-index: 106;
            position: absolute;
            box-shadow: 3px 2px 3px 0px #ccc;
            margin-right: 1px;
            display: none;
            overflow-x: hidden;
        }
    </style>
    @yield('style')

</head>
<body>
<div class="wrapper-wide">
    <div id="header">
        <!-- Top Bar Start-->
        <nav id="top" class="htop">
            <div class="container">
                <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
                    <div class="pull-left flip left-top">
                        <div class="links">
                            <ul>
                                <li class="mobile"><i class="fa fa-phone"></i><?= $setting['tell'] ?></li>
                                <li class="email"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i><?= $setting['email'] ?></a></li>
                            </ul>
                        </div>

                    </div>
                    <div id="top-links" class="nav pull-right flip">
                        <ul>
                            @if(Auth::check())
                                <li><a href="/login"><i class="fa fa-user"></i> ورود به پنل</a></li>
                            @else
                            <li><a href="/login">ورود</a></li>
                            <li><a href="/register">ثبت نام</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Top Bar End-->
        <!-- Header Start-->
        <header class="header-row">
            <div class="container">
                <div class="table-container">
                    <!-- Logo Start -->
                    <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
                        <div id="logo"><a href="/"><img style="max-width: 218px" class="img-responsive" src="<?= asset($setting['logo']) ?>" title="MarketShop" alt="MarketShop" /></a></div>
                    </div>
                    <!-- Logo End -->
                    <!-- Mini Cart Start-->
                    <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div id="cart">
                            <button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle">
                                <span class="cart-icon pull-left flip"></span>
                                <span id="cart-total"><span>{{$countcart}}</span> آیتم </span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <table class="table">
                                        <tr>
                                            <th>تصویر</th>
                                            <th>عنوان</th>
                                            <th>تعداد</th>
                                            <th>قیمت</th>
                                            <th>حذف</th>
                                        </tr>
                                        <tbody class="carts_table">

                                        @foreach($carts as $cart)
                                        <tr>
                                            <td style="width: 60px" class="text-center"><a href="/product/{{$cart->options->product_slug}}"><img class="img-thumbnail" title="{{$cart->name}}" alt="{{$cart->name}}" src="{{$cart->options->image}}"></a></td>
                                            <td style="padding: 1px 10px;" class="text-left"><a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a></td>
                                            <td class="text-right">{{$cart->qty}}</td>
                                            <td style="min-width: 105px;padding: 8px 0;" class="text-right">{{number_format($cart->price)}}  تومان</td>
                                            <td class="text-center"><button onclick="removecart(this, '{{$cart->rowId}}')" class="btn btn-danger btn-xs remove" title="حذف" onClick="" type="button"><i class="fa fa-times"></i></button>
                                            <input type="hidden" data-product-id="{{$cart->id}}" value="{{$cart->qty}}" name="demo3"></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <div>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-right"><strong>مجموع اقلام</strong></td>
                                                <td id="cartCount" class="text-right"><span>{{$countcart}}</span> مورد</td>
                                            </tr>

                                            <tr>
                                                <td class="text-right"><strong>قابل پرداخت</strong></td>
                                                <td id="cartDiscountT" class="text-right"><span>{{$total_price}}</span>  تومان</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="checkout"><a href="/checkout" class="btn btn-primary"><i class="fa fa-share"></i> تسویه حساب</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Mini Cart End-->
                    <!-- جستجو Start-->
                    <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
                        <div id="search" class="input-group">
                            <input id="filter_name" onkeyup="search_header()" type="text" name="search" value="" placeholder="جستجو..." class="form-control input-lg" />
                            <button type="button" class="button-search"><i class="fa fa-search"></i></button>
                            <div class="result-search">

                            </div>
                        </div>
                    </div>
                    <!-- جستجو End-->
                </div>
            </div>
        </header>
        <!-- Header End-->
        <!-- Main آقایانu Start-->

        <nav id="menu" class="navbar">
            <div class="navbar-header"> <span class="visible-xs visible-sm"> منو <b></b></span></div>
            <div class="container">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a class="home_link" title="خانه" href="/">صفحه اصلی</a></li>
                        @php
                            $categories = App\Category::where('parent', '0')->get();
                            @endphp
                            @foreach($categories as $category)
                            <li class="dropdown"><a href="/shop?cat={{$category->slug}}">{{$category->title}}</a>
                                @php
                                    $categories2=App\Category::where('parent',$category->id)->get();
                            @endphp
                            @if(count($categories2))
                            <div class="dropdown-menu">
                                <ul>
                                    @foreach($categories2 as $category2)
                                        @php
                                            $categories3=App\Category::where('parent',$category2->id)->get();
                                        @endphp
                                    <li><a href="/shop?cat={{$category2->slug}}">{{$category2->title}} <span>@if(count($categories3))&rsaquo;@endif</span></a>

                                        @if(count($categories3))
                                        <div class="dropdown-menu">

                                            <ul>
                                                @foreach($categories3 as $category3)
                                                <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}} </a> </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                            @endif
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                            @endif
                        </li>
                        @endforeach
                        <li><a class="home_link" title="مقالات" href="/blog">مقالات</a></li>
                        <li><a class="home_link" title="درباره ما" href="/about">درباره ما</a></li>
                        <li><a class="home_link" title="تماس ما" href="/contact">تماس ما</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main آقایانu End-->
    </div>

    @yield('content')
    <footer id="footer">
        <div class="fpart-first">
            <div class="container">
                <div class="row">
                    <div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h5>درباره {{$setting['title']}}</h5>
                        <p> برای اطلاعات بیشتر در باره فروشگاه به <a href="/about">ادامه</a> مراجعه کنید </p>
                        <img width="300" style="margin-top: 50px" alt="" src="{{asset($setting['logo'])}}">
                    </div>
                    <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <h5>دسترسی سریع</h5>
                        <ul>
                            <li><a href="/">صفحه اصلی</a></li>
                            <li><a href="/shop">فروشگاه</a></li>
                            <li><a href="/blog">مقالات</a></li>
                            <li><a href="/contact">تماس با ما</a></li>
                            <li><a href="/about">درباره ما</a></li>

                        </ul>
                    </div>
                    <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <h5>حساب من</h5>
                        <ul>
                            <li><a href="/panel">حساب کاربری</a></li>
                            <li><a href="/panel/orders">تاریخچه سفارشات</a></li>
                            <li><a href="/panel/favorites">لیست علاقه مندی</a></li>
                            <li><a href="/panel/profile">اطلاعات حساب</a></li>
                        </ul>
                    </div>

                    <div class="column col-lg-4 col-md-4 col-sm-3 col-xs-12">
                        <h5>پربازدیدترین مقالات</h5>
                        @php
                            $posts = App\Post::where('status', 'PUBLISHED')->orderby('view', 'desc')->take(2)->get();
                        @endphp
                        <div class="row">

                            @foreach($posts as $post)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__item">
                                        <div class="blog__item__pic">
                                            <img style="height: 105px" src="{{asset($post->imgPath)}}" alt="">
                                        </div>
                                        <div class="blog__item__text" style="padding-top: 0;">
                                            <ul style="float: right; width: 100%;margin-bottom: 0;">
                                                <li style="font-size: 12px;"><i class="fa fa-calendar-o"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                                            </ul>
                                            <h5><a style="font-size: 13px;" href="/blog/{{$post->slug}}">{{$post->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fpart-second">
            <div class="container">
                <div id="powered" class="clearfix">
                    <div class="powered_text pull-left flip">
                        <p>2020 طراحی و توسعه توسط شرکت <a href="http://imtit.com" target="_blank">فناوری ریزپردازنده فراهوش</a></p>
                    </div>
                    <div class="social pull-right flip">
                        @if($setting['facebook']!="")
                        <a href="{{$setting['facebook']}}" target="_blank"> <img data-toggle="tooltip" src="{{asset('marketshop/image/socialicons/facebook.png')}}" alt="Facebook" title="Facebook"></a>
                        @endif
                            @if($setting['twitter']!="")
                        <a href="{{$setting['twitter']}}" target="_blank"> <img data-toggle="tooltip" src="{{asset('marketshop/image/socialicons/twitter.png')}}" alt="Twitter" title="Twitter"> </a>
                            @endif
                            @if($setting['instagram']!="")

                        <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{asset('marketshop/image/socialicons/instagram.png')}}" alt="instagram" title="instagram"> </a>
                            @endif
                            @if($setting['telegram']!="")
                        <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{asset('marketshop/image/socialicons/telegram.png')}}" alt="telegram" title="telegram"> </a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="back-top"><a data-toggle="tooltip" title="بازگشت به بالا" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
    </footer>

    <!-- Facebook Side Block End -->
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="{{asset('marketshop/js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('marketshop/js/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('marketshop/js/jquery.easing-1.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('marketshop/js/jquery.dcjqaccordion.min.js')}}"></script>
<script type="text/javascript" src="{{asset('marketshop/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('marketshop/js/custom.js')}}"></script>

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
                $('#cartCount span').html(data.countcart);
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
                $(item).parents('tr').remove();
                $('#cart-total span').html(data.countcart);
                $('#cartCount span').html(data.countcart);
                $('#cartDiscountT span').html(data.total);
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
