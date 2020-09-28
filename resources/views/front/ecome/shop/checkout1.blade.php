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

@extends('front'.config('global.theme_name').'layout.master')

@section('content')

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
                            <li class="active">
                                <a href="#">بازبینی سفارش</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">بازبینی سفارش</h1>
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
    <section class="dashboard-area dir-rtl">
        <div class="dashboard_contents">
            <div class="container">
                <form action="/order-verify" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="information_module">
                                <div class="toggle_title">
                                    <h4>اطلاعات صورت حساب </h4>
                                </div>

                                <div class="information__set">
                                    <div class="information_wrapper form--fields">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name">نام
                                                        <sup>*</sup>
                                                    </label>
                                                    <input name="name" type="text" id="first_name" class="text_field" placeholder="" value="@if(old('name')==""){{$user->name}}@else{{old('name')}} @endif">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                 </span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name">نام خانوادگی
                                                        <sup>*</sup>
                                                    </label>
                                                    <input name="family" type="text" id="last_name" class="text_field" placeholder="" value="@if(old('family')==""){{$user->family}}@else{{old('family')}} @endif">
                                                    @if ($errors->has('family'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('family') }}</strong>
                                                 </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end /.row -->

                                        <div class="form-group">
                                            <label for="address1">شماره تلفن </label>
                                            <input name="tell" type="number" class="text_field" placeholder="شماره تلفن " value="@if(old('tell')==""){{$user->tell}}@else{{old('tell')}} @endif">
                                        </div>

                                        <div class="form-group">
                                            <label for="address1">شماره موبایل
                                                <sup>*</sup>
                                            </label>
                                            <input name="mobile" type="number" class="text_field" placeholder="شماره موبایل " value="@if(old('mobile')==""){{$user->mobile}}@else{{old('mobile')}} @endif">
                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                 </span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">استان
                                                        <sup>*</sup>
                                                    </label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="ostan_id" id="ostan" class="text_field">
                                                            <option value="">استان خود را انتخاب کنید </option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if ($errors->has('state'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                 </span>
                                                    @endif
                                                    <input name="state" type="hidden" value="{{$user->ostan}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">شهر
                                                        <sup>*</sup>
                                                    </label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select  id="city" name="city_id" onchange="set_state_name()" class="text_field city">
                                                            <option value="">هیچ کدام </option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if ($errors->has('city'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                 </span>
                                                    @endif
                                                    <input name="city" type="hidden" value="{{$user->city}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="address2">آدرس
                                                <sup>*</sup>
                                            </label>
                                            <input name="address" type="text" id="address2" class="text_field" placeholder="آدرس پستی مقصد" value="@if(old('address')==""){{$user->address}}@else{{old('address')}} @endif">
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                 </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="address2">توضیحات
                                            </label>
                                            <textarea name="description" class="text_field" placeholder="افزودن توضیح برای سفارش"></textarea>
                                                @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                 </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <!-- end /.information__set -->
                            </div>
                            <!-- end /.information_module -->
                        </div>
                        <!-- end /.col-md-6 -->

                        <div class="col-lg-6">
                            <div class="information_module order_summary">
                                <div class="toggle_title">
                                    <h4>خلاصه سفارش</h4>
                                </div>

                                <ul>

                                    @foreach($carts as $cart)
                                    <li class="item">
                                        <a href="/product/{{$cart->options->product_slug}}" target="_blank">{{str_limit($cart->name, 30)}}</a>
                                        <span>{{number_format($cart->price)}} تومان</span>
                                        <span style="padding-left: 1rem">  {{$cart->qty}} × </span>
                                    </li>
                                    @endforeach

                                    <li class="total_ammount">
                                        <p>مجموع</p>
                                        <span>{{$total_price}} تومان </span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.information_module-->

                            <div class="information_module payment_options">
                                <div class="toggle_title">
                                    <h4>روش پرداخت را انتخاب کنید</h4>
                                </div>

                                <ul>
                                    @if(@$setting['pay_home']=='true')
                                    <li>
                                        <div class="custom-radio">
                                            <input type="radio" id="opt1" class="" name="filter_opt">
                                            <label for="opt1">
                                                <span class="circle"></span>پرداخت هنگام تحویل</label>
                                        </div>
                                        <img style="max-width: 60px" class="img-fluid" src="{{asset('images/payhome.png')}}" alt="Visa Cards">
                                    </li>
                                    @endif
                                    <li>
                                        <div class="custom-radio">
                                            <input checked type="radio" id="opt2" class="" name="filter_opt">
                                            <label for="opt2">
                                                <span class="circle"></span>زرین پال</label>
                                        </div>
                                        <img style="max-width: 60px" class="img-fluid" src="{{asset('images/zarinpal.png')}}" alt="Visa Cards">
                                    </li>

{{--                                    <li>--}}
{{--                                        <div class="custom-radio">--}}
{{--                                            <input type="radio" id="opt3" class="" name="filter_opt">--}}
{{--                                            <label for="opt3">--}}
{{--                                                <span class="circle"></span>اعتبار </label>--}}
{{--                                        </div>--}}
{{--                                        <p>موجودی--}}
{{--                                            <span class="bold">180 تومان    </span>--}}
{{--                                        </p>--}}
{{--                                    </li>--}}
                                </ul>
                                <hr>
                                <div class="payment_info modules__content">
{{--                                    <div class="form-group">--}}
{{--                                        <label for="card_number">شماره کارت</label>--}}
{{--                                        <input id="card_number" type="text" class="text_field" placeholder="شماره کارت خود را در اینجا وارد کنید ...--}}
{{-- --}}
{{--">--}}
{{--                                    </div>--}}

                                    <!-- lebel for date selection -->
{{--                                    <label for="name">تاریخ انقضا</label>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6 col-sm-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="select-wrap select-wrap2">--}}
{{--                                                    <select name="months" id="name">--}}
{{--                                                        <option value="">انتخاب کنید ...</option>--}}
{{--                                                        <option value="0">فروردین </option>--}}
{{--                                                        <option value="1">اردیبهشت</option>--}}
{{--                                                        <option value="2">خرداد </option>--}}
{{--                                                        <option value="3">تیر </option>--}}
{{--                                                        <option value="4">مرداد</option>--}}
{{--                                                        <option value="5">شهریور </option>--}}
{{--                                                        <option value="6">مهر </option>--}}
{{--                                                        <option value="7">آبان </option>--}}
{{--                                                        <option value="8">آذر </option>--}}
{{--                                                        <option value="9">دی</option>--}}
{{--                                                        <option value="10">بهمن </option>--}}
{{--                                                        <option value="11">اسفند</option>--}}
{{--                                                    </select>--}}
{{--                                                    <span class="lnr lnr-chevron-down"></span>--}}
{{--                                                </div>--}}
{{--                                                <!-- end /.select-wrap -->--}}
{{--                                            </div>--}}
{{--                                            <!-- end /.form-group -->--}}
{{--                                        </div>--}}
{{--                                        <!-- end /.col-md-6-->--}}

{{--                                        <div class="col-md-6 col-sm-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="select-wrap select-wrap2">--}}
{{--                                                    <select name="years" id="years">--}}
{{--                                                        <option value="">سال</option>--}}
{{--                                                        <option value="28">1398</option>--}}
{{--                                                        <option value="27">1397</option>--}}
{{--                                                        <option value="26">1396</option>--}}
{{--                                                        <option value="25">1395</option>--}}
{{--                                                        <option value="24">1394</option>--}}
{{--                                                        <option value="23">1393</option>--}}
{{--                                                        <option value="22">1392</option>--}}
{{--                                                        <option value="21">1391</option>--}}
{{--                                                        <option value="20">1390</option>--}}
{{--                                                        <option value="19">1389</option>--}}
{{--                                                        <option value="18">1388</option>--}}
{{--                                                        <option value="17">1387</option>--}}
{{--                                                    </select>--}}
{{--                                                    <span class="lnr lnr-chevron-down"></span>--}}
{{--                                                </div>--}}
{{--                                                <!-- end /.select-wrap -->--}}
{{--                                            </div>--}}
{{--                                            <!-- end /.form-group -->--}}
{{--                                        </div>--}}
{{--                                        <!-- end /.col-md-6-->--}}
{{--                                    </div>--}}
                                    <!-- end /.row -->

                                    <div class="row">
                                        <div class="col-md-12 text-center">
{{--                                            <div class="form-group">--}}
{{--                                                <label for="cv_code">کد CVV</label>--}}
{{--                                                <input id="cv_code" type="text" class="text_field" placeholder="کد را وارد کنید ...">--}}
{{--                                            </div>--}}

                                            <button type="submit" class="btn btn--round btn--default">تأیید سفارش</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end /.information_module-->
                        </div>
                        <!-- end /.col-md-6 -->
                    </div>
                    <!-- end /.row -->
                </form>
                <!-- end /form -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
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
