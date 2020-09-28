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

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">خانه</a></li>
                            <li>بلاگ</li>
                            @if(@$_GET['title'])
                                <li>
                                    جستجو
                                    <span>"{{$_GET['title']}}"</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--blog area start-->
    <div class="blog_page_section mt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog_wrapper">
                        <div class="blog_header">
                            <h1>بلاگ</h1>
                        </div>
                        <div class="row">
                            @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6">
                                <article class="single_blog mb-60">
                                    <figure>
                                        <div class="blog_thumb">
                                            <a href="/blog/{{$post->slug}}"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                                        </div>
                                        <figcaption class="blog_content">
                                            <h3><a href="/blog/{{$post->slug}}">{{str_limit($post->title,80)}}</a></h3>
                                            <div class="blog_meta">
                                                <span class="author">ارسال توسط : <a href="#">مدیر</a> / </span>
                                                <span class="post_date">در : <a href="#">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</a></span>
                                            </div>
                                            <div class="blog_desc">
                                                <p>{{str_limit($post->shortContent,300)}}</p>
                                            </div>
                                            <footer class="readmore_button">
                                                <a href="/blog/{{$post->slug}}">بیشتر بخوانید</a>
                                            </footer>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list widget_search">
                            <h3>جستجو</h3>
                            <form action="{{route('post_search')}}">
                                <input name="title" placeholder="جستجو ..." type="text">
                                <button type="submit">جستجو</button>
                            </form>
                        </div>

                        <div class="widget_list widget_post">
                            <h3>پربازدیدترین</h3>
                            @foreach($posts_view as $post)
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href="/blog/{{$post->slug}}"><img src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                                </div>
                                <div class="post_info">
                                    <h3><a href="/blog/{{$post->slug}}">{{str_limit($post->title,60)}}</a></h3>
                                    <span>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}} </span>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="widget_list widget_categories">
                            <h3>دسته ها</h3>
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="blog?cat={{$category->slug}}">{{$category->title}} <span class="count"></span></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog area end-->

    <!--blog pagination area start-->
    <div class="blog_pagination">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
    <!--blog pagination area end-->




@endsection

