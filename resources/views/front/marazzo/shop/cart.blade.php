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
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive-rtl.css')}}" />
@endsection
@section('style')
@endsection

@section('content')
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li class='active'>سبد خرید</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="cart-romove item">حذف</th>
                                    <th class="cart-description item">تصویر</th>
                                    <th class="cart-product-name item">نام محصول</th>
                                    <th class="cart-qty item">تعداد</th>
                                    <th class="cart-sub-total item">زیرمجموع</th>
                                    <th class="cart-total last-item">جمع کل</th>
                                </tr>
                                </thead>
                                <!-- /thead -->

                                <tbody>
                                @foreach($carts as $cart)
                                <tr>
                                    <td class="romove-item"><a  onclick="deletecart(this, '{{$cart->rowId}}')" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="cart-image">
                                        <a class="entry-thumbnail" href="/product/{{$cart->options->product_slug}}">
                                            <img src="{{asset($cart->options->image)}}" alt="{{$cart->name}}">
                                        </a>
                                    </td>
                                    <td class="cart-product-name-info">
                                        <h4 class='cart-product-description'><a href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a></h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="reviews">
                                                    ({{$cart->options->product_view}} دیدگاه)
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                       {{-- <div class="cart-product-info">
                                            <span class="product-color">رنگ:<span>آبی</span></span>
                                        </div>--}}
                                    </td>
                                    <td class="cart-product-quantity">
                                        <div class="quant-input">
                                            <div class="arrows">
                                                <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                            </div>
                                            <input type="text" value="{{$cart->qty}}">
                                        </div>
                                    </td>
                                    <td class="cart-product-sub-total"><span class="cart-sub-total-price">{{number_format($cart->price)}} تومان</span></td>
                                    <td class="cart-product-grand-total"><span class="cart-grand-total-price">{{number_format($cart->price*$cart->qty)}} تومان</span></td>
                                </tr>
                                @endforeach
                                </tbody>
                                <!-- /tbody -->

                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="shopping-cart-btn">
												<span class="">
								<a href="/checkout" class="btn btn-upper btn-primary pull-left  outer-left-xs">ادامه خرید</a>
							</span>
                                        </div>
                                        <!-- /.shopping-cart-btn -->
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <!-- /table -->
                        </div>
                    </div>

                </div>
                <!-- /.shopping-cart -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->
@endsection
@section('script')
    <script>
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
