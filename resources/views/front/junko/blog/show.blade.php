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
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="/">خانه</a></li>
                            <li>جزئیات مطلب بلاگ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--blog body area start-->
    <div class="blog_details mt-60">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-12">
                    <!--blog grid area start-->
                    <div class="blog_wrapper">
                        <article class="single_blog">
                            <figure>
                                <div class="post_header">
                                    <h1 class="post_title" style="font-size: 22px">{{$post->title}}</h1>
                                    <div class="blog_meta">
                                        <span class="author">ارسال توسط : <a href="#">مدیر</a> / </span>
                                        <span class="post_date">در : <a href="#">{{Verta::instance($post->created_at)->format(' %d %B %Y')}}</a> /</span>
                                    </div>
                                </div>
                                <div class="blog_thumb">
                                    <a href="#"><img style="width: 100%" src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                                </div>
                                <figcaption class="blog_content">
                                    <div class="post_content">
                                        <p><?= $post->content ?></p>
                                    </div>

                                </figcaption>
                            </figure>
                        </article>
                        <div class="related_posts">
                            <h3>مطالب مرتبط</h3>
                            <div class="row">
                                @foreach($like_posts as $item)
                                <div class="col-lg-4 col-md-6">
                                    <article class="single_related">
                                        <figure>
                                            <div class="related_thumb">
                                                <img src="{{asset($item->imgPath)}}" alt="{{$item->title}}">
                                            </div>
                                            <figcaption class="related_content">
                                                <div class="blog_meta">
                                                    <span class="author">توسط: <a href="#">مدیر</a> / </span>
                                                    <span class="post_date"> {{Verta::instance($item->created_at)->format(' %d %B %Y')}}	</span>
                                                </div>
                                                <h4><a href="/blog/{{$item->slug}}">{{str_limit($item->title,60)}}</a></h4>
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="comments_box">
                            <h3>{{count($comments)}} دیدگاه	</h3>
                            @foreach($comments as $comment)
                            <div class="comment_list">
                                <div class="comment_thumb">
                                    <img src="{{asset('junko/img/blog/comment3.png.jpg')}}" alt="{{$comment->content}}">
                                </div>
                                <div class="comment_content">
                                    <div class="comment_meta">
                                        <h5><a>{{$comment->name}}</a></h5>
                                        <span>{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</span>
                                    </div>
                                    <p>{{$comment->content}}</p>
                                </div>

                            </div>
                                @php $comments_ansswers=App\Post_comments::where('parent',$comment->id)->get() @endphp
                                @foreach($comments_ansswers as $comments_ansswer)
                            <div class="comment_list list_two">
                                <div class="comment_thumb">
                                    <img src="{{asset('junko/img/blog/comment3.png.jpg')}}" alt="{{$comments_ansswer->content}}">
                                </div>
                                <div class="comment_content">
                                    <div class="comment_meta">
                                        <h5><a href="#">مدیر</a></h5>
                                        <span>{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span>
                                    </div>
                                    <p>{{$comments_ansswer->content}}</p>

                                </div>
                            </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="comments_form">
                            <h3>یک پاسخ ارسال کنید </h3>
                            <p>ایمیل شما منتشر نخواهد شد. فیلد های الزامی با * مشخص شده اند</p>
                            <form  action="{{route('comment_post_store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label for="review_comment">دیدگاه </label>
                                        <textarea name="content" id="review_comment" required></textarea>
                                        <input name="post" value="{{$post->id}}" type="hidden">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="author">نام</label>
                                        <input name="name" id="author" type="text" required>

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="email">ایمیل </label>
                                        <input name="email" id="email" type="email" dir="ltr" required>
                                    </div>

                                </div>
                                <button class="button" type="submit">ارسال دیدگاه</button>
                            </form>
                        </div>

                    </div>
                    <!--blog grid area start-->
                </div>
                <div class="col-lg-3 col-md-12">
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
    <!--blog section area end-->





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
