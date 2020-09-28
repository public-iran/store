@extends('front'.theme_name().'layout.master')
@section('content')
    <style>
        .product--card2 .product-desc {
            height: auto;
        }
        .notcomment_title h3{
            font-size: 18px;
            padding: 20px;
            color: #5048e6;
            text-align: center;
            border: 1px solid #5048e6;
            border-radius: 50px;
        }
        .notcomment_title {
            width: 80%;
            margin: 0 auto;
        }
        .product-purchase .sell span {
            padding: 0 5px;
            cursor: pointer;
        }
        .item-info .tab-content {
            margin-top: 12px;
        }

    </style>
    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="#">خانه</a>
                            </li>
                            <li>
                                <a href="#">محصولات</a>
                            </li>
                            <li class="active">
                                <a href="#">{{$product->title}}</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{$product->title}}</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->



    <!--============================================
    START SINGLE PRODUCT DESCRIPTION AREA
==============================================-->
    <section class="single-product-desc dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="item-preview">
                        <div class="item__preview-slider">
                            @foreach($images as $image)
                                <div class="prev-slide">
                                    <img src="{{asset($image->path)}}" alt="{{$product->title}}">
                                </div>
                            @endforeach
                        </div>
                        <!-- end /.item--preview-slider -->

                        <div class="item__preview-thumb">
                            <div class="prev-thumb">
                                <div class="thumb-slider">
                                    @foreach($images as $image)
                                        <div class="item-thumb">
                                            <img src="{{asset($image->path)}}" alt="{{$product->title}}">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- end /.thumb-slider -->

                                <div class="prev-nav thumb-nav">
                                    <span class="lnr nav-right lnr-arrow-right"></span>

                                    <span class="lnr nav-left lnr-arrow-left"></span>
                                </div>
                                <!-- end /.prev-nav -->
                            </div>

                            <div class="item-action">
                                <div class="action-btns">
                                    <a href="#" class="btn btn--round btn--lg">مشاهده</a>
                                    {{--                                    <a href="#" class="btn btn--round btn--lg btn--icon">--}}
                                    {{--                                        <span class="lnr lnr-heart"></span>افزودن به علاقه مندی ها --}}
                                    {{--                                    </a>--}}

                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                        <button type="button" class="wishlist btn btn--round btn--lg btn--icon" onclick="favorite(this,{{$product->id}})"><span class="lnr lnr-heart"></span> افزودن به علاقه مندی ها</button>
                                    @else
                                        <button type="button" class="wishlist btn btn--round btn--lg btn--icon bg-cyan" onclick="favorite(this,{{$product->id}})"><span class="lnr lnr-heart"></span>به علاقه مندی های شما اضافه شد</button>
                                    @endif


                                </div>
                            </div>
                            <!-- end /.item__action -->
                        </div>
                        <!-- end /.item__preview-thumb-->


                    </div>
                    <!-- end /.item-preview-->

                    <div class="item-info">
                        <div class="item-navigation">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">جزئیات</a>
                                </li>
                                <li>
                                    <a href="#product-faq" aria-controls="product-faq" role="tab" data-toggle="tab">مشخصات فنی </a>
                                </li>
                                <li>
                                    <a href="#product-comment" aria-controls="product-comment" role="tab" data-toggle="tab">نظرات </a>
                                </li>
                                <li>
                                    <a href="#product-support" aria-controls="product-support" role="tab" data-toggle="tab">ارسال نظر</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.item-navigation -->

                        <div class="tab-content">


                            <div class="fade show tab-pane product-tab active" id="product-details">
                                <div class="tab-content-wrapper">دسته :
                                    @foreach ($product->categories as $category)
                                        <a href="" class="label label-primary text-primary">{{$category->title}} / </a>
                                    @endforeach
                                    <hr>
                                    <?= $product->content ?>
                                </div>
                            </div>
                            <!-- end /.tab-content -->

                            <div class="fade tab-pane product-tab" id="product-faq">
                                <div class="tab-content-wrapper">
                                    <div class="panel-group accordion" role="tablist" id="accordion">
                                        <table class="table table-striped table-bordered">
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
                                    <!-- end /.accordion -->
                                </div>

                            </div>
                            <!-- end /.product-faq -->

                            <div class="fade tab-pane product-tab" id="product-comment">


                                <div class="thread">
                                    @if(count($comments) === 0)
                                        <div class="notcomment_title">
                                            <h3>هنوز نظری برای این محصول ثبت نشده است.</h3>
                                        </div>

                                    @else

                                        <ul class="media-list thread-list">
                                            @foreach($comments as $commentItem)
                                                <?php $user = App\User::findorfail($commentItem->user_id); ?>
                                                @if($commentItem->parent == 0)
                                                    <li class="single-thread">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                @if($user->avatar!="")
                                                                    <img width="50px" src="{{asset($user->avatar)}}" alt="{{$user->name}}" class="media-object" />
                                                                @else
                                                                    <img class="media-object" src="{{asset('images/profile.jpg')}}" alt="عکس پروفایل" />
                                                                @endif

                                                            </div>
                                                            <div class="media-body">
                                                                <div>
                                                                    <div class="media-heading">
                                                                        <a href="author.html">
                                                                            <h4>{{$commentItem->user->name}}</h4>
                                                                        </a>
                                                                        <span>{{Verta::instance($commentItem->created_at)->format(' %d %B %Y')}}</span>
                                                                    </div>
                                                                    @if($user->role == 1)
                                                                        <span class="comment-tag buyer">مدیر سایت</span>
                                                                        {{--                                                            <a href="#" class="reply-link">پاسخ </a>--}}
                                                                    @endif
                                                                </div>
                                                                {{$commentItem->content}}
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                            @endif
                                        </ul>
                                        <!-- end /.media-list -->
                                        <div class="pagination-area pagination-area2">
                                            {{$comments->links('vendor.pagination.default')}}
                                        </div>

                                </div>
                                <!-- end /.comments -->
                            </div>
                            <!-- end /.product-comment -->

                            <div class="fade tab-pane product-tab" id="product-support">
                                <div class="support">
                                    @if(count($comments) === 0)
                                        <div class="support__title">
                                            <h3>اولین نفری باشید که نظر خود را ثبت میکند!</h3>
                                        </div>
                                    @endif

                                    <div class="support__form">
                                        <div class="usr-msg">
                                            @if(Auth::check())
                                                <form class="send_comment" method="post" action="{{route('comment_product_store')}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="subj">موضوع:</label>
                                                        <input type="text" id="subj" class="text_field" placeholder="موضوع خود را وارد کنید " name="title">
                                                        <input name="pro" type="hidden" value="{{$product->id}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="supmsg">متن : </label>
                                                        <textarea class="text_field" id="supmsg" name="supmsg" placeholder="متن خود را وارد کنید ..."></textarea>
                                                    </div>

                                                    <div class="form-group required">
                                                        <div class="col-sm-12">
                                                            <label class="control-label">رتبه</label>
                                                            &nbsp;&nbsp;&nbsp; بد&nbsp;
                                                            <input type="radio" value="1" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="2" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="3" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="4" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="5" name="rating">
                                                            &nbsp;خوب</div>
                                                    </div>

                                                    <button type="submit" class="btn btn--lg btn--round">ارسال </button>
                                                </form>

                                            @else
                                                <p>لطفا برای ارسال نظر
                                                    <a target="_blank" href="/login">وارد </a>شوید.</p>

                                            @endif
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <!-- end /.product-support -->

                        </div>
                        <!-- end /.tab-content -->
                    </div>
                    <!-- end /.item-info -->
                </div>
                <!-- end /.col-md-8 -->

                <div class="col-lg-4">
                    <aside class="sidebar sidebar--single-product">
                        <div class="sidebar-card card-pricing">
                            <div class="price">
                                <h3>
                                    @if($product->depot>0)
                                        موجودی :
                                        <span style="color: #00d500">{{$product->depot.' '.$product->unit}}</span>
                                    @else
                                        <span style="color: red">اتمام موجودی</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="price">
                                <h3>
                                    @if($product->discount>0)
                                        <sup class="price-old" style="color: red;text-decoration: line-through">{{number_format($product->price)}} تومان</sup> <br><span itemprop="price" style="color: #00d500">{{number_format($product->price-($product->price*$product->discount/100))}} تومان<span itemprop="availability" content="موجود"></span></span>
                                    @else
                                        <span itemprop="price" style="color: #00d500">{{number_format($product->price)}} تومان <span itemprop="availability" content="موجود"></span></span>
                                    @endif
                                </h3>
                            </div>
                            @if(!empty($product->discount))
                                <div class="price">
                                    <h3>
                                        <span class="price-old" style="color: #00d500;"> تخفیف {{$product->discount}} درصد </span>
                                    </h3>
                                </div>
                            @endif
                            @if($product->depot != 0)
                                <div class="purchase-button">
                                    <a href="/cart" class="btn btn--lg btn--round">هم اکنون بخرید</a>
                                    <button onclick="addcart(this,'{{$product->id}}')" type="button" class="btn btn--lg btn--round cart-btn">
                                        <span class="lnr lnr-cart"></span>
                                        افزودن به سبد خرید
                                    </button>
                                </div>
                            @endif

                        <!-- end /.purchase-button -->
                        </div>
                        <!-- end /.sidebar--card -->

                    </aside>
                    <!-- end /.aside -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->

    <!--============================================
        START MORE PRODUCT ARE
    ==============================================-->
    <section class="more_product_area section--padding dir-rtl">
        <div class="container">
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>محصولات بیشتر از
                            <span class="highlighted"> از این دسته </span>
                        </h1>
                    </div>
                </div>
                <!-- end /.col-md-12 -->

                @foreach($like_products as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="product product--card product--card2">

                            <div class="product__thumbnail">
                                <img style="max-height: 270px;" src="{{asset($item->image)}}" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="/product/{{$item->slug}}" class="transparent btn--sm btn--round">اطلاعات بیشتر </a>
                                    <a href="/product/{{$item->slug}}" class="transparent btn--sm btn--round">مشاهده </a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="#" class="product_title">
                                    <h4>{{str_limit($item->title,100)}}</h4>
                                </a>

                                {{str_limit($item->excerpt,120)}}
                            </div>
                            <!-- end /.product-desc -->

                            <ul class="titlebtm">
                                <li class="product_cat">
                                    @foreach ($item->categories as $category)

                                        <a href="#">
                                            <span style="font-size: 12px">{{$category->title}} /</span>
                                        </a>
                                    @endforeach
                                </li>
                            </ul>

                            <div class="product-purchase">
                                <div class="price_love">
                                    @if($item->discount>0)
                                        <span>
                                <span
                                    style="text-decoration: line-through;">{{number_format($item->price)}} تومان </span>
                                <span>{{number_format($item->price*(100-$item->discount)/100)}} تومان </span>
                                </span>
                                    @else
                                        <span>{{number_format($item->price)}} تومان </span>
                                    @endif
                                </div>
                                <div class="sell">
                                    @php
                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                    @endphp
                                    @if(empty($favorite))
                                        <span class="lnr lnr-heart" onclick="favorite(this,{{$item->id}})"
                                              title="افزودن به لیست علاقه مندی"></span>
                                    @else
                                        <span style="color: red" class="lnr lnr-heart"
                                              onclick="favorite(this,{{$item->id}})"
                                              title="افزودن به لیست علاقه مندی"></span>
                                    @endif
                                    <span class="lnr lnr-cart" title="افزودن به سبد"></span>
                                </div>
                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.container -->
    </section>
    <!--============================================
        END MORE PRODUCT AREA
    ==============================================-->

@endsection

