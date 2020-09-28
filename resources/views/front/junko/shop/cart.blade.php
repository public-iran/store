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

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">خانه</a></li>
                            <li>سبد خرید</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-60">
        <div class="container">
            @if(count($carts))
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">حذف</th>
                                        <th class="product_thumb">تصویر</th>
                                        <th class="product_name">محصول</th>
                                        <th class="product-price">قیمت</th>
                                        <th class="product_quantity">تعداد</th>
                                        <th class="product_total">جمع کل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                    <tr>
                                        <td class="product_remove"><a onclick="deletecart(this, '{{$cart->rowId}}')"><i class="fa fa-trash-o"></i></a></td>
                                        <td class="product_thumb">
                                            <a href="/product/{{$cart->options->product_slug}}"><img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}"></a>
                                        </td>
                                        <td class="product_name"><a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a></td>
                                        <td class="product-price price">{{number_format($cart->price)}} <span>تومان</span></td>
                                        <td class="product_quantity">
                                            <label>تعداد</label>
                                            <input style="border: none" type="text" data-product-id="{{$cart->id}}" value="{{$cart->qty}}"
                                                   name="demo3">
                                        </td>
                                        <td class="product_total"><span  class="cartprice">{{number_format($cart->price*$cart->qty)}}</span> تومان</td>


                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>مجموع سبد</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>جمع اجزا</p>
                                        <p class="cart_amount">{{count($carts)}}</p>
                                    </div>
                                    @if($total_price>$setting['send_price_top'])
                                    <div class="cart_subtotal ">
                                        <p>حمل و نقل</p>
                                        <p class="cart_amount"><span style="margin-left: 0">رایگان</span> </p>
                                    </div>
                                    <div class="cart_subtotal has-border">
                                        <p>جمع کل</p>
                                        <p class="cart_amount"><span id="cartDiscountT" style="margin-left: 0">{{$total_price}}</span> تومان</p>
                                    </div>
                                    @else
                                        <div class="cart_subtotal ">
                                            <p>حمل و نقل</p>
                                            <p class="cart_amount"><span style="margin-left: 0">{{$total_price}}</span> تومان</p>
                                        </div>
                                        <div class="cart_subtotal has-border">
                                            <p>جمع کل</p>
                                            <p class="cart_amount"><span id="cartDiscountT" style="margin-left: 0">{{$total_price}}</span> تومان</p>
                                        </div>
                                    @endif
                                    <div class="checkout_btn">
                                        <a href="/checkout">برسی و پرداخت</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            @else
                <h5 class="title">سبد خرید خالی می باشد</h5>
            @endif
        </div>
    </div>
    <!--shopping cart area end -->



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
                    $(item).parents('table tr').remove();
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
