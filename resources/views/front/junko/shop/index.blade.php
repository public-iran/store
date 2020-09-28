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
        li.widget_sub_categories2 > a::before {
            content: '\f106';
            cursor: pointer;
            font-family: FontAwesome;
            font-size: 12px;
            position: absolute;
            left: 0;
            top: 50%;
            -webkit-transform: translatey(-50%);
            -moz-transform: translatey(-50%);
            -ms-transform: translatey(-50%);
            -o-transform: translatey(-50%);
            transform: translatey(-50%);
        }
        .category-filter-widget li{
            padding-right: 15px;
        }
    </style>
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
                            <li>فروشگاه</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">
                            <div class="widget_list widget_categories">
                                <h2>دسته های محصولات</h2>
                                <ul>
                                    @php
                                        $categories = App\Category::where('parent', '0')->get();
                                    @endphp
                                    @foreach($categories as $category)
                                    <li class="widget_sub_categories"><a href="javascript:void(0)">{{$category->title}}</a>
                                        @php
                                            $categories2=App\Category::where('parent',$category->id)->get();
                                        @endphp
                                        @if(count($categories2))
                                        <ul class="widget_dropdown_categories" style="display: none">
                                            @foreach($categories2 as $category2)
                                            <li class="widget_sub_categories2"><a href="javascript:void(0)">{{$category2->title}}</a>
                                                <?php  $categories3=App\Category::where('parent',$category2->id)->get();   ?>
                                                @if(count($categories3))
                                                <ul class="widget_dropdown_categories2" style="display: none">
                                                    @foreach($categories3 as $category3)
                                                    <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}}</a></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                            @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget_list widget_filter">
                                <h2>فیلتر با قیمت</h2>
                                    <div id="slider-range"></div>
                                <form>
                                    <input type="text" id="amount">
                                    <span onclick="doSearch()">فیلتر</span>
                                    <input type="hidden" id="price-min" name="minamount">
                                    <input type="hidden" id="price-max" name="maxamount">
                                </form>

                            </div>
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
                    </aside>
                    <!--sidebar widget end-->
                </div>
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">

                            <button data-role="grid_3" type="button" class=" btn-grid-3" data-toggle="tooltip" title="3"></button>

                            <button data-role="grid_4" type="button" class="active btn-grid-4" data-toggle="tooltip" title="4"></button>

                            <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="لیست"></button>
                        </div>
                        <div class="niceselect_container">
                                <label>ترتیب:</label>

                                <select style="float: right" class="select_option select" name="sort" id="sort" onchange="doSearch()">
                                    <option value="new">جدید ترین</option>
                                    <option value="sell">پرفروش ترین</option>
                                    <option value="view">پرپازدیدترین</option>
                                    <option value="priceLow">ارزان ترین</option>
                                    <option value="priceHigh">گران ترین</option>
                                </select>
                        </div>
                        <div class="niceselect_container">
                            <label>تعداد آیتم:</label>

                            <select class="select_option select" id="limit" name="limit" onchange="doSearch()">
                                <option value="10">10 آیتم در هر صفحه</option>
                                <option value="20">20 آیتم در هر صفحه</option>
                                <option value="30">30 آیتم در هر صفحه</option>
                            </select>

                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <div class="row shop_wrapper" id="products">
                        @foreach($productItems as $item)
                        <div class="col-md-4 col-sm-6 col-xl-3">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}"></a>
                                        @if($item->discount>0)
                                            <div class="label_product">
                                                <span class="label_sale">{{$item->discount}}%</span>
                                            </div>
                                        @endif
                                        <div class="action_links">
                                            <ul>
                                                @php
                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                @endphp
                                                @if(empty($favorite))
                                                    <li class="wishlist"><a onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                                @else
                                                    <li class="wishlist"><a style="color: red" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                                @endif
                                                <li class="quick_button">
                                                    <a href="/product/{{$item->slug}}" title="مشاهده "> <span class="ion-ios-search-strong"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="add_to_cart">
                                            @if($item->depot>0)
                                                <a style="color: #fff" onclick="addcart(this,'{{$item->id}}')" title="افزودن به سبد">افزودن به سبد</a>
                                            @else
                                                <a style="color: #fff" title="ناموجود">ناموجود</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product_content grid_content">
                                        <div class="price_box">
                                            @if($item->discount>0)
                                                <span class="old_price">{{number_format($item->price)}} تومان</span>
                                                <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                            @else
                                                <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($item->price)}} تومان</span>
                                            @endif
                                        </div>
                                        <h3 class="product_name grid_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,50)}}</a></h3>

                                    </div>
                                    <div class="product_content list_content">
                                        <div class="left_caption">
                                            <div class="price_box">
                                                @if($item->discount>0)
                                                    <span class="old_price">{{number_format($item->price)}} تومان</span>
                                                    <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                @else
                                                    <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($item->price)}} تومان</span>
                                                @endif
                                            </div>
                                            <h3 class="product_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,120)}}</a></h3>
                                            <div class="product_desc">
                                                <p>{{str_limit($item->excerpt,200)}}</p>
                                            </div>
                                        </div>
                                        <div class="right_caption">
                                            <div class="add_to_cart">
                                                @if($item->depot>0)
                                                    <a onclick="addcart(this,'{{$item->id}}')" title="افزودن به سبد">افزودن به سبد</a>
                                                @else
                                                    <a title="ناموجود">ناموجود</a>
                                                @endif
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                    <li class="wishlist"><a onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i>  افزودن به علاقه‌مندی‌ها</a></li>
                                                    @else
                                                    <li class="wishlist"><a style="color: red" title="افزودن به علاقه‌مندی‌ها"><i class="fa fa-heart-o" aria-hidden="true"></i>  افزودن به علاقه‌مندی‌ها</a></li>
                                                    @endif
                                                    <li class="quick_button">
                                                        <a href="/product/{{$item->slug}}"  title="مشاهده "> <span class="ion-ios-search-strong"></span> نمایش </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                            </article>
                        </div>
                        @endforeach
                    </div>

                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                            {{$productItems->links()}}
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->




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
            var minamount=parseInt($('input[name=minamount]').val());
            var maxamount=parseInt($('input[name=maxamount]').val());
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
