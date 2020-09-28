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
        .descr-tab-content div,.descr-tab-content span,.descr-tab-content p,.descr-tab-content h3,.descr-tab-content h1,.descr-tab-content h4,.descr-tab-content h5,.descr-tab-content h6,.descr-tab-content h2{
            font-family: "IRANSans";
        }
        .recently-added-carousel .price{
            direction: rtl!important;
        }
    </style>
@endsection
@section('content')
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">جزئیات محصول</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">خانه</a></li>
                                <li>جزئیات محصول</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- product details content area  start -->
    <div class="product-details-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">


                    <div class="left-content-area" style="direction: ltr"><!-- left content area -->
                        <div class="product-details-slider" id="product-details-slider" data-slider-id="1">
                            <?php $i=1;?>
                            @foreach($images as $image)
                            <div class="single-product-thumb">
                                <img src="{{asset($image->path)}}" alt="product details image">
                            </div>
                                    <?php $i++;?>
                                @endforeach
                        </div>

                        <ul class="owl-thumbs product-deails-thumb" data-slider-id="1">
                            <?php $i=1;?>
                            @foreach($images as $image)
                            <li class="owl-thumb-item @if($i==1) active @endif">
                                <img style="width: 160px" src="{{asset($image->path)}}" alt="product details thumb">
                            </li>
                                    <?php $i++;?>
                                @endforeach
                        </ul>
                    </div><!-- //.left content area -->
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area"><!-- right content area -->
                        <div class="top-content">
                            <ul class="review">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star-half-alt"></i></li>
                                <li><i class="far fa-star"></i></li>
                                <li class="reviewes">{{$product->view}} <small>بازدید</small> </li>
                            </ul>
                            <span class="orders">سفارش ({{$product->sale}}+)</span>
                        </div>
                        <div class="bottom-content">
                            @foreach ($product->categories as $category)
                                <span class="cat">/ {{$category->title}}  </span>
                            @endforeach

                            <h3 class="title" style="font-size: 25px">{{$product->title}}</h3>
                            <div class="price-area">
                                @if($product->discount>0)
                                <div class="left">
                                    <span class="sprice">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                    <span class="dprice"><del>{{number_format($product->price)}} تومان</del></span>
                                </div>
                                @else
                                    <div class="left">
                                        <span class="sprice">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                    </div>
                                @endif
                            </div>
                            <ul class="product-spec">
                                <li>کد محصول: <span class="right">{{$product->id}}</span></li>
                                @if($product->depot>0)
                                <li>موجود:  <span class="right base-color">موجود است </span></li>
                                @else
                                    <li>موجود:  <span class="right base-color">ناموجود  </span></li>
                                @endif
                            </ul>
                            <div class="pdescription">
                                <h4 class="title">بررسی اجمالی</h4>
                                <p>{{str_limit($product->excerpt,450)}}</p>
                            </div>
                            <div class="paction">

                                <ul class="activities">
                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                    <li><a onclick="favorite(this,{{$product->id}})"><i class="fas fa-heart"></i></a></li>
                                    @else
                                    <li><a style="color: red" onclick="favorite(this,{{$product->id}})" ><i class="fas fa-heart"></i></a></li>
                                    @endif
                                </ul>
                                <div class="btn-wrapper">
                                    @if($product->depot>0)
                                    <a style="color:#fff;" class="boxed-btn" onclick="addcart(this,'{{$product->id}}')">افزودن به سبد</a>
                                    @else
                                    <a style="color:#fff;" class="boxed-btn">ناموجود</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- //. right content area -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-area">
                        <div class="product-details-tab-nav">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="item-review-tab" data-toggle="tab" href="#item_review" role="tab" aria-controls="item_review" aria-selected="true">بررسی</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="descr-tab" data-toggle="tab" href="#descr" role="tab" aria-controls="descr" aria-selected="false">توضیحات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="method-tab" data-toggle="tab" href="#method" role="tab" aria-controls="method" aria-selected="false"> نظرات</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" >
                            <div class="tab-pane fade show active" id="item_review" role="tabpanel" aria-labelledby="item-review-tab">
                                <div class="item_review_content">
                                    <h4 class="title">مشخصات فنی</h4>
                                    <ul class="product-specification"><!-- product specification -->
                                        @foreach($featurs as $featur)
                                        <li>
                                            <div class="single-spec"><!-- single specification -->
                                                <span class="heading">{{$featur->title}}</span>
                                                <span class="details">{{$featur->content}}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul><!-- //.product specification -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="descr" role="tabpanel" aria-labelledby="descr-tab">
                                <div class="descr-tab-content">
                                    <h4 class="title">توضیحات محصول</h4>
                                    <p class="text"> <?= $product->content ?></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="method" role="tabpanel" aria-labelledby="method-tab">
                                <div class="comments-area"><!-- comments area satart -->
                                    <h3 class="title">نظرات</h3>
                                    @foreach($comments as $comment)
                                    <div class="single-comment-item margin-bottom-40"><!-- single comment item -->
                                        <div class="thumb">
                                            <img src="{{asset('bigenja/img/comments/01.png')}}" alt="commente avatar">
                                        </div>
                                        <div class="content">
                                            <span class="meta-date">{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</span>
                                            <h4 class="author-name">{{$comment->user->name}}</h4>
                                            <p>{{$comment->content}}</p>
                                        </div>
                                        @php $comments_ansswers=App\Comment::where('parent',$comment->id)->get() @endphp
                                        @foreach($comments_ansswers as $comments_ansswer)
                                        <div style="margin-right: 50px;margin-top: 15px" class="single-comment-item margin-bottom-40"><!-- single comment item -->
                                            <div class="thumb">
                                                <img src="{{asset('bigenja/img/comments/01.png')}}" alt="commente avatar">
                                            </div>
                                            <div class="content">
                                                <span class="meta-date">{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span>
                                                <h4 class="author-name">مدبر</h4>
                                                <p>{{$comments_ansswer->content}}</p>
                                            </div>

                                        </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                        <!-- //. single comment item -->
                                </div><!-- //. comments area end -->
                                <div class="single-blog-page-separator"></div>
                                <div class="comments-form-area"><!-- comments form area -->
                                    <h3 class="title">ارسال نظر</h3>
                                    <div class="comment-form-wrapper"><!-- comment form wrapper -->
                                        @if(Auth::check())
                                        <form class="send_comment" method="post" action="{{route('comment_product_store')}}">
                                            @csrf
                                            <div class="form-element margin-bottom-15">
                                                <div class="has-icon textarea">
                                                    <textarea name="content" rows="20" cols="8" placeholder="نظرات خود را تایپ کنید...." class="input-field borderd textarea"></textarea>
                                                    <input name="pro" type="hidden" value="{{$product->id}}">
                                                    <div class="the-icon">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-element margin-bottom-20">
                                                <div class="has-icon ">
                                                    <input name="title" type="text" class="input-field borderd" placeholder="عنوان خود را بنویسید....">
                                                    <div class="the-icon">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-element margin-top-40">
                                                <input type="submit" value="ارسال نظر" class="submit-btn btn-rounded">
                                            </div>
                                        </form>
                                        @else
                                            برای ثبت نظر
                                            <a href="/login"> وارد شوید</a>
                                        @endif
                                    </div>
                                </div><!-- comments form area -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details content area end -->
    <!-- recently added start -->
    <div class="recently-added-area product-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="recently-added-nav-menu"><!-- recently added nav menu -->
                        <ul>
                            <li>محصولات مشابه</li>
                        </ul>
                    </div><!-- //.recently added nav menu -->
                </div>
                <div class="col-lg-12">
                    <div class="recently-added-carousel" id="recently-added-carousel"><!-- recently added carousel -->
                        @foreach($like_products as $item)
                        <div class="single-new-collection-item">
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
                               <a href="/product/{{$item->slug}}">
                                   <h4 class="title">{{str_limit($item->title,37)}}</h4>
                               </a>
                                @if($item->discount>0)
                                <div class="price"><span class="sprice">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <del class="dprice">{{number_format($item->price)}} تومان</del></div>
                                @else
                                <div class="price"><span class="sprice"> {{number_format($item->price)}} <span>تومان</span></span></div>
                                @endif
                            </div>
                        </div>
                            @endforeach
                    </div><!-- //. recently added carousel -->
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script_link')
    <script src="{{{asset('bigenja/js/jquery.js')}}}"></script>
    <script src="{{asset('bigenja/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('bigenja/js/isotope.pkgd.min.js')}}"></script>
    <!-- countdown -->
    <script src="{{asset('bigenja/js/countdown.js')}}"></script>
    <script src="{{asset('bigenja/js/owl.carousel2.thumbs.js')}}"></script>

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
