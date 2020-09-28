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
        .item_cart .bcart-quantity {
            padding: 49px 0px;
        }
        .align-center {
            -moz-align-items: center;
            -ms-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            justify-content: space-evenly;
        }
        .item_cart .product-name .product-info {
            max-width: 312px;
        }
        input[type="number"] {
            border: 1px solid #ccc;
            border-radius: 31px;
            padding: 1rem;
            text-align: center;
        }
    </style>
    <div class="container container-240">

        <div class="checkout">
            <ul class="breadcrumb v3">
                <li><a href="/">صفحه نخست</a></li>
                <li class="active">سبد خرید</li>
            </ul>
            <div class="row">
                @if($countcart!=0)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="shopping-cart bd-7">
                            <div class="cmt-title text-center abs">
                                <h1 class="page-title v2">سبد خرید</h1>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">

                                    <tbody>

                                    @foreach($carts as $cart)
                                        <?php
                                        $product = App\Product::findorfail($cart->options->product_id);
                                        ?>

                                        <tr class="item_cart">
                                            <td class="product-name flex align-center">
                                                <a style="cursor: pointer" onclick="removecart(this, '{{$cart->rowId}}')" class="btn-del"><i class="ion-ios-close-empty"></i></a>
                                                <div class="product-img">
                                                    <img src="{{$cart->options->image}}" alt="">
                                                </div>
                                                <div class="product-info">
                                                    <a href="/product/{{$product->slug}}" title="">{{$cart->name}} </a>
                                                </div>
                                            </td>
                                            <td class="bcart-quantity single-product-detail">
                                                <div class="single-product-info">
                                                    <input onclick="qtycart(this)" type="number" min="1" data-product-id="{{$cart->id}}" value="{{$cart->qty}}" id="qtycart">
                                                </div>
                                            </td>
                                            <td class="total-price">
                                                <p class="price">{{number_format($cart->price)}} تومان</p>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="table-cart-bottom">
                                <span>
                                        <p>
                                            <span>مجموع اقلام : </span>
                                            <span id="cartCount">{{$countcart}}</span> مورد
                                        </p>
                                        <p>
                                            <span>مجموع پرداختی : </span><span id="cartDiscountT">{{$total_price}}</span> تومان
                                        </p>

                                </span>
                                <a href="/checkout" class="btn btn-update">ادامه خرید</a>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center align-items-center fa-2x text-primary">سبد خرید شما خالیست!</div>
                    </div>
                @endif

            </div>
        </div>
    </div>


    <script !src="">
        $("input[name='demo3']").TouchSpin({
            min: 1,
        });
    </script>


@endsection
