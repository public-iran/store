@extends('front'.theme_name().'layout.master')
@section('style_link')

@endsection
@section('style')
    <style>
        .li-blog-sidebar .li-recent-post .li-recent-post-thumb{
            border: none;
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
                        <h2>وبلاگ</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>وبلاگ</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- Blog Section Start -->
    <div class="blog-section section sb-border pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-100 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">
                @if(@$_GET['title'])
                    <h3 style="padding: 15px 0">
                        جستجو
                        <span>"{{$_GET['title']}}"</span>
                    </h3>
                @endif
                <div class="col-lg-3 order-lg-2 order-2">
                    <!-- Single Sidebar Start  -->
                    <div class="common-sidebar-widget">
                        <h3 class="sidebar-title">جستجو کردن</h3>
                        <div class="sidebar-search">
                            <form action="{{route('post_search')}}">
                                <input name="title" type="text" placeholder="جستجو کردن">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Single Sidebar End  -->
                    <!-- Single Sidebar Start  -->
                    <div class="common-sidebar-widget">
                        <h3 class="sidebar-title">پربازدیدترین</h3>
                        @foreach($posts_view as $post)
                        <div class="sidebar-blog">
                            <a href="/blog/{{$post->slug}}" class="image"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                            <div class="content">
                                <h5><a href="/blog/{{$post->slug}}">{{str_limit($post->title,60)}}</a></h5>
                                <span>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Single Sidebar End  -->

                    <!-- Single Sidebar Start  -->
                    <div class="common-sidebar-widget">
                        <h3 class="sidebar-title">دسته بندی ها</h3>
                        <ul class="sidebar-list">
                            @foreach($categories as $category)
                            <li><a href="blog?cat={{$category->slug}}"><i class="ion-plus"></i>{{$category->title}} <span class="count"></span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Single Sidebar End  -->

                </div>
                <div class="col-lg-9 order-lg-1 order-1">
                    <div class="row">
                        <!-- Single Blog Start -->
                        @foreach($posts as $post)
                        <div class="blog col-lg-12 mb-30">
                            <div class="blog-inner">
                                <div class="media"><a href="/blog/{{$post->slug}}" class="image"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a></div>
                                <div class="content">
                                    <h3 class="title"><a href="/blog/{{$post->slug}}">{{str_limit($post->title,80)}}</a></h3>
                                    <ul class="meta">
                                        <li>توسط <a>مدیر</a></li>
                                        <li>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                                    </ul>
                                    <p>{{str_limit($post->shortContent,300)}}</p>
                                    <a class="ht-btn black-btn" href="/blog/{{$post->slug}}">بیشتر بخوانید</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Single Blog End -->

                    </div>
                    <div class="row mb-0 mb-xs-35 mb-sm-35">
                        <div class="col">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Section End -->




@endsection

