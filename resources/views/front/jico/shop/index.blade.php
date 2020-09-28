@extends('front'.theme_name().'layout.master')
@section('style')
    <style>
        #products .single-new-collection-item{
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            overflow: hidden;
            padding-top: 7px;
        }
        .single-new-collection-item .content{
            border: none;
        }
    </style>
@endsection
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>فروشگاه</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>خرید</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- Shop Section Start -->
    <div class="shop-section section sb-border pt-100 pt-lg-80 pt-md-60 pt-sm-50 pb-70 pb-lg-50 pb-md-40 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-lg-3 order-lg-1 order-2">
                                <!-- Single Sidebar Start  -->
                                <div class="common-sidebar-widget">
                                    <h3 class="sidebar-title">دسته بندی محصولات</h3>
                                    <ul class="sidebar-list">
                                        @php $categories=App\Category::all() @endphp
                                        @foreach($categories as $category)
                                        <li><a href="#"><i class="ion-plus"></i>{{$category->title}} <span class="count"></span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Single Sidebar End  -->
                                <!-- Single Sidebar Start  -->
                                <div class="common-sidebar-widget">
                                    <h3 class="sidebar-title">فیلتر بر اساس قیمت</h3>
                                    <div class="sidebar-price">
                                        <div id="price-range" class="mb-20"></div>
                                        <button type="button" class="ht-btn black-btn small-btn">فیلتر</button>
                                        <input type="text" id="price-amount" class="price-amount" readonly="">
                                    </div>
                                </div>
                                <!-- Single Sidebar End  -->
                                <!-- Single Sidebar Start  -->
                                <div class="common-sidebar-widget">
                                        <div class="category-filter-widget"><!-- category-filter-widget -->
                                            جستجو براساس
                                            <form id="form-filter-attribute">
                                                <?php $st=1; ?>
                                                @foreach($attributes as $attribute)
                                                    <?php $st++ ?>

                                                    <h4 style="font-size: 20px;margin-top: 20px" class="title">{{$attribute->title}}</h4>
                                                    <ul class="cat-list">
                                                        <?php $row=1; ?>
                                                        @foreach($attribute->attribute_values as $attribute_value)
                                                            <li><input class="filte_right" name="attr-<?=$attribute['id']?>[]" value="{{$attribute_value->id}}" type="checkbox" ><span style="margin-right: 5px">{{$attribute_value->value}}</span></li>
                                                            <?php $row++; ?>
                                                        @endforeach

                                                    </ul>

                                                @endforeach
                                            </form>

                                        </div><!-- //.category-filter-widget -->
                                </div>

                            </div>
                            <div class="col-lg-9 order-lg-2 order-1">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Grid & List View Start -->
                                        <div class="shop-topbar-wrapper d-flex justify-content-between align-items-center">
                                            <div class="grid-list-option d-flex">

                                                <div class="toolbar-shorter ">

                                                    <p> <label>تعداد آیتم:</label></p>

                                                    <select class="wide select" id="limit" name="limit" onchange="doSearch()">
                                                        <option value="10">10 آیتم در هر صفحه</option>
                                                        <option value="20">20 آیتم در هر صفحه</option>
                                                        <option value="30">30 آیتم در هر صفحه</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--Toolbar Short Area Start-->
                                            <div class="toolbar-short-area d-md-flex align-items-center">
                                                <div class="toolbar-shorter ">
                                                    <label>مرتب سازی بر اساس:</label>

                                                    <select style="float: right" class="wide select" name="sort" id="sort" onchange="doSearch()">
                                                        <option value="new">جدید ترین</option>
                                                        <option value="sell">پرفروش ترین</option>
                                                        <option value="view">پرپازدیدترین</option>
                                                        <option value="priceLow">ارزان ترین</option>
                                                        <option value="priceHigh">گران ترین</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--Toolbar Short Area End-->
                                        </div>
                                        <!-- Grid & List View End -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="shop-product">
                                            <div id="myTabContent-2" class="tab-content">
                                                <div id="grid" class="tab-pane fade active show">
                                                    <div class="product-grid-view">
                                                        <div class="row" id="products">
                                                            @foreach($productItems as $item)
                                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                                <div class="single-grid-product mb-40">
                                                                    <div class="product-image">
                                                                        @if($item->discount>0)
                                                                            <div class="product-label">
                                                                                <span class="sale">{{$item->discount}}%</span>
                                                                            </div>
                                                                        @endif
                                                                        <a href="/product/{{$item->slug}}">
                                                                            <img src="{{asset($item->image)}}" class="img-fluid" alt="{{$item->title}}">
                                                                        </a>

                                                                        <div class="product-action d-flex justify-content-between">
                                                                            @if($item->depot>0)
                                                                                <a class="product-btn" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد خرید</a>
                                                                            @else
                                                                                <a class="product-btn">ناموجود</a>
                                                                            @endif
                                                                            <ul class="d-flex">
                                                                                @php
                                                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                                                @endphp
                                                                                @if(empty($favorite))
                                                                                    <li><a onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                                                @else
                                                                                    <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="lnr lnr-heart"></i></a></li>
                                                                                @endif
                                                                                <li><a href="/product/{{$item->slug}}" title="مشاهده "><i class="lnr lnr-eye"></i></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-content">
                                                                        <h3 class="title"> <a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                                                                        <div class="product-category-rating">
                                                                            @if($item->discount>0)
                                                                                <p class="product-price rtl" style="text-decoration: line-through;">{{number_format($item->price)}} تومان </p>
                                                                                <p class="product-price rtl">{{number_format($item->price*(100-$item->discount)/100)}} تومان</p>
                                                                            @else
                                                                                <p class="product-price rtl">{{number_format($item->price)}} تومان </p>
                                                                            @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0 mb-xs-35 mb-sm-35">
                                   {{$productItems->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section End -->


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
