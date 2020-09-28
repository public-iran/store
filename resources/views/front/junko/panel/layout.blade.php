@extends('front'.theme_name().'layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/panel/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{asset('front/panel/css/rtl.css')}}">

@endsection
@section('style')
    <style>
        main{
            position: relative;
        }
        .main-sidebar{
            text-align: right;
            padding-top: 0;
            right: auto;
            background: #ecf0f5;
        }
        .content-wrapper{
            background: #fff;
            text-align: right;
        }
        .sidebar-menu a{
            color: #000000;
        }
        .sidebar-menu a i{
            color: #555;
        }
        .box .box-body div{
            color: #bababa;
            font-size: 14px;
        }
        .box .box-body div h5{
            color: #bababa;
        }
        .box .box-body div.row{
            padding: 30px 20px;
        }
        .list-orders{
            width: 100%;
            display: block;
            text-align: center;
            padding: 11px 0;
            background: #fafafa;
        }
        .main-sidebar{
            z-index: 1;
        }
        .body-content .my-wishlist-page .my-wishlist table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
            padding: 8px;
        }
        .main-sidebar.active{

        }
        .main-sidebar.active {
            -webkit-transform: translateX(60px);
            -ms-transform: translateX(60px);
            transform: translateX(46px);
        }
        .mobile-navigation ul li a {
            font-size: 22px;
            font-weight: 400;
            line-height: 28px;
            color: #333333;
            display: block;
        }
        .offcanvas-menu-close{
            display: none;
        }
        .main-sidebar.active .offcanvas-menu-close{
            display: block;
        }
        @media only screen and (max-width: 479px){
            .offcanvas-menu-close {
                width: 30px;
                height: 30px;
                line-height: 38px;
                left: -29px;
                font-size: 20px;
                display: none;
            }
        }
        .offcanvas-menu-close i{
            border-radius: 23%;
            border: 1px solid;
            padding: 2px 10px;
        }
        .mobile-menu-icon{
            display: none!important;
        }
        @media only screen and (max-width: 767px){
            .mobile-menu-icon{
                display: block!important;
            }

        }
    </style>
@endsection


@section('content')
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>پنل کاربری</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="/">خانه</a></li>
                            <li>پنل کاربری</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="hero-section section position-relative">
    <div class="container" style="position:relative;">
        <div class="mobile-navigation">
            <ul> <li>
                    <a href="javascript:void(0)" class="mobile-menu-icon" id="mobile-menu-trigger2"><i class="ion-navicon"></i></a>
                </li></ul>

        </div>
        <aside id="main-sidebar" class="main-sidebar" style="margin-top: 55px;">
            <!-- sidebar: style can be found in sidebar.less -->
            <a style="    float: left;" class="offcanvas-menu-close" id="offcanvas-menu-close-trigger">
                <i class="ion-android-close"></i>
            </a>
            <section class="sidebar">

                <ul class="sidebar-menu" data-widget="tree">

                    <li><a href="/panel"><i class="fa fa-dashboard"></i> <span>داشبورد</span></a></li>
                    <li><a href="/panel/orders"><i class="fa fa-shopping-basket"></i> <span>سفارش های من</span></a></li>
                    <li><a href="/panel/favorites"><i class="fa fa-heart"></i><span>لیست مورد علاقه</span></a></li>
                    <li><a href="/panel/profile"><i style="margin-right: 11px" class="fa fa-user"></i><span>اطلاعات حساب</span></a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>خروج</span></a></li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

    @yield('content_panel')

        </div>
    </div>
    </div>
@endsection


@section('script_link')
    <script src="{{asset('front/panel/js/adminlte.min.js')}}"></script>
    <script src="{{asset('front/panel/js/dashboard.js')}}"></script>
    <script>
        $('#offcanvas-menu-close-trigger').click(function () {

        })
        $('#mobile-menu-trigger2').on('click', function(){
            $('#main-sidebar').removeClass('inactive').addClass('active');
        });
        $('.offcanvas-menu-close').on('click', function(){
            $('#main-sidebar').removeClass('active').addClass('inactive');
        });
    </script>
@endsection
