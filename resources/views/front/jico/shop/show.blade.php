@extends('front'.theme_name().'layout.master')

@section('style_link')
    <link rel="stylesheet" href="{{asset('bigenja/css/flaticon.css')}}">
@endsection
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
        .product-details-content-area .right-content-area .bottom-content .price-area .left{
            font-size: 30px;
        }
       .single-product-description div,.single-product-description span,.single-product-description p,.single-product-description h3,.single-product-description h1,.single-product-description h4,.single-product-description h5,.single-product-description h6,.single-product-description h2{
           font-family: iransans;
        }
        .recently-added-carousel .price{
            direction: rtl!important;
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
                        <h2>محصول سینگل</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>محصول سینگل</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- Single Product Section Start -->
    <div class="single-product-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-100 pb-lg-80 pb-md-70 pb-sm-30 pb-xs-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Product Details Left -->
                                <div class="product-details-left">
                                    <div class="product-details-images slider-lg-image-1">
                                        <?php $i=1;?>
                                        @foreach($images as $image)
                                        <div class="lg-image">
                                            <img src="{{asset($image->path)}}" alt="">
                                            <a href="{{asset($image->path)}}" class="popup-img venobox" data-gall="myGalleryss"><i class="fa fa-expand"></i></a>
                                        </div>
                                                <?php $i++;?>
                                            @endforeach
                                    </div>
                                    <div class="product-details-thumbs slider-thumbs-1">
                                    <?php $i=1;?>
                                    @foreach($images as $image)
                                        <div class="sm-image"><img src="{{asset($image->path)}}" alt="شست تصویر محصول"></div>
                                    <?php $i++;?>
                                    @endforeach
                                </div>
                                </div>
                                <!--Product Details Left -->
                            </div>
                            <div class="col-lg-6">
                                <!--Product Details Content Start-->
                                <div class="product-details-content">
                                    <!--Product Nav Start-->

                                    <!--Product Nav End-->
                                    <h1 style="font-size: 20px;">{{$product->title}}</h1>
                                    <div class="single-product-reviews">
                                        <i class="fa fa-star active"></i>
                                        <i class="fa fa-star active"></i>
                                        <i class="fa fa-star active"></i>
                                        <i class="fa fa-star active"></i>
                                        <i class="fa fa-star-o"></i>
                                        <a class="review-link" href="#">({{count($comments)}} بررسی مشتری)</a>
                                    </div>
                                    <ul class="product-spec">
                                        <li>کد محصول: <span class="right">{{$product->id}}</span></li>
                                        @if($product->depot>0)
                                            <li>موجود:  <span class="right base-color">موجود است </span></li>
                                        @else
                                            <li>موجود:  <span class="right base-color">ناموجود  </span></li>
                                        @endif
                                    </ul>
                                    <div class="single-product-price">
                                        @if($product->discount>0)
                                        <span class="price new-price">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                        <span class="regular-price">{{number_format($product->price)}} تومان</span>
                                        @else
                                            <span class="price new-price">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                        @endif
                                    </div>
                                    <div class="product-description">
                                        <p>{{str_limit($product->excerpt,450)}}</p>
                                    </div>
                                    <div class="single-product-quantity">

                                            <div class="add-to-link">
                                                @if($product->depot>0)
                                                <button class="ht-btn black-btn" onclick="addcart(this,'{{$product->id}}')">افزودن به سبد خرید</button>
                                                @else
                                                    <button class="ht-btn black-btn">ناموجود</button>
                                                @endif
                                            </div>
                                    </div>
                                    <div class="wishlist-compare-btn">
                                        @php
                                            $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                        @endphp
                                        @if(empty($favorite))
                                        <a onclick="favorite(this,{{$product->id}})" class="wishlist-btn">افزودن به لیست دلخواه </a>
                                        @else
                                            <a style="color: red" onclick="favorite(this,{{$product->id}})" class="wishlist-btn">پاک کردن از لیست دلخواه </a>
                                        @endif
                                    </div>
                                    <div class="product-meta">
                                            <span class="posted-in">
                                                دسته بندی:
                                                 @foreach ($product->categories as $category)
                                                    <a>{{$category->title}}</a> ،
                                                @endforeach

                                            </span>
                                    </div>

                                </div>
                                <!--Product Details Content End-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product Section End -->

    <!--Product Description Review Section Start-->
    <div class="product-description-review-section section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-review-tab section">
                        <!--Review And Description Tab Menu Start-->
                        <ul class="nav dec-and-review-menu">
                            <li>
                                <a class="active" data-toggle="tab" href="#description">شرح</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#item_review">بررسی</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews">نظرات ({{count($comments)}})</a>
                            </li>
                        </ul>
                        <!--Review And Description Tab Menu End-->
                        <!--Review And Description Tab Content Start-->
                        <div class="tab-content product-review-content-tab" id="myTabContent-4">
                            <div class="tab-pane fade active show" id="description">
                                <div class="single-product-description">
                                    <h4 class="title">توضیحات محصول</h4>
                                    <p class="text"> <?= $product->content ?></p>
                                </div>
                            </div>
                            <div class="tab-pane  " id="item_review">
                                <div class="single-product-description">
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
                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <div class="review-page-comment">

                                    <ul>
                                        @foreach($comments as $comment)
                                        <li>
                                            <div class="product-comment">
                                                <img src="{{asset('jico/images/icons/author.png')}}" alt="">
                                                <div class="product-comment-content">
                                                    <p class="meta">
                                                        <strong style="float: right">{{$comment->user->name}}</strong> - <span>{{Verta::instance($comment->created_at)->format(' %d %B %Y')}} </span>
                                                    </p><div class="description">
                                                        <p>{{$comment->content}}</p>
                                                    </div>
                                                </div>
                                                @php $comments_ansswers=App\Comment::where('parent',$comment->id)->get(); @endphp
                                                @foreach($comments_ansswers as $comments_ansswer)
                                                <div class="product-comment-content" style="margin-right: 110px;margin-top: 10px;">
                                                    <p class="meta">
                                                        <strong style="float: right">مدیر</strong> - <span>{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}} </span>
                                                    </p><div class="description">
                                                        <p>{{$comments_ansswer->content}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="review-form-wrapper">
                                        <div class="review-form">
                                            <span class="comment-reply-title">یک بررسی اضافه کنید </span>
                                            @if(Auth::check())
                                                <form class="send_comment" method="post" action="{{route('comment_product_store')}}">
                                                    @csrf
                                                    <p class="comment-notes">
                                                    <span id="email-notes">آدرس ایمیل شما منتشر نخواهد شد. </span>
                                                    قسمت های مورد نیاز علامت گذاری شده است
                                                    <span class="required">*</span>
                                                </p>

                                                <div class="input-element">
                                                    <div class="comment-form-comment">
                                                        <label>اظهار نظر</label>
                                                        <textarea name="content" cols="40" rows="8"></textarea>
                                                        <input name="pro" type="hidden" value="{{$product->id}}">
                                                    </div>

                                                    <div class="comment-submit">
                                                        <button type="submit" class="form-button">ارسال</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                                برای ثبت نظر
                                                <a href="/login"> وارد شوید</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Review And Description Tab Content End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Product Description Review Section Start-->

    <!--Product section start-->
    <div class="product-section section sb-border pt-75 pt-lg-55 pt-md-45 pt-sm-35 pt-xs-25 pb-55 pb-lg-35 pb-md-25 pb-sm-15 pb-xs-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-40 pt-20">
                        <h1>محصولات مرتبط</h1>
                    </div>
                </div>
            </div>
            <div class="row product-slider-two">
                @foreach($like_products as $item)
                    <div class="col-lg-12">
                        <!--  Single Grid product Start -->
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
                        <!--  Single Grid product End -->
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!--Product section end-->


@endsection

@section('script')
    @if(session('save_comment'))
        <script>
            alertify.set('notifier','position', 'bottom-left');
            alertify.success('نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        </script>
    @endif
    <script>
        view({{$product->id}})
        function view(id) {
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('view.set_view_product')}}';
            var data = {_token: CSRF_TOKEN,id:id};
            $.post(url, data, function (msg) {
            });
        }
    </script>
@endsection

@php
    Session::forget('save_comment');
@endphp
