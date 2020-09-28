
@extends('front'.theme_name().'layout.master')
@section('style')
    <style>
        .product {
            padding-top: 30px;
            padding-bottom: 80px;
        }
        .owl-stage-outer{
            max-height: 400px;
        }
        .blog__item__text{
            text-align: right;
        }
        .blog__item__pic img{
            height: 250px;
        }
        .sidebar{
            text-align: right;
        }
        .latest-product__item__text span{
            display: block;
        }
        .product__item__pic,.product__discount__item__pic{
            height: 200px;
        }

        .nav-link[data-toggle].collapsed:before {
            content: " ▾";
        }
        .nav-link[data-toggle]:not(.collapsed):before {
            content: " ▴";
        }
        .list-unstyled{

            padding-right: 10px!important;
            overflow-y: auto;
        }
        .hero__categories > ul{
            height: 453px;

        }
        @media (max-width: 991px){
            .hero__categories > ul{
                height: 220px;
            }
        }

        [type="checkbox"] + label {
            height: 25px;
            line-height: 21px;
            font-size: 13px;
            font-weight: normal;
            min-width: 150px;
            position: relative;
            padding-right: 7px;
            padding-left: 0;
            cursor: pointer;
            display: inline-block;
        }
        .sidebar__item__color {
            float: right;
            width: 100%;
            display: flex;
            padding-right: 15px;
        }
        .sidebar__item__color label:after{
            display: none;
        }
        input[type=checkbox], input[type=radio]{
            cursor: pointer;
        }
        .sidebar__item h4{
            font-size: 19px;
        }
        .filter__item .row{
            text-align: right;
        }
        .ptn-price{
            text-align: center;
            padding: 2px 6px;
            margin: 5px 0;
            width: 100%;
        }

    </style>
