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
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li class='active'>وبلاگ</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            @if(@$_GET['title'])
                <h3 style="padding: 15px 0">
                    جستجو
                    <span>"{{$_GET['title']}}"</span>
                </h3>
            @endif
            <div class="row">
                <div class="blog-page">
                    <div class="col-xs-12 col-sm-9 col-md-9 rht-col">
                        @foreach($posts as $post)
                        <div class="blog-post outer-top-bd wow fadeInUp">
                            <a href="/blog/{{$post->slug}}"><img style="width: 100%" class="img-responsive" src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                            <h1><a href="/blog/{{$post->slug}}">{{str_limit($post->title,70)}}</a></h1>
                            <span class="author">مدیر</span>
                            <span class="review"> {{$post->view}} دیدگاه</span>
                            <span class="date-time">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                            <p>{{str_limit($post->shortContent,300)}}</p>
                            <a href="/blog/{{$post->slug}}" class="btn btn-upper btn-primary read-more">ادامه مطلب</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 sidebar">



                        <div class="sidebar-module-container">
                            <div class="search-area outer-bottom-small">
                                <form action="{{route('post_search')}}">
                                    <div style="border-radius: 5px" class="control-group">
                                        <input name="title" placeholder="جستجو در محتوا" class="search-field">
                                    </div>
                                </form>
                            </div>


                            <!-- ==============================================CATEGORY============================================== -->
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">دسته بندیها</h3>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="accordion">
                                        @foreach($categories as $category)
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a href="/blog?cat={{$category->slug}}" class="accordion-toggle collapsed">{{$category->title}}</a>
                                            </div>

                                        </div>
                                    @endforeach

                                    </div>
                                    <!-- /.accordion -->
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== CATEGORY : END ============================================== -->
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">ویجت</h3>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#popular" data-toggle="tab">محبوب</a></li>
                                    <li><a href="#recent" data-toggle="tab">آخرین</a></li>
                                </ul>
                                <div class="tab-content" style="padding-right:0">
                                    <div class="tab-pane active m-t-20" id="popular">
                                        <div class="tab-pane m-t-20" id="recent">
                                            @foreach($posts_view as $post)
                                                <div class="blog-post inner-bottom-30">
                                                    <img class="img-responsive" src="{{asset($post->imgPath)}}" alt="">
                                                    <h4><a href="/blog/{{$post->slug}}">{{str_limit($post->title,60)}}</a></h4>
                                                    <span class="review">{{$post->view}} بازدید</span>
                                                    <span class="date-time">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                                                    <p>{{str_limit($post->shortContent,90)}}</p>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="tab-pane m-t-20" id="recent">
                                        @foreach($last_posts as $post)
                                        <div class="blog-post inner-bottom-30">
                                            <img class="img-responsive" src="{{asset($post->imgPath)}}" alt="">
                                            <h4><a href="/blog/{{$post->slug}}">{{str_limit($post->title,70)}}</a></h4>
                                            <span class="review">{{$post->view}} دیدگاه</span>
                                            <span class="date-time">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                                            <p>{{str_limit($post->shortContent,90)}}</p>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- /.sidebar-widget -->
                            <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                        </div>
                    </div>
                </div>

            </div>
                {{$posts->links()}}
        </div>
    </div>


@endsection

