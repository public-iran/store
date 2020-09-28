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

@endsection
@section('style')
    <style>
        .checkout__form{
            text-align: right;
        }
        .checkout h6{
            margin-bottom: 0;
            border: none;
        }
        .card{
            background: none;
            border: none;
        }
        .form-control{
            display: block!important;
        }
        div.nice-select{
            display: none!important;
        }
        .invalid-feedback{
            display: block;
            font-size: 11px;
        }
    </style>
@endsection


@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            @if($countcart!=0)
            <div class="checkout__form">
                <h4>جزئیات سبد خرید</h4>
                <form action="/order-verify" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>نام <span>*</span></p>
                                        <input type="text" name="name" value="@if(old('name')==""){{$user->name}}@else{{old('name')}} @endif">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>نام خانوادگی <span>*</span></p>
                                        <input type="text" name="family" value="@if(old('family')==""){{$user->family}}@else{{old('family')}} @endif">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>شماره موبایل <span>*</span></p>
                                        <input type="text" name="mobile" value="@if(old('mobile')==""){{$user->mobile}}@else{{old('mobile')}} @endif">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>کد پستی</p>
                                        <input type="text" name="postal_code" value="@if(old('postal_code')==""){{$user->postal_code}}@else{{old('postal_code')}} @endif">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="ostan_id" class="col-sm-3 control-label">استان</label>
                                    <div class="col-sm-9">
                                        <select id="ostan" name="ostan_id" class="selectpicker state ostan form-control show-tick" data-live-search="true">
                                            <option>استان را انتخاب کنید</option>
                                        </select>
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                    <input name="state" type="hidden" value="{{$user->ostan}}">
                                </div>

                                <div class="col-lg-6">
                                    <label for="city_id" class="col-sm-3 control-label">شهر</label>
                                    <div class="col-sm-9">
                                        <select  id="city" name="city_id" onchange="set_state_name()"
                                                 class="selectpicker form-control show-tick city">
                                            <option>ابتدا استان را انتخاب کنید</option>
                                        </select>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                    <input name="city" type="hidden" value="{{$user->city}}">
                                </div>

                            </div>
                            <div class="checkout__input" style="margin-top: 20px">
                                <p>آدرس<span>*</span></p>
                                <input type="text" placeholder="آدرس پستی مقصد" class="checkout__input__add"  name="address" value="@if(old('address')==""){{$user->address}}@else{{old('address')}} @endif">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>سفارش شما</h4>
                                <div class="checkout__order__products">مجموع <span></span></div>
                                <?php $tp=[] ?>
                                @foreach($carts as $cart)
                                    <div class="col-12" style="margin-bottom: 10px">
                                        <div class="card" style="box-shadow: 0px 3px 3px -2px #bbbbbbb8;">
                                            <div class="card-body" style="padding: 0px 2px 12px 14px;">


                                                <div class="row">
                                                    <div class="col-3" style="padding-right: 0;padding-left: 0">
                                                        <img width="100%" src="{{$cart->options->image}}" alt="">
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6 style="font-size: 10px;text-align: right; line-height: 2;">{{$cart->name}}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-12" style="padding:0;text-align: left">
                                                                <span style="font-size: 13px;color: #00ad9c">{{number_format($cart->price)}} تومان</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $tp[]=$cart->price;
                                    @endphp
                                @endforeach
                                <div class="checkout__order__total">مجموع <span>{{$total_price}} تومان </span></div>
                                @if(array_sum($tp)<=200000000)
                                <input id="pay_home" type="checkbox" class="pay_home" name="pay_home">
                                <label for="pay_home" style="font-size: 13px">پرداخت درب محل</label>
                                <button type="submit" id="pay_home_price" class="site-btn" style="display: none">ثبت سفارش</button>
                                @endif
                                <button type="submit" id="pay_price" class="site-btn">ثبت سفارش و پرداخت</button>


                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @else
                <div class="checkout__form">
                    <h4>سبد خرید شما خالی می باشد!</h4>
                </div>
            @endif
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection



@section('script_link')
    <script src="{{asset(('js/frotel/ostan.js'))}}"></script>
    <script src="{{asset('js/frotel/city.js')}}"></script>
@endsection
@section('script')
    <script>
        $('#pay_home').click(function(){
            if(this.checked){
               $('#pay_price').hide();
               $('#pay_home_price').show();
            }else{
                $('#pay_price').show();
                $('#pay_home_price').hide()
            }

        });
    </script>

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
