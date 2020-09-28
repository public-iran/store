@extends('front'.theme_name().'layout.master')

@section('style')
    <style>
        .product-details-view-content .product-info h1 {
            font-size: 18px;
            letter-spacing: -.025em;
            line-height: 24px;
            color: #0363cd;
            text-transform: capitalize;
            font-weight: 500;
            margin: 0 0 15px 0;
        }
        .wishlist-btn{
            cursor: pointer;
        }
        .product-tab div,.product-tab span,.product-tab p,.product-tab h3,.product-tab h1,.product-tab h4,.product-tab h5,.product-tab h6,.product-tab h2{
            font-family: 'Yekan', sans-serif;
        }
    </style>
@endsection
@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li><a href="/shop">فروشگاه</a></li>
                    <li class='active'>{{$product->title}}</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
                    <div class="sidebar-module-container">




                        <!-- ============================================== HOT DEALS ============================================== -->
                        <div class="sidebar-widget hot-deals outer-bottom-xs">
                            <h3 class="section-title">پیشنهادات ویژه</h3>
                            <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                                @foreach($spacial_product as $item)
                                    <div class="item">
                                        <div class="products">
                                            <div class="hot-deal-wrapper">
                                                <div class="image">
                                                    <a href="/product/{{$item->slug}}">
                                                        <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                    </a>
                                                </div>
                                                @if($item->discount>0)
                                                    <div class="sale-offer-tag"><span>{{$item->discount}}%<br>
                    تخفیف</span></div>
                                                @endif

                                            </div>
                                            <!-- /.hot-deal-wrapper -->

                                            <div class="product-info text-right m-t-20">
                                                <h3 class="name"><a href="/product/{{$item->slug}}">{{$item->title}}</a></h3>
                                                {{--<div class="rating rateit-small"></div>--}}
                                                @if($item->discount>0)
                                                    <div class="product-price"> <span class="price" style="float: right;width: 100%"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> <span class="price-before-discount">{{number_format($item->price)}} تومان</span> </div>
                                                @else
                                                    <div class="product-price"> <span class="price"> {{number_format($item->price)}} تومان </span></div>
                                            @endif                                        <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->

                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    @if($item->depot>0)
                                                        <div class="add-cart-button btn-group" onclick="addcart(this,'{{$item->id}}')">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button">افزودن به سبد</button>
                                                        </div>
                                                    @else
                                                        <div class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button">ناموجود</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.sidebar-widget -->
                        </div>
                        <!-- ============================================== HOT DEALS: END ============================================== -->

                        <!-- ============================================== NEWSLETTER ============================================== -->
                        <div class="sidebar-widget newsletter outer-bottom-small outer-top-vs">
                            <h3 class="section-title">عضویت در خبرنامه</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <p>برای دریافت تازه ترین ها اولین نفر باشید!</p>
                                <form>
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail1">آدرس ایمیل</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="عضویت در خبرنامه">
                                    </div>
                                    <button class="btn btn-primary">عضویت</button>
                                </form>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->


                        <!-- ============================================== Testimonials: END ============================================== -->



                    </div>
                </div>
                <!-- /.sidebar -->
                <div class='col-xs-12 col-sm-12 col-md-9 rht-col'>
                    <div class="detail-block">
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        <?php $i=1;?>
                                        @foreach($images as $image)
                                        <div class="single-product-gallery-item" id="slide{{$i}}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{asset($image->path)}}">
                                                <img class="img-responsive" alt="" src="{{asset($image->path)}}" data-echo="{{asset($image->path)}}" />
                                            </a>
                                        </div>
                                                <?php $i++;?>
                                        @endforeach
                                    </div>
                                    <!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            <?php $i=1;?>
                                            @foreach($images as $image)
                                            <div class="item">
                                                <a class="horizontal-thumb " data-target="#owl-single-product" data-slide="{{$i}}" href="#slide{{$i}}">
                                                    <img class="img-responsive" alt="" src="{{asset($image->path)}}" data-echo="{{asset($image->path)}}" />
                                                </a>
                                            </div>
                                                    <?php $i++;?>
                                            @endforeach
                                        </div>
                                        <!-- /#owl-single-product-thumbnails -->



                                    </div>
                                    <!-- /.gallery-thumbs -->

                                </div>
                                <!-- /.single-product-gallery -->
                            </div>
                            <!-- /.gallery-holder -->
                            <div class='col-sm-12 col-md-8 col-lg-8 product-info-block'>
                                <div class="product-info">
                                    <h1 style="font-size: 23px" class="name">{{$product->title}}</h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="pull-right">
                                                    <div class="rating rateit-small"></div>
                                                </div>
                                                <div class="pull-right">
                                                    <div class="reviews">
                                                        <a href="#" class="lnk">({{count($comments)}} دیدگاه)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="pull-right">
                                                    <div class="stock-box">
                                                        <span class="label">موجودیت :</span>
                                                    </div>
                                                </div>
                                                @if($product->depot>0)
                                                <div class="pull-right">
                                                    <div class="stock-box">
                                                        <span class="value">موجود در انبار</span>
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="pull-right">
                                                        <div class="stock-box">
                                                            <span class="value">نا موجود</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        <p>{{str_limit($product->excerpt,450)}}</p>
                                    </div>
                                    <!-- /.description-container -->

                                    <div class="price-container info-container m-t-30">
                                        <div class="row">


                                            <div class="col-sm-6 col-xs-6">
                                                @if($product->discount>0)
                                                <div class="price-box">
                                                    <span class="price">{{number_format($product->price)}} تومان</span>
                                                    <span class="price-strike">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                                </div>
                                                @else
                                                    <div class="price-box">
                                                    <span class="price-strike">{{number_format($product->price)}} تومان</span>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <div class="favorite-button m-t-5">
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                    <a class="btn btn-primary" onclick="favorite(this,{{$product->id}})" data-toggle="tooltip" data-placement="right" title="افزودن به علاقه مندیها" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    @else
                                                        <a style="color: red" class="btn btn-primary" onclick="favorite(this,{{$product->id}})" data-toggle="tooltip" data-placement="right" title="افزودن به علاقه مندیها" href="#">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.price-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">


                                            <div class="add-btn">
                                                @if($product->depot>0)
                                                <a class="btn btn-primary" onclick="addcart(this,'{{$product->id}}')"><i class="fa fa-shopping-cart inner-right-vs"></i> افزودن به سبد</a>
                                                @else
                                                    <a class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ناموجود</a>
                                                @endif
                                            </div>


                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.quantity-container -->





                                </div>
                                <!-- /.product-info -->
                            </div>
                            <!-- /.col-sm-7 -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">توضیحات</a></li>
                                    <li><a data-toggle="tab" href="#tags">ویژگی ها</a></li>
                                    <li><a data-toggle="tab" href="#review">بررسی</a></li>

                                </ul>
                                <!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-12 col-md-9 col-lg-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text"> <?= $product->content ?></p>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->


                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">

                                            <table class="table table-bordered">
                                                <thead>

                                                <tr>
                                                    <td colspan="2"><strong>مشخصات فنی</strong></td>
                                                </tr>
                                                </thead>
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
                                        <!-- /.product-tab -->
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">دیدگاه مشتریان</h4>
                                                <div class="reviews">
                                                @foreach($comments as $comment)
                                                    <div class="review">
                                                        <div class="review-title"><span class="summary" style="float: right;margin-left: 30px">{{$comment->user->name}}</span><span class="date"><i class="fa fa-calendar"></i><span>{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</span></span>
                                                        </div>
                                                        <div class="text">{{$comment->content}}</div>
                                                        @php $comments_ansswers=App\Comment::where('parent',$comment->id)->get() @endphp
                                                        @foreach($comments_ansswers as $comments_ansswer)
                                                            <div style="padding-right: 10px" class="review">
                                                                <div class="review-title"><span class="summary" style="float: right;margin-left: 30px">مدیر</span><span class="date"><i class="fa fa-calendar"></i><span>{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span></span>
                                                                </div>
                                                                <div class="text">{{$comments_ansswer->content}}</div>
                                                            </div>
                                                        @endforeach
                                                    </div>


                                            @endforeach
                                                <!-- /.reviews -->
                                            </div>
                                            </div>
                                            <!-- /.product-reviews -->



                                            <div class="product-add-review">
                                                <h4 class="title">دیدگاه خود را بیان کنید</h4>

                                                <!-- /.review-table -->
                                                @if(Auth::check())
                                                    <form class="send_comment" method="post" action="{{route('comment_product_store')}}">
                                                        @csrf
                                                <div class="review-form">
                                                    <div class="form-container">

                                                            <div class="row">
                                                                <div class="col-sm-6">

                                                                    <!-- /.form-group -->
                                                                    <div class="form-group">
                                                                        <label for="exampleInputSummary">عنوان <span class="astk">*</span></label>
                                                                        <input type="text" name="title" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                        <input name="pro" type="hidden" value="{{$product->id}}">
                                                                    </div>
                                                                    <!-- /.form-group -->
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputReview">دیدگاه <span class="astk">*</span></label>
                                                                        <textarea name="content" class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                    </div>
                                                                    <!-- /.form-group -->
                                                                </div>
                                                            </div>
                                                            <!-- /.row -->

                                                            <div class="action text-right">
                                                                <button class="btn btn-primary btn-upper">ارسال دیدگاه</button>
                                                            </div>
                                                            <!-- /.action -->

                                                        <!-- /.cnt-form -->
                                                    </div>
                                                    <!-- /.form-container -->
                                                </div>
                                                <!-- /.review-form -->
                                                        @else
                                                            برای ثبت نظر
                                                            <a href="/login"> وارد شوید</a>
                                                @endif
                                            </div>
                                            <!-- /.product-add-review -->

                                        </div>
                                        <!-- /.product-tab -->
                                    </div>
                                    <!-- /.tab-pane -->


                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.product-tabs -->

                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="section featured-product">
                        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
                            <div class="more-info-tab clearfix ">
                                <h3 class="new-product-title pull-right">محصولات مرتبت</h3>
                                <!-- /.nav-tabs -->
                            </div>
                            <div class="tab-content outer-top-xs">
                                <div class="tab-pane in active" id="all">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                            @foreach($like_products as $item)
                                                <div class="item item-carousel">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image">
                                                                    <a href="/product/{{$item->slug}}">
                                                                        <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                                    </a>
                                                                </div>
                                                                <!-- /.image -->
                                                                @if($item->discount>0)
                                                                    <div class="tag new"><span>{{$item->discount}}%</span></div>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-right">
                                                                <h3 class="name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,37)}}</a></h3>
                                                                {{--<div class="rating rateit-small"></div>
                                                                <div class="description"></div>--}}
                                                                @if($item->discount>0)
                                                                    <div class="product-price"> <span class="price"> {{number_format($item->price*(100-$item->discount)/100)}} تومان </span> <span class="price-before-discount">{{number_format($item->price)}} تومان</span> </div>
                                                                @else
                                                                    <div class="product-price"> <span class="price"> {{number_format($item->price)}} تومان </span></div>
                                                                @endif

                                                            </div>
                                                            <!-- /.product-info -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        @if($item->depot>0)
                                                                            <li class="add-cart-button btn-group" onclick="addcart(this,'{{$item->id}}')">
                                                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> <i class="fa fa-shopping-cart"></i> </button>
                                                                                <button class="btn btn-primary cart-btn" type="button">افزودن به سبد</button>
                                                                            </li>
                                                                        @else
                                                                            <li class="add-cart-button btn-group">
                                                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title=""> ناموجود</button>
                                                                            </li>
                                                                        @endif
                                                                        @php
                                                                            $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                                        @endphp
                                                                        @if(empty($favorite))
                                                                            <li class="lnk wishlist"  onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                        @else
                                                                            <li class="lnk wishlist" style="color: red" onclick="favorite(this,{{$item->id}})"> <a data-toggle="tooltip" class="add-to-cart" title=""> <i class="icon fa fa-heart"></i> </a> </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product -->

                                                    </div>
                                                    <!-- /.products -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- /.home-owl-carousel -->
                                    </div>
                                    <!-- /.product-slider -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div>
                <!-- /.col -->
                <div class="clearfix"></div>
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->

            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->

@endsection
@section('script')
    @if(session('save_comment'))
        <script>
            alertify.set('notifier','position', 'bottom-left');
            alertify.success('نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        </script>
    @endif
@endsection

@php
    Session::forget('save_comment');
@endphp
