@extends('front'.theme_name().'layout.master')
@section('style')
    <style>
        .hero__categories > ul{
            height: 453px;

        }
        @media (max-width: 991px){
            .hero__categories > ul{
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
        .latest-product__item{
            position: relative;
        }
        @media (max-width: 411px){
            .featured__item__pic {
                height: 225px;
            }
        }
        .nav-link[data-toggle].collapsed:before {
            content: " ▾";
        }
        .nav-link[data-toggle]:not(.collapsed):before {
            content: " ▴";
        }
        .list-unstyled{

            padding-right: 10px!important;
            overflow-y: auto;
        }

    </style>
@endsection
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>همه بخش ها</span>
                        </div>
                            <ul class="list-unstyled ">
                                @foreach($categories as $category)
                                    <li class="">
                                        @php
                                            $categories2=App\Category::where('parent',$category->id)->get();
                                        @endphp
                                        <a @if(count($categories2))href="#homeSubmenu{{$category->id}}" data-toggle="collapse" aria-expanded="false" ondblclick="header('{{'shop?cat='.$category->slug}}')" @else href="{{'shop?cat='.$category->slug}}" @endif class="@if(count($categories2)) dropdown-toggle @endif ">{{$category->title}} </a>
                                        <ul class="collapse" id="homeSubmenu{{$category->id}}">

                                            @foreach($categories2 as $category2)
                                                @php
                                                    $categories3=App\Category::where('parent',$category2->id)->get();
                                                @endphp
                                                <a @if(count($categories3))href="#homeSubmenu{{$category2->id}}" data-toggle="collapse" aria-expanded="false" ondblclick="header('{{'shop?cat='.$category2->slug}}')" @else href="{{'shop?cat='.$category2->slug}}" @endif class="@if(count($categories3)) dropdown-toggle @endif">{{$category2->title}} </a>
                                                <ul class="collapse" id="homeSubmenu{{$category2->id}}">

                                                    @foreach($categories3 as $category2)
                                                        <li>
                                                            <a href="{{'shop?cat='.$category2->slug}}" class="category_click" onclick="">{{$category2->title}} </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>


                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input name="search" onkeyup="search_header()" type="text" placeholder="به چه چیزی نیاز دارید؟">
                                <button type="submit" class="site-btn">جستوجو</button>
                            </form>
                        </div>
                        <div class="result-search">

                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{@$setting['tell']}}</h5>
                                <span>با پشتیبانی 7/24</span>
                            </div>
                        </div>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @php $i=0; @endphp
                            @foreach($sliders as $slider)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="@if($i==0)active @endif"></li>
                                @php $i++; @endphp
                            @endforeach
                        </ol>
                        <div class="carousel-inner" style="height: 420px">

                            @php $i=0; @endphp
                            @foreach($sliders as $slider)

                                    <div class="carousel-item @if($i==0)active @endif">
                                        <a  @if($slider->linl!="")href="{{$slider->link}}" @endif>
                                        <img class="d-block w-100" src="{{asset($slider->imgPath)}}" alt="{{$slider->imgName}}">
                                        </a>
                                    </div>


                                @php $i++; @endphp
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($categories_image as $cat_img)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset($cat_img->imgPath)}}">
                          {{--  <h5><a href="{{$cat_img->slug}}">{{$cat_img->title}}</a></h5>--}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
@if(count($spacial_product))
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>محصولات پیشنهادی</h2>
                    </div>

                </div>
            </div>
            <div class="row featured__filter">
                @foreach($spacial_product as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset($item->image)}}">
                            @if($item->discount>0)
                                <div class="product__discount__percent">-{{$item->discount}}%</div>
                            @endif
                            <ul class="featured__item__pic__hover">
                                @php
                                $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                @endphp
                                @if(empty($favorite))
                                <li><a onclick="favorite(this,{{$item->id}})"><i class="fa fa-heart"></i></a></li>
                                @else
                                    <li><a style="color: red" onclick="favorite(this,{{$item->id}})"><i class="fa fa-heart"></i></a></li>
                                @endif
                                <li><a href="/product/{{$item->slug}}"><i class="fa fa-retweet"></i></a></li>
                                @if($item->depot>0)
                                <li><a onclick="addcart(this,'{{$item->id}}')"><i class="fa fa-shopping-cart"></i></a></li>
                                @else
                                <li><a style="width: 70px">ناموجود</a></li>
                                    @endif
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
    <!-- Featured Section End -->
@endif
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                @foreach($banners as $banner)
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a @if($banner->linl!="")href="{{$banner->link}}" @endif>
                            <img src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}">
                        </a>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4> جدیدترین محصولات</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <?php
                                $i=1;
                                foreach ($products_new as $item){
                                if ($i % 3 == 0) {
                                ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <?php } ?>
                                <a href="/product/{{$item->slug}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 110px!important; " src="{{asset($item->image)}}" alt="">
                                    </div>
                                    @if($item->discount!=0)
                                        <div style="left: 87px;top: 1px;" class="product__discount__percent">-{{$item->discount}}%</div>
                                    @endif
                                    <div class="latest-product__item__text">
                                        <h6>{{str_limit($item->title,100)}}</h6>
                                        @if($item->discount=='0')
                                            <div style="color: green">{{number_format($item->price)}} تومان</div>
                                        @else
                                            <span>
                                         <span>{{number_format($item->price)}} تومان </span>
                                        <span>{{number_format($item->price*(100-$item->discount)/100)}} تومان </span>
                                        </span>
                                        @endif
                                    </div>
                                </a>
                                <?php $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4> پربازدیدترین محصولات</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <?php
                                $i=1;
                                foreach ($products_view as $item){
                                if ($i % 3 == 0) {
                                ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <?php } ?>
                                <a href="/product/{{$item->slug}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 110px!important; " src="{{asset($item->image)}}" alt="">
                                    </div>
                                    @if($item->discount>0)
                                        <div style="left: 87px;top: 1px;" class="product__discount__percent">-{{$item->discount}}%</div>
                                    @endif
                                    <div class="latest-product__item__text">
                                        <h6>{{str_limit($item->title,100)}}</h6>
                                        @if($item->discount=='0')
                                            <div style="color: green">{{number_format($item->price)}} تومان</div>
                                        @else
                                            <span>
                                         <span>{{number_format($item->price)}} تومان </span>
                                        <span>{{number_format($item->price*(100-$item->discount)/100)}} تومان </span>
                                        </span>
                                        @endif
                                    </div>
                                </a>
                                <?php $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4> محصولات دارای تخفیف </h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <?php
                                $i=1;
                                foreach ($products_discount as $item){
                                if ($i % 3 == 0) {
                                ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <?php } ?>
                                <a href="/product/{{$item->slug}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 110px!important; " src="{{asset($item->image)}}" alt="">
                                    </div>
                                    @if($item->discount>0)
                                        <div style="left: 87px;top: 1px;" class="product__discount__percent">-{{$item->discount}}%</div>
                                    @endif
                                    <div class="latest-product__item__text">
                                        <h6>{{str_limit($item->title,100)}}</h6>
                                        @if($item->discount=='0')
                                        <div style="color: green">{{number_format($item->price)}} تومان</div>
                                        @else
                                        <span>
                                         <span>{{number_format($item->price)}} تومان </span>
                                        <span>{{number_format($item->price*(100-$item->discount)/100)}} تومان </span>
                                        </span>
                                            @endif
                                    </div>
                                </a>
                                <?php $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>مقالات</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset($post->imgPath)}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="/blog/{{$post->slug}}">{{$post->title}}</a></h5>
                            <p>{{str_limit($post->shortContent,100)}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
