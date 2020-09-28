@extends('front'.theme_name().'layout.master')
@section('style')
    <style>
        .blog-details.spad{
            padding-top: 0!important;
        }
        .blog__item__pic img{
            height: 240px;
        }
        .blog__sidebar{
            text-align: right;
        }
        .blog__sidebar__search form button{
            left: 0;
            top: 4px;
            right: auto;
        }
        .blog__sidebar__search form input{
            padding-right: 15px;
            padding-left: 0;
        }
        .blog__sidebar__item ul{
            padding-right: 15px;
        }
        .blog__sidebar__recent{
            padding-right: 15px;
        }
        .blog__sidebar__recent__item__pic{
            width: 70px;
            height: 70px;
            float: right;
            margin-right:0;
            margin-left:20px;
        }
        .blog__sidebar__recent__item__pic img{
            width: 70px!important;
            height: 75px;
        }
        .title{
            font-size: 22pt;
            text-align: right;
            font-weight: 700;
        }
        .blog__sidebar{
            padding-top: 0!important;
        }
        .blog__details__hero__text{
            text-align: right;
            margin-bottom: 20px;
        }
        .blog__details__hero__text ul li{
            color: #555;
            margin-right: 0;
        }
        .blog__details__hero__text ul li:after{
            display: none;
        }
    </style>
@endsection
@section('content')

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="{{route('post_search')}}" method="get">
                                <input type="text" name="title" placeholder="جستجو...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>دسته بندی</h4>
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="/blog?cat={{$category->slug}}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>مقالات اخیر</h4>
                            <div class="blog__sidebar__recent">
                                @foreach($posts_rand as $post_rand)
                                    <a href="/blog/{{$post_rand->slug}}" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="{{asset($post_rand->imgPath)}}" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{str_limit($post_rand->title,50)}}</h6>
                                            <span>{{Verta::instance($post_rand->updated_at)->format(' %d %B %Y')}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">

                            <div class="blog__details__hero__text">

                                <h1 class="title">{{$post->title}}</h1>

                            </div>

                        <img src="{{asset($post->imgPath)}}" style="width: 100%" alt="{{$post->title}}">
                        {{--<ul>
                            --}}{{--<li>By Michael Scofield</li>--}}{{--
                            <li>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                            --}}{{--<li>8 Comments</li>--}}{{--
                        </ul>--}}
                        <p><?= $post->content ?></p>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>پربازدیدترین ها</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($post_views as $post_view)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{asset($post_view->imgPath)}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i>{{Verta::instance($post_view->updated_at)->format(' %d %B %Y')}}</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="/blog/{{$post_view->slug}}">{{$post_view->title}}</a></h5>
                                <p>{{str_limit($post_view->shortContent,50)}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->
@endsection

@section('script')
    <script>
        view({{$post->id}})
        function view(id) {
        var CSRF_TOKEN = '{{ csrf_token() }}';
        var url = '{{route('view.set_view_post')}}';
        var data = {_token: CSRF_TOKEN,id:id};
        $.post(url, data, function (msg) {
        });
        }
    </script>
@endsection
