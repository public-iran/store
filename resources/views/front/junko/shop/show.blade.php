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
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">خانه</a></li>
                            <li>جزئیات محصول {{$product->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product details start-->
    <div class="product_details mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a >
                                <img id="zoom1" src="{{asset($product->image)}}" data-zoom-image="{{asset($product->image)}}" alt="big-1">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                <?php $i=1;?>
                                @foreach($images as $image)
                                <li>
                                    <a href="#" class="elevatezoom-gallery @if($i==1)active @endif" data-update="" data-image="{{asset($image->path)}}" data-zoom-image="{{asset($image->path)}}">
                                        <img src="{{asset($image->path)}}" alt="عکس {{$i}}">
                                    </a>

                                </li>
                                        <?php $i++;?>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">

                            <h1>{{$product->title}}</h1>

                          {{--  <div class=" product_ratting">
                                <ul>
                                    <li><span><i class="fa fa-star"></i></span></li>
                                    <li><span><i class="fa fa-star"></i></span></li>
                                    <li><span><i class="fa fa-star"></i></span></li>
                                    <li><span><i class="fa fa-star"></i></span></li>
                                    <li><span><i class="fa fa-star"></i></span></li>
                                    <li class="review"><a href="#"> (امتیاز مشتریان) </a></li>
                                </ul>

                            </div>--}}
                            <div class="price_box">
                                @if($product->discount>0)
                                    <span class="old_price">{{number_format($product->price)}} تومان</span>
                                    <span class="current_price">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                @else
                                    <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($product->price)}} تومان</span>
                                @endif

                            </div>
                            <div class="product_desc">
                                <p>{{str_limit($product->excerpt,450)}}</p>
                            </div>
                           {{-- <div class="product_variant color">
                                <h3>گزینه های در دسترس</h3>
                                <label>رنگ</label>
                                <ul>
                                    <li class="color1">
                                        <a href="#"></a>
                                    </li>
                                    <li class="color2">
                                        <a href="#"></a>
                                    </li>
                                    <li class="color3">
                                        <a href="#"></a>
                                    </li>
                                    <li class="color4">
                                        <a href="#"></a>
                                    </li>
                                </ul>
                            </div>--}}
                            <div class="product_variant quantity">
                               {{-- <label>تعداد</label>
                                <input min="1" max="100" value="1" type="number">--}}
                                @if($product->depot>0)
                                <button onclick="addcart(this,'{{$product->id}}')" class="button">افزودن به سبد</button>
                                @else
                                    <button class="button" type="submit">ناموجود</button>
                                @endif
                            </div>
                            <div class=" product_d_action">
                                <ul>

                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                    <li><a onclick="favorite(this,{{$product->id}})" title="افزودن به علاقه‌مندی‌ها">+ افزودن به علاقه‌مندی‌ها</a></li>
                                    @else
                                        <li><a style="color: red" onclick="favorite(this,{{$product->id}})" title="حذف از علاقه‌مندی‌ها">+ حذف از علاقه‌مندی‌ها</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="product_meta">
                                <span>دسته: @foreach ($product->categories as $category)
                                        <a href="/shop?cat={{$category->slug}}">{{$category->title}}</a> ،
                                    @endforeach</span>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info mb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">توضیحات</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false" title="مشخصات فنی">مشخصات فنی</a>
                                </li>
                                @if(@$product->video)
                                <li>
                                    <a data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">ویدیو محصول</a>
                                </li>
                                @endif
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">نقد و برررسی ({{count($comments)}})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="product_info_content">
                                    <p class="text"> <?= $product->content ?></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sheet" role="tabpanel">
                                <div class="product_d_table">
                                    <form action="#">
                                        <table>
                                            <tbody>
                                            @foreach($featurs as $featur)
                                                <tr>
                                                    <td>{{$featur->title}}</td>
                                                    <td>{{$featur->content}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="video" role="tabpanel">
                                <video width="100%" height="240" controls>
                                    <source src="{{asset($product->video)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="reviews_wrapper">
                                    <h2>{{count($comments)}} نقد و بررسی برای این محصول</h2>
                                    @foreach($comments as $comment)
                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="{{asset('junko/img/blog/comment2.jpg')}}" alt="">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <p><strong>{{$comment->user->name}} </strong>{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</p>
                                            </div>
                                            <p>{{$comment->content}}</p>
                                        </div>

                                    </div>
                                        @php $comments_ansswers=App\Comment::where('parent',$comment->id)->get(); @endphp
                                        @foreach($comments_ansswers as $comments_ansswer)
                                        <div class="comment_list list_two">
                                            <div class="comment_thumb">
                                                <img src="{{asset('junko/img/blog/comment3.png.jpg')}}" alt="{{$comments_ansswer->content}}">
                                            </div>
                                            <div class="comment_content">
                                                <div class="comment_meta">
                                                    <h5><a>مدیر</a></h5>
                                                    <span>{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span>
                                                </div>
                                                <p>{{$comments_ansswer->content}}</p>

                                            </div>
                                        </div>
                                        @endforeach
                                    @endforeach
                                    <div class="comment_title">
                                        <h2>یک نقد و بررسی بنویسید </h2>
                                        <p>ایمیل شما منتشر نخواهد شد. فیلد های الزامی مشخص شده اند </p>
                                    </div>
                                    <div class="product_review_form">
                                        @if(Auth::check())
                                        <form  method="post" action="{{route('comment_product_store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="review_comment">نقد و بررسی شما </label>
                                                    <textarea name="content" id="review_comment"></textarea>
                                                </div>
                                                <input name="pro" type="hidden" value="{{$product->id}}">
                                            </div>
                                            <button type="submit">ثبت</button>
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
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    <section class="product_area related_products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>محصولات مرتبط	</h2>
                    </div>
                </div>
            </div>
            <div class="product_carousel product_column5 owl-carousel">
                @foreach($like_products as $item)
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
                                {{-- <div class="product_timing">
                                     <div data-countdown="2043/12/15"></div>
                                 </div>--}}
                            </div>
                            <figcaption class="product_content">
                                <div class="price_box">
                                    @if($item->discount>0)
                                        <span class="old_price">{{number_format($item->price)}} تومان</span>
                                        <span class="current_price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                    @else
                                        <span style="height: 53px;line-height: 53px;" class="current_price">{{number_format($item->price)}} تومان</span>
                                    @endif
                                </div>
                                <h3 class="product_name"><a href="/product/{{$item->slug}}">{{str_limit($item->title,70)}}</a></h3>
                            </figcaption>
                        </figure>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <!--product area end-->





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
