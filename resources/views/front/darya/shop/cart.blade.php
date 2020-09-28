@extends('front'.theme_name().'layout.master')

@section('content')

    <?php
    $carts = Gloudemans\Shoppingcart\Facades\Cart::content();
    $countcart = Gloudemans\Shoppingcart\Facades\Cart::content()->count();
    $total_price = Gloudemans\Shoppingcart\Facades\Cart::subtotal(00);
    if(!isset($countcart)){
        $countcart = 0;
    }
    if(!isset($total_price)){
        $total_price = 0;
    }
    ?>

    <style>
        .bootstrap-touchspin-up{
            padding:0 20px;
        }
        .bootstrap-touchspin-down{
            padding:0 20px;
        }
        .cart_calculation .cart--subtotal p span, .cart_calculation .cart--total p span {
            margin-left: 6px;
        }
        .cart_calculation .cart--subtotal p span:after, .cart_calculation .cart--total p span:after {
            content: unset;
        }
    </style>
    <!--================================
    START BREADCRUMB AREA
=================================-->
    <section class="breadcrumb-area dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="#">خانه</a>
                            </li>

                            <li class="active" >
                                <a href="#">سبد خرید</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">سبد خرید </h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="cart_area section--padding2 bgcolor dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        @if($countcart!=0)
                        <div class="product_archive added_to__cart">

                        <div class="title_area">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>جزئیات محصول</h4>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="add_info">تعداد </h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>قیمت </h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>حذف</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($carts as $cart)
                                <?php
                                $product = App\Product::findorfail($cart->options->product_id);
                                ?>
                            <div class="col-md-12">
                                <div class="single_product clearfix">
                                    <div class="col-lg-5 col-md-7 v_middle">
                                        <div class="product__description">
                                            <img width="100" class="img-fluid" src="{{$cart->options->image}}" alt="Purchase image">
                                            <div class="short_desc">
                                                <a target="_blank" href="/product/{{$product->slug}}">
                                                    <h4 style="font-size: 14px">{{$cart->name}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- end /.product__description -->
                                    </div>
                                    <!-- end /.col-md-5 -->

                                    <div class="col-lg-3 col-md-2 v_middle">
                                        <div class="product__additional_info">
                                            <ul>
                                                <li>
                                                    <input type="text" data-product-id="{{$cart->id}}" value="{{$cart->qty}}" name="demo3">
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end /.product__additional_info -->
                                    </div>
                                    <!-- end /.col-md-3 -->

                                    <div class="col-lg-4 col-md-3 v_middle">
                                        <div class="product__price_download">
                                            <div class="item_price v_middle">
                                                <span>{{number_format($cart->price)}} تومان</span>
                                            </div>
                                            <div class="item_action v_middle">
                                                <a onclick="removecart(this, '{{$cart->rowId}}')" class="remove_from_cart">
                                                    <span style="cursor: pointer" class="lnr lnr-trash"></span>
                                                </a>
                                            </div>
                                            <!-- end /.item_action -->
                                        </div>
                                        <!-- end /.product__price_download -->
                                    </div>
                                    <!-- end /.col-md-4 -->
                                </div>
                                <!-- end /.single_product -->
                            </div>
                                @endforeach
                        </div>
                        <!-- end /.row -->

                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <div class="cart_calculation text-left">
                                    <div class="cart--subtotal">
                                        <p>
                                            <span>مجموع اقلام : </span>
                                            <span id="cartCount">{{$countcart}}</span> مورد
                                        </p>
                                    </div>
                                    <div class="cart--total">
                                        <p>
                                            <span>مجموع پرداختی : </span><span id="cartDiscountT">{{$total_price}}</span> تومان </p>
                                    </div>

                                    <a href="/checkout" class="btn btn--round btn--md checkout_link">ادامه به پرداخت</a>
                                </div>
                            </div>
                            <!-- end .col-md-12 -->
                        </div>
                        </div>

                    @else
                        <div class="product_archive added_to__cart p-5">

                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-center align-items-center fa-2x text-primary">سبد خرید شما خالیست!</div>
                                </div>
                            </div>
                        </div>
                            @endif
                        <!-- end .row -->
                    <!-- end /.product_archive2 -->
                </div>
                <!-- end .col-md-12 -->
            </div>
            <!-- end .row -->

        </div>
        <!-- end .container -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

    <script !src="">
        $("input[name='demo3']").TouchSpin({
            min: 1,
        });
    </script>


@endsection
