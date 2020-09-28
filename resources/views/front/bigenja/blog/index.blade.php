@extends('front.layout.master')
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
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">بلاگ</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">خانه</a></li>
                                <li>بلاگ</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>

    <section class="blog-page-content-area">
        <div class="container">
            @if(@$_GET['title'])
                <h3 style="padding: 15px 0">
                    جستجو
                    <span>"{{$_GET['title']}}"</span>
                </h3>
            @endif
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="single-our-story-item"><!-- single our story item -->
                        <div class="thumb">
                            <img src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                        </div>
                        <div class="conent">
                            <span class="time">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                            <a href="/blog/{{$post->slug}}"> <h4 class="title">{{str_limit($post->title,60)}}</h4></a>
                            <p>{{str_limit($post->shortContent,300)}}</p>
                        </div>
                    </div><!-- //.single our story item -->
                </div>
                    @endforeach
            </div>
                {{$posts->links()}}
        </div>


    </section>




@endsection

