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
    <section class="breadcrumb-area breadcrumb-bg extra" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">فروشگاه</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">خانه</a></li>
                                <li>فروشگاه</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>

    <!-- category content area start -->
    <div class="category-content-area search-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="category-sidebar"><!-- category sidebar -->
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
                    </div><!-- //. category sidebar -->

                </div>
                <div class="col-lg-9">
                    <div class="right-content-area"><!-- right content area -->
                        <div class="top-content"><!-- top content -->
                            <div class="left-conent">
                                @if(@$_GET['cat'])
                                <span class="cat">{{$_GET['cat']}}</span>
                                @else
                                    <span class="cat">فروشگاه</span>
                                @endif
                            </div>
                            <div class="right-content">
                                <ul>
                                    <li>
                                        <div class="form-element has-icon">

                                            <select class="selectpicker input-field select" id="limit" name="limit" onchange="doSearch()">
                                                <option value="10">10 آیتم در هر صفحه</option>
                                                <option value="20">20 آیتم در هر صفحه</option>
                                                <option value="30">30 آیتم در هر صفحه</option>
                                            </select>
                                            <div class="the-icon">
                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-element has-icon">
                                            <select style="float: right" class="selectpicker input-field select" name="sort" id="sort" onchange="doSearch()">
                                                <option value="new">جدید ترین</option>
                                                <option value="sell">پرفروش ترین</option>
                                                <option value="view">پرپازدیدترین</option>
                                                <option value="priceLow">ارزان ترین</option>
                                                <option value="priceHigh">گران ترین</option>
                                            </select>
                                            <div class="the-icon">
                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div><!-- //. top content -->
                        <div class="bottom-content"><!-- top content -->
                            <div class="row" id="products">
                                @foreach($productItems as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-new-collection-item" style=""><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                            <div class="hover">
                                                @if($item->depot>0)
                                                    <a class="addtocart" onclick="addcart(this,'{{$item->id}}')">افزودن به سبد</a>
                                                @else
                                                    <a class="addtocartt">ناموجود</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="content">
                                            <a href="/product/{{$item->slug}}"><h4 class="title">{{str_limit($item->title,37)}}</h4></a>
                                            @if($item->discount>0)
                                                <div class="price"><span class="sprice">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <del class="dprice">{{number_format($item->price)}} تومان</del></div>
                                            @else
                                                <div class="price"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                            @endif
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                @endforeach
                            </div>
                        </div><!-- //.top content -->
                    </div><!-- //. right content area -->
                </div>
            </div>
        </div>
    </div>


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
