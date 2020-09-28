@extends('front.layout.master')
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
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">جزئیات بلاگ</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">خانه</a></li>
                                <li>جزئیات بلاگ</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- blog details page content area start -->
    <section class="blog-details-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">


                    <div class="single-blog-post"><!-- single blog post -->
                        <div class="meta-time"><!-- meta time -->
                            <span class="date">23</span>
                            <span class="month">اردیبهشت</span>
                        </div><!-- //.meta time -->

                        <div class="details-container"><!-- details contaienr -->
                            <img style="width: 100%" class="img-responsive" src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                            <div class="meta-tags"><!-- meta tags -->

                                <ul>
                                    <li><i class="fas fa-comments"></i> {{count($comments)}} نظر</li>
                                    <li><i class="fas fa-share"></i> {{$post->view}} بازدید</li>
                                </ul>
                            </div>
                            <div class="post-body"><!-- post body -->
                                <h1 class="title">{{$post->title}}</h1>
                                <p><?= $post->content ?></p>

                            </div><!-- //.post body -->
                            <div class="single-post-separator"></div>
                            <div class="comments-area"><!-- comments area satart -->
                                <h3 class="title">نظرات</h3>
                                @foreach($comments as $comment)
                                <div class="single-comment-item margin-bottom-40"><!-- single comment item -->
                                    <div class="thumb">
                                        <img src="{{asset('bigenja/img/comments/01.png')}}" alt="commente avatar">
                                    </div>
                                    <div class="content">
                                        <span class="meta-date">{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</span>
                                        <h4 class="author-name">{{$comment->name}}</h4>
                                        <p>{{$comment->content}}</p>
                                    </div>
                                    @php $comments_ansswers=App\Post_comments::where('parent',$comment->id)->get() @endphp
                                    @foreach($comments_ansswers as $comments_ansswer)
                                    <div style="margin-right: 50px;margin-top: 15px;: " class="single-comment-item margin-bottom-40"><!-- single comment item -->
                                        <div class="thumb">
                                            <img src="{{asset('bigenja/img/comments/01.png')}}" alt="commente avatar">
                                        </div>
                                        <div class="content">
                                            <span class="meta-date">{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span>
                                            <h4 class="author-name">مدیر</h4>
                                            <p>{{$comments_ansswer->content}}</p>                                    </div>
                                    </div>
                                    @endforeach
                                    </div>

                                @endforeach
                            </div><!-- //. comments area end -->
                            <div class="single-blog-page-separator"></div>
                            <div class="comments-form-area"><!-- comments form area -->
                                <h3 class="title">ارسال نظر</h3>
                                <div class="comment-form-wrapper"><!-- comment form wrapper -->
                                    <form  action="{{route('comment_post_store')}}" method="post">
                                        @csrf
                                        <div class="form-element margin-bottom-15">
                                            <div class="has-icon textarea">
                                                <textarea name="content" rows="20" cols="8" placeholder="نظرات خود را تایپ کنید...." class="input-field borderd textarea"></textarea>
                                                <div class="the-icon">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <div class="has-icon ">
                                                <input name="name" type="text" class="input-field borderd" placeholder="نام خود را بنویسید....">
                                                <div class="the-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <div class="has-icon ">
                                                <input type="email" name="email" class="input-field borderd" placeholder="ایمیل خود را بنویسید....">
                                                <div class="the-icon">
                                                    <i class="fas fa-envelope"></i>
                                                    <input type="hidden" name="post" value="{{$post->id}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-element margin-top-40">
                                            <input type="submit" value="ارسال نظر" class="submit-btn btn-rounded">
                                        </div>
                                    </form>
                                </div>
                            </div><!-- comments form area -->
                        </div>
                    </div>
                </div><!-- //.col-lg-8 -->
                <div class="col-lg-4">
                    <aside class="sidebar">

                        <div class="sidebar-separator"></div>
                        <div class="widget-area category">
                            <!-- category widget start-->
                            <div class="widget-title">
                                <h4>دسته بندی ها</h4>
                            </div>
                            <div class="widget-body">
                                <!-- widget body -->
                                <ul class="categories">
                                    <!-- categories -->
                                    @foreach($categories as $category)
                                    <li>
                                        <a href="/blog?cat={{$category->slug}}">{{$category->title}}

                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                                <!-- ./ cateogries -->
                            </div>
                            <!-- /. widget body -->
                        </div>
                        <!-- category widget end-->
                        <div class="sidebar-separator category"></div>
                        <div class="widget-area latest-post">
                            <!-- latest post widget start -->
                            <div class="widget-title">
                                <h4>پست های اخیر سایت</h4>
                            </div>
                            <div class="widget-body">
                                @foreach($last_posts as $post)
                                <div class="single-latest-post">
                                    <!-- single lates post item start-->
                                    <div class="media">
                                        <!-- media  -->
                                        <img style="width: 80px" class="mr-3" src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                                        <div class="media-body">
                                            <!-- media body-->
                                            <a href="/blog/{{$post->slug}}">
                                                <h5 class="mt-0">{{str_limit($post->title,70)}}</h5>
                                            </a>
                                            <span class="meta-time">
                                                    <i class="far fa-clock"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                                        </div>
                                        <!-- /.media body -->
                                    </div>
                                    <!-- /.media -->
                                </div>
                                @endforeach
                            </div>
                            <!-- /. widget body -->
                        </div>

                    </aside>
                    <!-- sidebar end -->
                </div><!-- //.col-lg-4 -->
            </div><!-- //.row -->
        </div><!-- //.container -->
    </section>
    <!-- blog details page content area end -->



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
