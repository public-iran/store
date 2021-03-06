@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" type="text/css" href="{{asset('front/blog/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front/blog/rtl_style.css')}}" />
@endsection
@section('style')
<style>
    .blog.spad{
        padding-top: 0;
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
</style>
@endsection
@section('content')

    <div class="container" style="margin-top: 50px">
        <!-- Blog Section Begin -->
        <section class="blog spad">
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
                                    @foreach($posts_rand as $post)
                                        <a href="/blog/{{$post->slug}}" class="blog__sidebar__recent__item">
                                            <div class="blog__sidebar__recent__item__pic">
                                                <img src="{{asset($post->imgPath)}}" alt="">
                                            </div>
                                            <div class="blog__sidebar__recent__item__text">
                                                <h6>{{str_limit($post->title,50)}}</h6>
                                                <span>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__item">
                                        <div class="blog__item__pic">
                                            <img src="{{asset($post->imgPath)}}" alt="">
                                        </div>
                                        <div class="blog__item__text">
                                            <ul>
                                                <li><i class="fa fa-calendar-o"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                                                <li><i class="fa fa-comment-o"></i> 5</li>
                                            </ul>
                                            <h5><a href="/blog/{{$post->slug}}">{{str_limit($post->title,90)}}</a></h5>
                                            <p>{{str_limit($post->shortContent,90)}}</p>
                                            <a href="/blog/{{$post->slug}}" class="blog__btn">بیشتر<span class="arrow_right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12" style="display: flex;justify-content: center">
                                {{$posts->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Section End -->
    </div>

@endsection
