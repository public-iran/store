@extends('front'.theme_name().'layout.master')
@section('style')
    <style>
        .product--card .product-desc {
            height: auto;
        }

        .product-desc .product_title h4 {
            font-size: 15px;
        }

        .product__thumbnail {
            padding-top: 10px;
            text-align: center;
        }

        .product__thumbnail img {
            width: 70%;
        }

        .product-purchase {
            padding: 10px 5px;
        }

        .price_love {
            width: 100%;
            text-align: center;
        }

        .price_love span {
            width: 100%;
            margin: 0;
        }

        .product-purchase .sell {
            padding: 10px 0 0;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .product-purchase .sell span {
            padding: 0 5px;
            cursor: pointer;
        }

        .featured__preview-img {
            padding-top: 10px;
            text-align: center;
        }

        .featured__preview-img:before {
            right: 0;
        }

        .featured__preview-img img {
            width: 70% !important;
            margin: 20px auto;
        }
    </style>
@endsection
@section('content')

    <!--================================
START HERO AREA
=================================-->
    <section class="hero-area bgimage dir-rtl">
        <div class="bg_image_holder">
            <img src="images/new/hero_area_bg3.jpg" alt="background-image">
        </div>
        <!-- start hero-content -->
        <div class="hero-content content_above">
            <!-- start .contact_wrapper -->
            <div class="content-wrapper">
                <!-- start .container -->
                <div class="container">
                    <!-- start row -->
                    <div class="row">
                        <!-- start col-md-12 -->
                        <div class="col-md-12">
                            <div class="hero__content__title">
                                <h1>
                                    <span class="light">خودت بساز </span>
                                    <span class="bold">بازار محصولات دیجیتال</span>
                                </h1>
                                <p class="tagline"> یک قالب قدرتمند و قابل تنظیم برای محصولات خود </p>
                            </div>

                            <!-- start .hero__btn-area-->
                            <div class="hero__btn-area">
                                <a href="all-products.html" class="btn btn--round btn--lg">مشاهده تمام محصولات</a>
                                <a href="all-products.html" class="btn btn--round btn--lg">محصولات محبوب</a>
                            </div>
                            <!-- end .hero__btn-area-->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </div>
                <!-- end /.container -->
            </div>
            <!-- end .contact_wrapper -->
        </div>
        <!-- end hero-content -->

        <!--start search-area -->
        <div class="search-area">
            <!-- start .container -->
            <div class="container">
                <!-- start .container -->
                <div class="row">
                    <!-- start .col-sm-12 -->
                    <div class="col-sm-12">
                        <!-- start .search_box -->
                        <div class="search_box">
                            <form action="#">
                                <input type="text" class="text_field" placeholder="جستجو در محصولات ...">
                                <div class="search__select select-wrap">
                                    <select name="category" class="select--field" id="blah">
                                        <option value="">همه دسته بندی ها</option>
                                        <option value="">PSD</option>
                                        <option value="">HTML</option>
                                        <option value="">ورد پرس</option>
                                        <option value="">همه دسته بندی ها</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                                <button type="submit" class="search-btn btn--lg">جستجو</button>
                            </form>
                        </div>
                        <!-- end ./search_box -->
                    </div>
                    <!-- end /.col-sm-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!--start /.search-area -->
    </section>
    <!--================================
    END HERO AREA
    =================================-->

    <!--================================
        START FEATURED PRODUCT AREA
    =================================-->
    <section class="featured-products bgcolor2 section--padding">
        <div class="container">
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>
                            <span class="highlighted"> محصولات</span> ویژه ما
                        </h1>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-product-slider prod-slider2">
                        @foreach($spacial_product as $item)
                            <div class="featured__single-slider">
                                <div class="featured__preview-img">
                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                    <div class="prod_btn">
                                        <a href="/product/{{$item->slug}}" class="transparent btn--sm btn--round">اطلاعات
                                            بیشتر</a>
                                    </div>
                                </div>
                                <!-- end /.featured__preview-img -->

                                <div class="featured__product-description">
                                    <div class="product-desc desc--featured">
                                        <a href="/product/{{$item->slug}}" class="product_title">
                                            <h4>{{$item->title}}</h4>
                                        </a>
                                    {{--<ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/new/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">دامن دریا </a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> ورد پرس </a>
                                        </li>
                                    </ul>--}}
                                    <!-- end /.titlebtm -->
                                        @php $featurs = App\Feature::where('product_id', $item->id)->take(6)->get();@endphp
                                        <ul> @foreach($featurs as $featur)
                                                 <li>{{$featur->title}} : {{$featur->content}} </li>
                                            @endforeach</ul>
                                    </div>
                                    <!-- end /.product-desc -->

                                    <div class="product_data">
                                        <div class="tags tags--round">
                                            <ul>
                                                @foreach ($item->categories as $category)
                                                <li>
                                                    <a href="/shop?cat={{$category->slug}}">{{$category->title}} </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- end /.tags -->
                                        <div class="product-purchase featured--product-purchase">
                                            <div class="price_love">
                                                @if($item->discount>0)
                                                    <span>
                                <span
                                    style="text-decoration: line-through;">{{number_format($item->price)}} تومان </span> -
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

                                            {{--<div class="rating product--rating">
                                                <ul>
                                                    <li>
                                                        <span class="fa fa-star"></span>
                                                    </li>
                                                    <li>
                                                        <span class="fa fa-star"></span>
                                                    </li>
                                                    <li>
                                                        <span class="fa fa-star"></span>
                                                    </li>
                                                    <li>
                                                        <span class="fa fa-star"></span>
                                                    </li>
                                                    <li>
                                                        <span class="fa fa-star"></span>
                                                    </li>
                                                </ul>
                                            </div>--}}
                                        </div>
                                        <!-- end /.product-purchase -->
                                    </div>
                                </div>
                                <!-- end /.featured__product-description -->
                            </div>
                    @endforeach
                    <!--end /.featured__single-slider-->
                    </div>


                    <span class="lnr lnr-chevron-left prod_slide_prev"></span>
                    <span class="lnr lnr-chevron-right prod_slide_next"></span>
                </div>
            </div>
            <!-- end /.featured__preview-img -->
        </div>
        <!-- end /.featured-product-slider -->
    </section>
    <!--================================
        END FEATURED PRODUCT AREA
    =================================-->


    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="products section--padding dir-rtl">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="product-title-area">
                        <div class="product__title">
                            <h2>جدیدترین محصولات منتشر شده</h2>
                        </div>

                        {{-- <div class="filter__menu">
                             <p>فیلتر کردن توسط:</p>
                             <div class="filter__menu_icon">
                                 <a href="#" id="drop1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                     <img class="svg" src="images/new/svg/menu.svg" alt="menu icon">
                                 </a>

                                 <ul class="filter_dropdown dropdown-menu" aria-labelledby="drop1">

                                     <li>
                                         <a href="#">بهترین فروشنده</a>
                                     </li>
                                     <li>
                                         <a href="#">بهترین امتیاز</a>
                                     </li>
                                     <li>
                                         <a href="#">قیمت پایین</a>
                                     </li>
                                     <li>
                                         <a href="#">قیمت بالا</a>
                                     </li>
                                 </ul>
                             </div>
                         </div>--}}
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

        {{--      <!-- start row -->
              <div class="row">
                  <!-- start .col-md-12 -->
                  <div class="col-md-12">
                      <div class="sorting">
                          <ul>
                              <li>
                                  <a href="#">افزونه </a>
                              </li>
                              <li>
                                  <a href="#">ورد پرس </a>
                              </li>
                              <li>
                                  <a href="#">قالب سایت</a>
                              </li>
                              <li>
                                  <a href="#">قالب PSD</a>
                              </li>
                              <li>
                                  <a href="#">جوملا</a>
                              </li>
                              <li>
                                  <a href="#">رابط کاربری</a>
                              </li>
                              <li>
                                  <a href="#">صفحه intro</a>
                              </li>
                              <li>
                                  <a href="#">نرم افزار</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <!-- end /.col-md-12 -->
              </div>
              <!-- end /.row -->--}}

        <!-- start .row -->
            <div class="row">
                <!-- start .col-md-4 -->
                @foreach($products_new as $item)
                    <div class="col-lg-3 col-md-3">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                <div class="prod_btn">
                                    <a href="/product/{{$item->slug}}" class="transparent btn--sm btn--round">اطلاعات
                                        بیشتر</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="/product/{{$item->slug}}" class="product_title">
                                    <h4>{{str_limit($item->title,60)}}</h4>
                                </a>
                                {{-- <ul class="titlebtm">
                                     <li>
                                         <img class="auth-img" src="images/new/auth.jpg" alt="author image">
                                         <p>
                                             <a href="#">دامن دریا </a>
                                         </p>
                                     </li>
                                     <li class="product_cat">
                                         <a href="#">
                                             <span class="lnr lnr-book"></span>افزونه </a>
                                     </li>
                                 </ul>

                                 <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                     است.</p>--}}
                            </div>
                            <!-- end /.product-desc -->

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
                        <!-- end /.single-product -->
                    </div>
            @endforeach
            <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->

            <!-- start .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="more-product">
                        <a href="/shop" class="btn btn--lg btn--round">همه محصولات </a>
                    </div>
                </div>
                <!-- end ./col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END PRODUCTS AREA
    =================================-->

    <!--================================
        START COUNTER UP AREA
    =================================-->
    <section class="counter-up-area bgimage dir-rtl">
        <div class="bg_image_holder">
            <img src="images/new/countbg.jpg" alt="">
        </div>
        <!-- start .container -->
        <div class="container content_above">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="counter-up">
                    <div class="counter mcolor2">
                        <span class="lnr lnr-briefcase"></span>
                        <span class="count">38,436</span>
                        <p>آیتم برای فروش</p>
                    </div>
                    <div class="counter mcolor3">
                        <span class="lnr lnr-cloud-download"></span>
                        <span class="count">38,436</span>
                        <p>مجموع فروش</p>
                    </div>
                    <div class="counter mcolor1">
                        <span class="lnr lnr-smile"></span>
                        <span class="count">38,436</span>
                        <p>مشتریان راضی </p>
                    </div>
                    <div class="counter mcolor4">
                        <span class="lnr lnr-users"></span>
                        <span class="count">38,436</span>
                        <p>کاربر</p>
                    </div>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END COUNTER UP AREA
    =================================-->


    <!--================================
        START WHY CHOOSE US AREA
    =================================-->
    <section class="why_choose section--padding dir-rtl">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>چرا
                            <span class="highlighted">ما</span>
                            را انتخاب کنید
                        </h1>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                            است. </p>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

            <!-- start row -->
            <div class="row">
                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .reason -->
                    <div class="feature2">
                        <span class="feature2__count">01</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-license pcolor"></span>
                            <h3 class="feature2-title">یک بار پرداخت کنید</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. </p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">02</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-magic-wand scolor"></span>
                            <h3 class="feature2-title">کیفیت محصولات</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. </p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">03</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-lock mcolor1"></span>
                            <h3 class="feature2-title">100% پرداخت امن </h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. </p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">04</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-chart-bars mcolor2"></span>
                            <h3 class="feature2-title">کد های بهینه </h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.</p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">05</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-leaf mcolor3"></span>
                            <h3 class="feature2-title">رایگان آپدیت کنید </h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. </p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">06</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-phone mcolor4"></span>
                            <h3 class="feature2-title">پشتیبانی سریع </h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.</p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END WHY CHOOSE US AREA
    =================================-->


    <!--================================
        START SPECIAL FEATURES AREA
    =================================-->
    <section class="special-feature-area dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="special-feature feature--1">
                        <img src="{{asset('darya/images/new/spf1.png')}}" alt="Special Feature image">
                        <h3 class="special__feature-title">7 روز
                            <span class="highlight">گارانتی</span>
                            برگشت پول
                        </h3>
                    </div>
                </div>
                <!-- end /.col-md-6 -->
                <div class="col-md-6">
                    <div class="special-feature feature--2">
                        <img src="{{asset('darya/images/new/spf2.png')}}" alt="Special Feature image">
                        <h3 class="special__feature-title">
                            <span class="highlight">پشتیبانی</span>
                            سریع
                        </h3>
                    </div>
                </div>
                <!-- end /.col-md-6 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END SPECIAL FEATURES AREA
    =================================-->

    <!--================================
        START CALL TO ACTION AREA
    =================================-->
    <section class="call-to-action bgimage dir-rtl">
        <div class="bg_image_holder">
            <img src="images/new/calltobg.jpg" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-wrap">
                        <h1 class="text--white">آماده پیوستن به ما هستید !</h1>
                        <h4 class="text--white">بیش از 25،000 طراح و توسعهدهنده به ما اعتماد دارند.</h4>
                        <a href="#" class="btn btn--lg btn--round btn--white callto-action-btn">امروز به ما بپیوندید</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================
        END CALL TO ACTION AREA
    =================================-->

@endsection
