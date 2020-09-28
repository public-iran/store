
@extends('front'.theme_name().'layout.master')
@section('style')
    <style>
        .hero__categories ul{
            height: 453px;
            overflow-y: auto;
        }
        @media (max-width: 991px){
            .hero__categories ul{
                height: 220px;
            }
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
        .product__details__pic__item{
            height: 470px;
        }
        .product__details__pic__item img{
            height: 100%;
        }
        .product__details__text{
            text-align: right;
        }
        .pro-qty input{
            padding-right: 0;
        }
        .tab-pane{
            text-align: right;
        }
        .product__details__tab .nav-tabs li{
            margin-left: 60px;
            margin-right: 0;
        }
        .product__details__tab .nav-tabs:before{
            width: 420px;
        }
        .send_comment .name{
            padding-right: 0!important;
        }
        .send_comment .email{
            padding-left: 0!important;
        }
        .send_comment .name input,.send_comment .email input{
            width: 100%;
        }
        .btn-send-comment{
            float: left;
            background: #7fad39;
            padding: 10px 20px;
            color: #fff;
        }
        .product__discount__percent {
            height: 45px;
            width: 45px;
            background: #dd2222;
            border-radius: 50%;
            font-size: 14px;
            color: #ffffff;
            line-height: 45px;
            text-align: center;
            position: absolute;
            left: -60px;
            top: -20px;
        }

        @media (max-width: 411px){
            .product__details__pic__item {
                height: 380px;
            }
            .featured__item .set-bg {
                background-size: 56% 100%;
            }
            .product__details__tab .nav-tabs li{
                margin-left: 25px;
            }
        }
        @media (max-width: 767px) {
            .send_comment .name{
                padding-left: 0;
            }
            .send_comment .email{
                padding-right: 0;
                margin-top: 1rem;
            }
        }

        ul{
            list-style: none;
        }
        .comments-header {
            background: #eee;
            font-size: 13px;
            color: #555;
            padding: 4px 10px;
        }
        .comments-body{
            background: #eeeeee69;
            font-size: 15px;
        }
        .comments-body > div p{
            padding-top: 5px;
            padding-right: 17px;
            font-size: 15px;
        }
        .comments-answer{

        }
        .comments-answer-header{
            background: #eee;
            font-size: 13px;
            color: #555;
            padding: 4px 30px;

        }
        .comments-answer-body{
            background: #eeeeee69;
            font-size: 15px;
            padding: 4px 35px;
        }
    </style>
@endsection
@section('content')

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                 src="{{asset($product->image)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach($images as $image)
                            <img data-imgbigurl="{{asset($image->path)}}"
                                 src="{{asset($image->path)}}" alt="{{$image->name}}">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h1 style="font-size: 20px;font-weight: 700">{{$product->title}}</h1>
                        <div class="product__details__rating">
                            {{--<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>--}}
                            <span>({{$product->view}} بازدید)</span>
                        </div>
                        @if($product->discount>0)
                            <span style="text-decoration: line-through;position: relative">{{number_format($product->price)}} تومان
                           <div class="product__discount__percent">-{{$product->discount}}%</div>
                            </span>
                            <div class="product__details__price">{{number_format(($product->price*(100-$product->discount)/100))}} تومان </div>
                        @else
                            <div class="product__details__price">{{number_format($product->price)}} تومان </div>
                            @endif
                        <p>{{str_limit($product->excerpt,350)}}</p>

                        @if($product->depot>0)
                        <a  onclick="addcart(this,'{{$product->id}}')" class="primary-btn">افزودن به سبد</a>
                        @else
                        <a class="primary-btn"> ناموجود </a>
                        @endif
                        @php
                            $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                        @endphp
                        @if(empty($favorite))
                        <a  onclick="favorite(this,{{$product->id}})" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        @else
                            <a style="color: red" onclick="favorite(this,{{$product->id}})" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                   aria-selected="true">توضیحات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                   aria-selected="false">امکانات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                   aria-selected="false">نظرات<span></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>توضیحات در مورد محصول</h6>
                                    <p><?= $product->content ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>امکانات</h6>
                                    @foreach($featurs as $featur)
                                        <div class="row" style="margin-bottom: 30px">
                                            <div class="col-lg-3 col-xs-12">
                                                <div class="card" style="background: #f9f9f9;">
                                                    <div class="card-body" style="padding: 8px 10px;">
                                                        {{$featur->title}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-xs-12">
                                                <div class="card">
                                                    <div class="card-body" style="padding: 8px 10px;">
                                                        {{$featur->content}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>نظر خود را ثبت کنید</h6>
                                    <div class="comment-form">
                                        @if(Auth::check())
                                            <form class="send_comment" method="post" action="{{route('comment_product_store')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="title" id="subject" placeholder="عنوان نظر" onfocus="this.placeholder = ''" onblur="this.placeholder = 'عنوان نظر'">
                                                    <input name="pro" type="hidden" value="{{$product->id}}">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control mb-10" rows="5" name="content" placeholder="نظر خود را وارد کنید" onfocus="this.placeholder = ''" onblur="this.placeholder = 'نظر خود را وارد کنید'" required=""></textarea>
                                                </div>
                                                <button type="submit" style="border: none" class="button button-postComment button--active btn-send-comment">ارسال نظر</button>
                                            </form>
                                        @else
                                            برای ثبت نظر
                                            <a href="/login"> وارد شوید</a>
                                        @endif


                                    </div>
                                </div>

                                <div style="width: 100%;float: right">
                                    <hr class="col-xs-12">
                                    @if(count($comments) === 0)
                                        <ul class="list-unstyled">
                                            <li>
                                                اولین نفری باشید که نظر خود را ثبت میکند!
                                            </li>
                                            <li>

                                            </li>
                                        </ul>

                                    @else
                                        @foreach($comments as $commentItem)
                                            @if($commentItem->parent == 0)
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <ul class="ali-comment-box">

                                                            <li class="ali-cmt-answer-padding comments-header">
                                                                توسط
                                                                <strong><span> {{$commentItem->user->name}} </span></strong>در
                                                                <span style="font-size: 12px">{{Verta::instance($commentItem->created_at)->format(' %d %B %Y')}}</span>
                                                            </li>
                                                            <li class="ali-cmt-answer-padding comments-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p>
                                                                            {{$commentItem->content}}
                                                                        </p>
                                                                    </div>
                                                                    {{--     <div class="col-lg-2">
                                                                             @if(auth()->user())
                                                                                 <a class="ali-btn-answer btn-primary"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModal"
                                                                                    onclick="setparentid('{{$commentItem->id}}')"
                                                                                                                                                   onclick="addParentId({{$commentItem->id}})"
                                                                                    data-whatever="@mdo">
                                                                                     پاسخ
                                                                                 </a>
                                                                             @endif
                                                                         </div>--}}
                                                                </div>
                                                            </li>

                                                            {{--                                                                                                            answer comment--}}
                                                            @foreach($comments as $commentItemAnswer)
                                                                @if( $commentItem->id == $commentItemAnswer->parent)
                                                                    <div class="ali-cmt-answer-box comments-answer" >
                                                                        <li class="ali-cmt-answer-padding comments-answer-header">
                                                                            <span style="color: #61c579">پاسخ</span> توسط
                                                                            <strong><span> مدیر </span></strong>در
                                                                            <span style="font-size: 12px">{{Verta::instance($commentItem->created_at)->format(' %d %B %Y')}}</span>
                                                                        </li>
                                                                        <li class="ali-cmt-answer-padding comments-answer-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <p>
                                                                                        {{$commentItemAnswer->content}}
                                                                                    </p>
                                                                                </div>

                                                                            </div>
                                                                        </li>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>محصولات مرتبط</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($like_products as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{asset($item->image)}}">
                                @if($item->discount!=0)
                                    <div style="left: 1px;top: 1px;" class="product__discount__percent">-{{$item->discount}}%</div>
                                @endif
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a onclick="addcart(this,'{{$item->id}}')"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="/product/{{$item->slug}}">{{str_limit($item->title,50)}}</a></h6>
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
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection

@section('script_link')

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
