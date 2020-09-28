@extends('front'.theme_name().'layout.master')

@section('style')
        <style>
            .container div,.container span,.container p,.container h3,.container h1,.container h4,.container h5,.container h6,.container h2{
                font-family:"primary-font", "segoe ui", "tahoma";
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
                            <li>درباره ما</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <!--About Us Area Start-->
    <div class="about-us-area section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-100 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                  <?= $setting['about'] ?>
                </div>
            </div>
        </div>
    </div>
    <!--About Us Area End-->

@endsection

