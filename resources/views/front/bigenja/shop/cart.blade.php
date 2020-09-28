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
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">سبد خرید فروشگاه</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">خانه</a></li>
                                <li>سبد خرید</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <div class="cart-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-content-inner"><!-- cart content inner -->
                        @if(count($carts))
                        <div class="top-content"><!-- top content -->
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>محصول</th>
                                    <th>قیمت</th>
                                    <th style="min-width: 140px">تعداد</th>
                                    <th>مجموع</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                <tr>
                                    <td style="max-width: 400px">
                                        <div class="product-details"><!-- product details -->
                                            <div onclick="deletecart(this, '{{$cart->rowId}}')" class="close-btn cart-remove-item">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div class="thumb">
                                                <img style="max-width: 160px" src="{{asset($cart->options->image)}}" alt="{{$cart->name}}">
                                            </div>
                                            <div class="content" style="max-width: 98%;display: inline-block;">
                                                <h4 class="title" style="padding-top: 50px;"><a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a></h4>
                                            </div>
                                        </div><!-- //. product detials -->
                                    </td>
                                    <td>
                                        <div class="price">{{number_format($cart->price)}} <span>تومان</span></div>
                                    </td>
                                    <td>
                                        <div class="col-6" style="padding:0 5px 0 5px;margin-top: 10%;">
                                            <input type="text" data-product-id="{{$cart->id}}" value="{{$cart->qty}}"
                                                   name="demo3">
                                        </div>

                                    </td>
                                    <td>
                                        <div class="price"><span  class="cartprice">{{number_format($cart->price*$cart->qty)}}</span> تومان</div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- //. top content -->
                        <div class="bottom-content"><!-- bottom content -->

                            <div class="right-content-area">
                                <div class="btn-wrapper">
                                    <a href="/checkout" type="button" class="boxed-btn"> پردازش شده برای پرداخت </a>
                                </div>
                            </div>

                        </div><!-- //. bottom content -->
                        @else
                            <h5 class="title">سبد خرید خالی می باشد</h5>
                        @endif
                    </div><!-- //. cart content inner -->
                </div>
            </div>
        </div>
    </div>


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
