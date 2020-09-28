@extends('front'.theme_name().'layout.master')
@section('content')

    <style>
        @media (min-width: 1025px){
            .single-product-detail .single-product-info .product-desc {
                max-width: 432px;
            }
        }
    </style>

    <div class="container container-240">
        <div class="product-bundle product-aff">
            <ul class="breadcrumb">
                <li><a href="#">صفحه نخست</a></li>
                <li class="active">{{$product->title}}</li>
            </ul>
            <div class="row shop-colect r-sidebar">
                <div class="col-md-3 col-sm-3 col-xs-12 col-left collection-sidebar v2" id="filter-sidebar">
                    <div class="banner">
                        <a class="image-bd hover-images" href=""><img src="{{asset('ecome/img/s-banner.jpg')}}" alt="" class="img-reponsive"></a>
                    </div>
                    <div class="filter filter-product e-category">
                        <h2 class="widget-blog-title">محبوب ترین ها</h2>

                        <div class="item">
                            @foreach($products_view as $item)
                                <div class="cate-item">
                                    <div class="product-img">
                                        <a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" class="img-reponsive"></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="/product/{{$item->slug}}">{{str_limit($item->title, 40)}} </a></h3>
                                        @if($item->discount>0)
                                            <span style="text-decoration: line-through">{{number_format($item->price)}} تومان</span>
                                            <br>
                                            <span style="color: #00d500">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                        @else
                                            <span style="color: #00d500">{{number_format($item->price)}} تومان</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 collection-list single-product-detail v2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            <div class="flex product-img-slide">
                                <div class="product-images">
                                    <div class="main-img js-product-slider">
                                        @foreach($images as $image)
                                            <a class="hover-images effect"><img src="{{asset($image->path)}}" alt="{{$product->title}}" class="img-reponsive"></a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="multiple-img-list-ver2 js-click-product">
                                    @foreach($images as $image)
                                        <div class="product-col">
                                            <div class="img active">
                                                <img src="{{asset($image->path)}}" alt="{{$product->title}}" class="img-reponsive">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="single-flex">
                                <div class="single-product-info product-info product-grid-v2 s-50">
                                    <p class="product-cate">
                                        @foreach ($product->categories as $category)
                                            {{$category->title}} |
                                        @endforeach
                                    </p>
                                    <h1 class="product-title" style="line-height: 1.7">{{$product->title}}</h1>
                                    <div class="product-price">
                                        @if($product->discount>0)
                                            <sup class="price-old" style="color: red;text-decoration: line-through">{{number_format($product->price)}} تومان</sup> <br><span itemprop="price" style="color: #00d500">{{number_format($product->price-($product->price*$product->discount/100))}} تومان<span itemprop="availability" content="موجود"></span></span>
                                        @else
                                            <span itemprop="price" style="color: #00d500">{{number_format($product->price)}} تومان <span itemprop="availability" content="موجود"></span></span>
                                        @endif
                                    </div>
                                    <div class="availability">
                                        <p class="product-inventory">
                                            <label>وضعیت کالا : </label>
                                            @if($product->depot>0)
                                                موجود در انبار =
                                                <span style="color: #00d500">{{$product->depot.' '.$product->unit}}</span>
                                            @else
                                                <span style="color: red">اتمام موجودی</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="short-desc">
                                        <p class="product-desc"><?= str_limit($product->excerpt, 460) ?></p>
                                    </div>
                                    <div class="single-product-button-group">
                                        <div class="e-btn cart-qtt btn-gradient">
                                            <div class="e-quantity">
                                                <input data-producid="{{$product->id}}" type="number" step="1" min="1" max="999" name="quantity" value="1" title="Qty" class="qty input-text js-number" size="4">
                                                <div class="tc pa">
                                                    <a class="js-plus quantity-right-plus"><i class="fa fa-caret-up"></i></a>
                                                    <a class="js-minus quantity-left-minus"><i class="fa fa-caret-down"></i></a>
                                                </div>
                                            </div>
                                            <a style="cursor: pointer" onclick="addcart(this,'{{$product->id}}')" class="btn-add-cart">افزودن به سبد <span class="icon-bg icon-cart v2"></span></a>
                                        </div>
                                        @php
                                            $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                        @endphp
                                        @if(empty($favorite))
                                            <a style="cursor: pointer" onclick="favorite(this,{{$product->id}})" class="e-btn btn-icon">
                                                <span class="icon-bg icon-wishlist"></span>
                                            </a>
                                        @else
                                            <a style="cursor: pointer" onclick="favorite(this,{{$product->id}})" class="e-btn btn-icon">
                                                <span class="icon-bg icon-wishlist2"></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-product-tab bd-7">
                        <div class="cmt-title text-center abs">
                            <ul class="nav nav-tabs text-center v2">
                                <li class="active"><a data-toggle="pill" href="#desc">نقد و بررسی</a></li>
                                <li><a data-toggle="pill" href="#info">مشخصات کلی</a></li>
                                <li><a data-toggle="pill" href="#review">دیدگاه کاربران</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="desc" class="tab-pane fade in active">
                                <div class="entry-content active">
                                    <div class="e-text">
                                        <div class="entry-img-first text-center">
                                            <img class="responsive-img" style="max-height: 300px" src="{{asset($product->image)}}" alt="">
                                        </div>
                                        <div class="entry-inside v2 img-cal" style="text-align: right">
                                            <?= $product->content ?>
                                        </div>
                                    </div>
                                    <div class="entry-button text-center abs">
                                        <a href="#" class="btn-show">بیشتر ببینید<i class="ion-chevron-down"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="info" class="tab-pane fade in">
                                <div style="padding: 20px">
                                    <table class="table table-striped table-bordered" dir="rtl" style="text-align: right">
                                        <tbody>
                                        @foreach($featurs as $featur)
                                            <tr>
                                                <td>{{$featur->title}}</td>
                                                <td>{{$featur->content}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div id="review" class="tab-pane fade in ">

                                <ul>
                                    <li>
                                        <div class="blog-comment-item">
                                            <div class="cmt-img">
                                                <img src="img/blog/author2.jpg" alt="">
                                            </div>
                                            <div class="cmt-content">
                                                <div class="wrp-name">
                                                    <div class="wrp-element">
                                                        <span class="name">فلان فلانی نسب</span>
                                                        <a href="#"><i class="fa fa-reply"></i></a>
                                                    </div>
                                                    <span class="date">12 خرداد 1398، چند لحظه پیش</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="blog-comment-item">
                                            <div class="cmt-img">
                                                <img src="img/blog/author3.jpg" alt="">
                                            </div>
                                            <div class="cmt-content">
                                                <div class="wrp-name">
                                                    <div class="wrp-element">
                                                        <span class="name">فلان فلانی نسب</span>
                                                        <a href="#"><i class="fa fa-reply"></i></a>
                                                    </div>
                                                    <span class="date">12 خرداد 1398، چند لحظه پیش</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="blog-comment-item">
                                            <div class="cmt-img">
                                                <img src="img/blog/author4.jpg" alt="">
                                            </div>
                                            <div class="cmt-content">
                                                <div class="wrp-name">
                                                    <div class="wrp-element">
                                                        <span class="name">فلان فلانی نسب</span>
                                                        <a href="#"><i class="fa fa-reply"></i></a>
                                                    </div>
                                                    <span class="date">12 خرداد 1398، چند لحظه پیش</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="blog-comment-item">
                                            <div class="cmt-img">
                                                <img src="img/blog/author4.jpg" alt="">
                                            </div>
                                            <div class="cmt-content">
                                                <div class="wrp-name">
                                                    <div class="wrp-element">
                                                        <span class="name">فلان فلانی نسب</span>
                                                        <a href="#"><i class="fa fa-reply"></i></a>
                                                    </div>
                                                    <span class="date">12 خرداد 1398، چند لحظه پیش</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bestseller">
            <div class="ecome-heading style5v3 spc5v3">
                <h2>محصولات مرتبط</h2>
            </div>
            <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate">
                @foreach($like_products as $item)
                    <div class="product-item">
                        <div class="pd-bd product-inner">
                            <div class="product-img">
                                <a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="" class="img-reponsive"></a>
                            </div>
                            <div class="product-info">
                                <div class="color-group">
                                </div>
                                <div class="element-list element-list-left">
                                </div>
                                <div class="element-list element-list-middle">
                                    <p class="product-cate">
                                        @foreach ($item->categories as $category)
                                            {{$category->title}} /
                                        @endforeach
                                    </p>
                                    <h3 class="product-title"><a href="/product/{{$item->slug}}">{{str_limit($item->title,80)}}</a></h3>
                                    <div class="product-bottom">
                                        <div class="product-price">
                                            @if($item->discount>0)
                                                <span style="text-decoration: line-through">{{number_format($item->price)}} تومان</span>
                                                <br>
                                                <span style="color: #00d500">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                            @else
                                                <span style="color: #00d500">{{number_format($item->price)}} تومان</span>
                                            @endif
                                        </div>
                                        <a href="#" class="btn-icon btn-view">
                                            <span class="icon-bg icon-view"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-button-group">
                                    <a style="cursor: pointer" class="btn-icon">
                                        <span class="icon-bg icon-cart" onclick="addcart(this,'{{$item->id}}')"></span>
                                    </a>
                                    <a href="/product/{{$item->slug}}" class="">
                                        <span class="text-primary">جزئیات محصول</span>
                                    </a>

                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                            <span class="icon-bg icon-wishlist"></span>
                                        </a>
                                    @else
                                        <a style="cursor: pointer" onclick="favorite(this,{{$item->id}})" class="btn-icon">
                                            <span class="icon-bg icon-wishlist2"></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

