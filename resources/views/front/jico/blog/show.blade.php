@extends('front'.theme_name().'layout.master')
@section('style_link')
@endsection
@section('style')
    <style>
        .li-blog-sidebar .li-recent-post .li-recent-post-thumb{
            border: none!important;
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
                        <h2>جزئیات وبلاگ</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>جزئیات وبلاگ</li>
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
                <div class="col-lg-9 mb-sm-40 mb-xs-30">
                    <div class="blog_area">
                        <article class="blog_single blog-details">
                            <header class="entry-header">
                                    <span class="post-category">
                                </span>
                                <h1 class="entry-title">
                                    {{$post->title}}
                                </h1>
                                <span class="post-author">
                                <span class="post-by">ارسال شده توسط:</span> مدیر </span>
                                <span class="post-separator">|</span>
                                <span class="post-date"><i class="fas fa-calendar-alt"></i>{{Verta::instance($post->created_at)->format(' %d %B %Y')}} </span>
                            </header>
                            <div class="post-thumbnail img-full">
                                <img style="width: 100%" src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                            </div>
                            <div class="postinfo-wrapper">
                                <div class="post-info">
                                    <div class="entry-summary blog-post-description">
                                        <p><?= $post->content ?></p>

                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                    <!--Comment Area Start-->
                    <div class="comments-area mt-85 mt-lg-65 mt-md-55 mt-md-45 mt-sm-15 mt-xs-0">
                        <h3>{{count($comments)}} نظر</h3>
                        @foreach($comments as $comment)
                        <ol class="commentlist">
                            <li>
                                <div class="single-comment">
                                    <div class="comment-avatar img-full">
                                        <img src="{{asset('jico/images/icons/author.png')}}" alt="{{$comment->content}}">
                                    </div>
                                    <div class="comment-info">
                                        <a href="#">{{$comment->name}}</a>

                                        <span class="date">{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</span>
                                        <p>{{$comment->content}}</p>
                                    </div>
                                </div>
                                @php $comments_ansswers=App\Post_comments::where('parent',$comment->id)->get() @endphp
                                @foreach($comments_ansswers as $comments_ansswer)
                                <ol>
                                    <li>
                                        <div class="single-comment">
                                            <div class="comment-avatar img-full">
                                                <img src="{{asset('jico/images/icons/author.png')}}" alt="{{$comments_ansswer->content}}">
                                            </div>
                                            <div class="comment-info">
                                                <a>مدیر</a>

                                                <span class="date">{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span>
                                                <p>{{$comments_ansswer->content}}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                @endforeach
                            </li>
                        </ol>
                        @endforeach
                    </div>
                    <div class="comment-box mt-30">
                        <h3>پیام بگذارید</h3>
                        <form  action="{{route('comment_post_store')}}" method="post">
                            @csrf
                            <p class="comment-note"><span id="email-notes">آدرس ایمیل شما منتشر نخواهد شد. </span>قسمت های مورد نیاز علامت گذاری شده است <span class="required">*</span></p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-input">
                                        <label>اظهار نظر*</label>
                                        <textarea name="content" placeholder="پیام" id="commenter-message" cols="30" rows="5"></textarea>
                                        <input name="post" type="hidden" value="{{$post->id}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-input">
                                        <label>نام*</label>
                                        <input name="name" id="commenter-name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-input">
                                        <label>پست الکترونیک*</label>
                                        <input name="email" id="commenter-email" type="email">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-input mb-0">
                                        <button class="form-button" type="submit">ارسال نظر</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Comment Area End-->
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Section End -->


@endsection

@section('script')
    @if(session('save_comment'))
        <script>
            alertify.set('notifier','position', 'bottom-left');
            alertify.success('نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        </script>
    @endif
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
@php
    Session::forget('save_comment');
@endphp
