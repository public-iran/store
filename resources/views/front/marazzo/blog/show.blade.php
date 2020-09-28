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
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">خانه</a></li>
                    <li class='active'>نوشته وبلاگ</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="blog-page">
                    <div class="col-xs-12 col-sm-9 col-md-9 rht-col">
                        <div class="blog-post wow fadeInUp">
                            <img style="width: 100%" class="img-responsive" src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                            <h1>{{$post->title}}</h1>
                            <span class="author">مدیر</span>
                            <span class="review">{{count($comments)}} دیدگاه</span>
                            <span class="date-time">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                            <div> <?= $post->content ?></div>

                        </div>

                        <div class="blog-post-author-details blog-review wow fadeInUp">
                            @foreach($comments as $comment)
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="title-review-comments">{{count($comments)}} دیدگاه</h3>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <img src="{{asset('marazzo/images/testimonials/member1.png')}}" alt="Responsive image" class="img-rounded img-responsive">
                                </div>

                                <div class="col-md-10 col-sm-10 blog-comments outer-bottom-xs">
                                    <div class="blog-comments inner-bottom-xs">
                                        <h4>{{$comment->name}}</h4>
                                        <span class="review-action pull-left">
                         {{Verta::instance($comment->created_at)->format(' %d %B %Y')}}

                    </span>
                                        <p>{{$comment->content}}</p>                                    </div>
                                    @php $comments_ansswers=App\Post_comments::where('parent',$comment->id)->get() @endphp
                                    @foreach($comments_ansswers as $comments_ansswer)
                                    <div class="blog-comments-responce outer-top-xs ">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2">
                                                <img src="{{asset('marazzo/images/testimonials/member4.png')}}" alt="Responsive image" class="img-rounded img-responsive">
                                            </div>
                                            <div class="col-md-10 col-sm-10 outer-bottom-xs">
                                                <div class="blog-sub-comments inner-bottom-xs">
                                                    <h4>مدیر</h4>
                                                    <span class="review-action pull-left">
                     {{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}
                    </span>
                                                    <p>{{$comments_ansswer->content}}
                                                    </p>                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="blog-write-comment outer-bottom-xs outer-top-xs">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>ارسال دیدگاه</h4>
                                </div>
                                <form class="cmnt_reply_form" action="{{route('comment_post_store')}}" method="post">
                                    @csrf
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputName">نام شما <span>*</span></label>
                                            <input type="text" name="name" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputEmail1">آدرس ایمیل <span>*</span></label>
                                            <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                            <input type="hidden" name="post" value="{{$post->id}}">
                                        </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputComments">دیدگاه تان <span>*</span></label>
                                            <textarea name="content" class="form-control unicase-form-control" id="exampleInputComments"></textarea>
                                        </div>
                                </div>
                                <div class="col-md-12 outer-bottom-small m-t-20">
                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">ثبت دیدگاه</button>
                                </div>
                                </form>
                            </div>
                        </div>
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
        </div>
    </div>
    <!-- ============================================================= FOOTER ============================================================= -->


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
