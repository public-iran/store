@php

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
@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('css/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/shop.css')}}" />
@endsection
@section('style')
@endsection

@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>سبد خرید</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>سبد خرید</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!--Cart section start-->
    <div class="cart-section section sb-border pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-70 pb-lg-50 pb-md-40 pb-sm-30 pb-xs-20">
        <div class="container">
            <div class="row">
                @if(count($carts))
                <div class="col-12">
                    <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-30">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">تصویر</th>
                                <th class="pro-title">تولید - محصول</th>
                                <th class="pro-price">قیمت</th>
                                <th class="pro-quantity">تعداد</th>
                                <th class="pro-subtotal">جمع</th>
                                <th class="pro-remove">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td class="pro-thumbnail"><a href="/product/{{$cart->options->product_slug}}"><img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}"></a></td>
                                <td class="pro-title"><a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a></td>
                                <td class="pro-price"><span><span class="price">{{number_format($cart->price)}}</span>  تومان</span></td>
                                <td class="pro-quantity">
                                    <div class=""><input name="demo3" data-product-id="{{$cart->id}}" type="number" value="{{$cart->qty}}"></div>
                                </td>
                                <td class="pro-subtotal"><span><span class="cartprice">{{number_format($cart->price*$cart->qty)}}</span> تومان</span></td>
                                <td class="pro-remove"><a onclick="deletecart(this, '{{$cart->rowId}}')"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">


                        <!-- Cart Summary -->
                        <div class="col-lg-6 col-12 mb-30 d-flex">
                            <div class="cart-summary" style="margin-right: 0">
                                <div class="cart-summary-wrap">
                                    <h4>خلاصه سبد خرید</h4>
                                    <p> مجموع <span>{{$countcart}}</span></p>
                                    @if($total_price>$setting['send_price_top'])
                                    <p>هزینه حمل و نقل <span>رایگان</span></p>
                                        <h2> جمع کل<span>تومان</span><span id="cartDiscountT">{{$total_price}}</span></h2>
                                    @else
                                        <p>هزینه حمل و نقل <span>{{number_format($setting['send_price'])}}</span>تومان</p>
                                        <h2> جمع کل<span>تومان</span><span id="cartDiscountT">{{$total_price+$setting['send_price']}}</span></h2>
                                    @endif

                                </div>
                                <div class="cart-summary-button">
                                    <a href="/checkout" class="ht-btn black-btn">پرداخت</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                @else
                    <h5 class="title">سبد خرید خالی می باشد</h5>
                @endif
            </div>
        </div>
    </div>
    <!--Cart section end-->




@endsection
@section('script_link')
    <script src="{{asset('js/jquery.bootstrap-touchspin.js')}}"></script>
@endsection
@section('script')
    <script>
        $('.humberger__menu__overlay').click(function () {
            document.getElementById("mySidenav").style.width = "0";
        })
        $("input[name='demo3']").TouchSpin({
            min: 1,
        });
        function deletecart(item, id) {
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
                    $(item).parents('.table tr').remove();
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
    </script>
@endsection