@endsection
@section('content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">

                        <div class="sidebar__item">
                            <h4>مبلغ</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                     data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input" style="direction: ltr">
                                        <input type="text" id="minamount" style="float: left">
                                        <input type="text" id="maxamount" value="">
                                    </div>
                                </div>
                            </div>
                            <input class="ptn-price" type="button" onclick="doSearch()" value="اعمال محدوده قیمت">
                        </div>
                        <form id="form-filter-attribute" method="post" action="{{route('shop.doSearch')}}"
                              enctype="multipart/form-data">

                        @foreach($attributes as $attribute)
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>{{$attribute->title}}</h4>
                            <?php $row=1; ?>
                            @foreach($attribute->attribute_values as $attribute_value)
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <input type="checkbox" name="attr-<?=$attribute['id']?>[]" value="{{$attribute_value->id}}" id="basic_checkbox_{{$attribute->id.$row}}" class="filled-in filte_right">
                                <label for="basic_checkbox_{{$attribute->id.$row}}">{{$attribute_value->value}}</label>
                            </div>
                                <?php $row++; ?>
                            @endforeach
                        </div>
                        @endforeach
                        </form>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4> جدیدترین محصولات</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                        $i=1;
                                        foreach ($products_new as $item){
                                        if ($i % 3 == 0) {
                                        ?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php } ?>
                                        <a href="" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img style="width: 110px!important; " src="{{asset($item->image)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{str_limit($item->title,100)}}</h6>
                                                @if($item->discount=='0')
                                                    <div style="color: green">{{number_format($item->price)}} تومان</div>
                                                @else
                                                    <span>
                                         <span>{{number_format($item->price)}} تومان </span>
                                        <span>{{number_format($item->price*(100-$item->discount)/100)}} تومان </span>
                                        </span>
                                                @endif
                                            </div>
                                        </a>
                                        <?php $i++; } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2 style="font-size: 25px">تخفیف</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($products_discount as $product_discount)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" style="background-size: 78% 97%;"
                                             data-setbg="{{asset($product_discount->image)}}">
                                            <div class="product__discount__percent">-{{$product_discount->discount}}%</div>
                                            <ul class="product__item__pic__hover">
                                                @php
                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product_discount->id])->first()
                                                @endphp
                                                @if(empty($favorite))
                                                    <li><a onclick="favorite(this,{{$product_discount->id}})"><i class="fa fa-heart"></i></a></li>
                                                @else
                                                    <li><a style="color: red" onclick="favorite(this,{{$product_discount->id}})"><i class="fa fa-heart"></i></a></li>
                                                @endif
                                                <li><a href="/product/{{$product_discount->slug}}"><i class="fa fa-retweet"></i></a></li>
                                                @if($product_discount->depot>0)
                                                    <li><a onclick="addcart(this,'{{$product_discount->id}}')"><i class="fa fa-shopping-cart"></i></a></li>
                                                @else
                                                    <li><a style="width: 70px">ناموجود</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <a href="/product/{{$product_discount->slug}}">{{str_limit($product_discount->title,50)}}</a>
                                            <div class="featured__item__text">
                                                @if($product_discount->discount<=0)
                                                    <div style="color: green">{{number_format($product_discount->price)}} تومان</div>
                                                @else
                                                    <span>
                                         <span>{{number_format($product_discount->price)}} تومان </span>
                                        <span>{{number_format($product_discount->price*(100-$product_discount->discount)/100)}} تومان </span>
                                        </span>
                                                @endif</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="filter__sort">
                                    <span>مرتب سازی بر اساس</span>
                                    <select name="sort" id="sort" onchange="doSearch()">
                                        <option value="new">جدید ترین</option>
                                        <option value="sell">پرفروش ترین</option>
                                        <option value="view">پرپازدیدترین</option>
                                        <option value="priceLow">ارزان ترین</option>
                                        <option value="priceHigh">گران ترین</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__sort">
                                    <span>تعداد نمایش</span>
                                    <select id="limit" name="limit" onchange="doSearch()">
                                        <option value="21">20</option>
                                        <option value="31">30</option>
                                        <option value="41">40</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row" id="products">
                        @foreach($productItems as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" style="background-size: 78% 97%;" data-setbg="{{asset($item->image)}}">
                                    @if($item->discount>0)
                                    <div class="product__discount__percent">-{{$item->discount}}%</div>
                                    @endif
                                    <ul class="product__item__pic__hover">
                                        @php
                                            $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                        @endphp
                                        @if(empty($favorite))
                                            <li><a onclick="favorite(this,{{$item->id}})"><i class="fa fa-heart"></i></a></li>
                                        @else
                                            <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="fa fa-heart"></i></a></li>
                                        @endif
                                        <li><a href="/product/{{$item->slug}}"><i class="fa fa-retweet"></i></a></li>
                                        @if($item->depot>0)
                                            <li><a onclick="addcart(this,'{{$item->id}}')"><i class="fa fa-shopping-cart"></i></a></li>
                                        @else
                                            <li><a style="width: 70px">ناموجود</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="/product/{{$item->slug}}">{{str_limit($item->title,100)}}</a></h6>
                                    @if($item->discount=='0')
                                        <div style="color: green">{{number_format($item->price)}} تومان</div>
                                    @else
                                        <span>
                                         <span>{{number_format($item->price)}} تومان </span>
                                        <span>{{number_format($item->price*(100-$item->discount)/100)}} تومان </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                       {{$productItems->links()}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
{{--    <input type="button" value="Page1" id="button1" />
    <input type="button" value="Page2" id="button2" />
    <input type="button" value="Page3" id="button3" />--}}

@endsection

@section('script_link')
@endsection

@section('script')
    <script>
        $('.filte_right').click(function () {
            var tag=this;
            if ($(tag).is(':checked')){
                doSearch();
            }else{
                doSearch();
            }
        });
    </script>
    <script>
        function doSearch() {
            var dataval=$('#form-filter-attribute').serializeArray();
            var limit=$('#limit').val();
            var sort=$('#sort').val();
            var minamount=parseInt($('#minamount').val());
            var maxamount=parseInt($('#maxamount').val());
            $('#products').empty()
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('shop.doSearch')}}';
            var data = {_token: CSRF_TOKEN, dataval:dataval,limit:limit,sort:sort,minamount:minamount,maxamount:maxamount};
            $.post(url, data, function (msg) {
                console.log(msg)
                $('#products').append(msg)
            })
            /*$.ajax({
                type: "post",
                url: "{{route('shop.doSearch')}}",
                data: {
                    data:dataval,
                    exist: "0",
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data.msg);

                },
                error: function (err) {
                    if (err.status == 422) {

                    }
                }
            });*/
        }

    </script>
    <script type="text/javascript">
        function ChangeUrl(page, url) {
                var obj = { Page: page, Url: url };
                history.pushState(obj, obj.Page, 'shop?'+obj.Url);
        }
        $(function () {
            $("#button1").click(function () {
                ChangeUrl('Page1', 'Page1.htm');
            });
            $("#button2").click(function () {
                ChangeUrl('Page2', 'Page2.htm');
            });
            $("#button3").click(function () {
                ChangeUrl('Page3', 'Page3.htm');
            });
        });
    </script>
@endsection
