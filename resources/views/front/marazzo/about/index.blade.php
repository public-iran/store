@extends('front'.theme_name().'layout.master')

@section('style')
        <style>
            .container div,.container span,.container p,.container h3,.container h1,.container h4,.container h5,.container h6,.container h2{
                font-family: 'Yekan', sans-serif!important;
            }

        </style>
@endsection

@section('content')
    <div class="container" >
        <div class="container" style="margin: 50px 0">
            <?= $setting['about'] ?>
        </div>
    </div>

@endsection

