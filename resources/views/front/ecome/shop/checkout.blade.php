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

@section('content')

    <style>
        select#ostan {
            height: 54px;
            border-radius: 999px;
            border: 1px solid #e1e1e1;
            padding-right: 33px;
            margin-bottom: 15px;
        }
        select#city {
            height: 54px;
            border-radius: 999px;
            border: 1px solid #e1e1e1;
            padding-right: 33px;
            margin-bottom: 15px;
        }
    </style>
    <div class="main-content space1">
        <div class="container container-240">
            <ul class="breadcrumb">
                <li><a href="/">صفحه نخست</a></li>
                <li class="active">سبد خرید</li>
            </ul>
            <form name="checkout" method="post" class="co">
                <div class="cart-box-container-ver2">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="co-left bd-7">
                                <div class="cmt-title text-center abs">
                                    <h1 class="page-title v1">جزئیات حساب کاربری</h1>
                                </div>
                                <div class="row form-customer">
                                    <div class="form-group col-md-6">
                                        <label for="inputfname_2" class=" control-label">نام <span class="f-red">*</span></label>
                                        <input type="text" id="inputfname_2" class="form-control form-account" name="name" value="@if(old('name')==""){{$user->name}}@else{{old('name')}} @endif">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                 </span>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputlname" class=" control-label">نام خانوادگی <span class="f-red">*</span></label>
                                        <input type="text" id="inputlname" class="form-control form-account" name="family" value="@if(old('family')==""){{$user->family}}@else{{old('family')}} @endif">
                                        @if ($errors->has('family'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('family') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ostan" class=" control-label">استان <span class="f-red">*</span></label>
                                        <select name="ostan_id" id="ostan" class="form-control form-account">
                                            <option value="">استان خود را انتخاب کنید </option>
                                        </select>
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                 </span>
                                        @endif
                                        <input name="state" type="hidden" value="{{$user->ostan}}">

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="city" class="control-label">شهر <span class="f-red">*</span></label>
                                        <select id="city" name="city_id" onchange="set_state_name()"  class="form-control form-account city">
                                            <option value="">هیچ کدام </option>
                                        </select>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                 </span>
                                        @endif
                                        <input name="city" type="hidden" value="{{$user->city}}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputphone" class=" control-label">شماره تماس </label>
                                        <input type="text" id="inputphone" class="form-control form-account" name="mobile" value="@if(old('mobile')==""){{$user->mobile}}@else{{old('mobile')}} @endif">
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                 </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-12">
                                            <label for="inputfState" class=" control-label">آدرس</label>
                                            <textarea name="address" rows="8" id="message" class="form-control form-note" placeholder="آدرس پستی مقصد">@if(old('address')==""){{$user->address}}@else{{old('address')}} @endif</textarea>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="co-left bd-7">
                                <div class="cmt-title text-center abs">
                                    <h1 class="page-title v5">توضیحات شما</h1>
                                </div>
                                <div class="row form-customer v2">
                                    <div class="form-group col-md-12">
                                        <label for="inputfState" class=" control-label">توضیحات سفارش</label>
                                        <textarea name="description" rows="8" id="message" class="form-control form-note" placeholder="افزودن توضیح برای سفارش"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End contact-form -->
                        <div class="col-md-4">
                            <div class="cart-total bd-7">
                                <div class="cmt-title text-center abs">
                                    <h1 class="page-title v3">سفارشات شما</h1>
                                </div>
                                <div class="table-responsive">
                                    <div class="co-pd">
                                        <p class="co-title">
                                            نام محصول<span>قیمت</span>
                                        </p>
                                        <ul class="co-pd-list">
                                            <li class="clearfix">
                                                <div class="co-name">
                                                    هدفون بی سیم بیتس
                                                </div>
                                                <div class="co-price">
                                                    99 هزار تومان
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <table class="shop_table">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>جمع کل</th>
                                            <td>99 هزار تومان</td>
                                        </tr>
                                        <tr class="cart-shipping v2">
                                            <th>هزینه ارسال</th>
                                            <td class="td">
                                                <ul class="shipping">
                                                    <li>
                                                        <input type="radio" name="gender" value="Flat" id="radio1" checked="checked">
                                                        <label for="radio1">پست پیشتاز: 12 هزار تومان</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="gender" value="Free" id="radio2">
                                                        <label for="radio2">ارسال رایگان</label>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="order-total v2">
                                            <th>مجموع</th>
                                            <td>99 هزار تومان</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="payment">
                                    <li>
                                        <input type="radio" name="gender" value="Direct" id="radio3">
                                        <label for="radio3">انتقال مستقیم بانکی</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="gender" value="Check" id="radio4">
                                        <label for="radio4">پرداخت آنلاین</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="gender" value="Cash" id="radio5">
                                        <label for="radio5">پرداخت پس از تحویل</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="gender" value="Paypal" id="radio6">
                                        <label for="radio6">واسطه پی پال <a class="co-pp" href=""><img src="img/payment/pp.jpg" alt=""></a></label>

                                    </li>
                                </ul>

                                <div class="form-check">
                                    <label class="form-check-label ver2">
                                        <input type="checkbox" class="form-check-input">
                                        <span>تمامی <a href="#" class="term">قوانین و مقررات *</a> را خوانده و قبول دارم</span>
                                    </label>
                                </div>
                                <div class="cart-total-bottom v2">
                                    <a href="#" class="btn-gradient btn-checkout btn-co-order">ثبت سفارشات</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



@section('script')

    <script src="{{asset('js/frotel/ostan.js')}}"></script>
    <script src="{{asset('js/frotel/city.js')}}"></script>

    <script>

        loadOstan('ostan');
        $("#ostan").change(function () {
            var i = $(this).find('option:selected').val();
            ldMenu(i, 'city');
            $('.selectpicker').selectpicker('refresh');
        });

        function set_state_name() {
            var ostan_name = $('#ostan option:selected').text();
            var city_name = $('#city option:selected').text();
            $('input[name=city]').val(city_name);
            $('input[name=state]').val(ostan_name);
        }

        $('#ostan option').each(function (index) {

            var value_ostan = $(this).val();
            var state = '{{$user->ostan_id}}';
            if (value_ostan == state) {
                $(this).attr('selected', 'selected');
                ldMenu(value_ostan, 'city');

            }


        });

        $('.city option').each(function (index) {
            var city = '{{$user->city_id}}';
            var city_value = $(this).val();
            if (city_value == city) {
                $(this).attr('selected', 'selected');
                $('.selectpicker').selectpicker('refresh');
            }
        });

    </script>

@endsection

@endsection
