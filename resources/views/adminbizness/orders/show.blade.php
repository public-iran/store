@extends('adminbizness.layout.master')

@section('Admin_content')
    <div class="row">

        <div class="col-xs-12">
            @if(session('delete_product'))
                <div class="alert alert-dismissible" role="alert" style="background-color: #61c579;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    {{session('delete_product')}}
                </div>
            @endif

            <?php
            session()->forget('delete_product');
            ?>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {{--            <div class="card">--}}
            <div class="header">
                <div class="row" style="display: flex;justify-content: space-between;margin-bottom: 15px">
                    @if(Auth()->user()->role ==1)
                        <div class="col-lg-6" style="font-size: 15px;">
                            <div style="color: #ffffff; background: #dc838f; padding: 10px;">
                                لیست سفارش {{$orders[0]->name}} به شماره فاکتور {{$orders[0]->factor_number}}
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6" style="font-size: 15px;">
                            <div style="color: #ffffff; background: #dc838f; padding: 10px;">
                                لیست سفارش شما به شماره فاکتور {{$orders[0]->factor_number}}
                            </div>
                        </div>
                    @endif
                    <?php
                    foreach ($orders as $order) {
                        $price[] = $order->total;
                    }
                    ?>
                    <div class="col-lg-6" style="font-size: 15px;">
                        <div style="color: #ffffff; background: #dc838f; padding: 10px;">
                            مجموع پرداختی : {{number_format($orders[0]->total)}} تومان
                            @if($orders[0]->discountcode!="")
                            {{'[کد تخفیف : '.$orders[0]->discountcode}}
                            {{' میزان تخفیف :'.$orders[0]->discountcode_darsad.'%]'}}
                            @endif


                        </div>
                    </div>
                </div>

                <div class="row" style="background: #1589ee;color:#fff;padding: 10px;margin-bottom: 20px;">
                    <div class="col-lg-8 col-xs-12" style="float: right">
                        <div>آدرس پستی
                            : {{$orders[0]->address}}</div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label>وضعیت سفارش:</label>
                        <select class="show-tick" onchange="send_status(this,'{{$orders[0]->factor_number}}')">
                            <option @if($orders[0]->send_status=="در حال برسی") selected @endif value="در حال برسی">در حال برسی</option>
                            <option @if($orders[0]->send_status=="در حال پیگیری سفارش") selected @endif value="در حال پیگیری سفارش">در حال پیگیری سفارش</option>
                            <option @if($orders[0]->send_status=="در حال بسته بندی") selected @endif value="در حال بسته بندی">در حال بسته بندی</option>
                            <option @if($orders[0]->send_status=="ارسال شده") selected @endif value="ارسال شده">ارسال شده</option>
                            <option @if($orders[0]->send_status=="تحویل داده شده") selected @endif value="تحویل داده شده">تحویل داده شده</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="body table-responsive">
                <table class="table table-hover" style="text-align: center;background: white;font-size: 12px">
                    <tbody>
                    <tr style="background: #f7f7f7">
                        <td>عنوان محصول</td>

                        <td>قیمت اصلی</td>
                        <td>تخفیف(درصد)</td>
                        <td>قیمت با تخفیف</td>
                        <td>تعداد</td>
                        <td>نام خریدار</td>
                        <td>استان</td>
                        <td>شهر</td>
                        <td>شماره تماس</td>
                        <td>توضیحات</td>
                        <td>تاریخ</td>


                    </tr>
                    @foreach($orders as $item)
                        <?php
                        $product = App\Product::findorfail($item->product_id);
                        $seller = App\User::findorfail($item->seller_id);
                        ?>
                        <tr style="vertical-align: middle">
                            <td style="word-wrap: break-word;width: 200px">{{$product->title}}</td>
                            <td>{{number_format($product->price)}} تومان</td>
                            <td>%{{$product->discount}}</td>
                            <td>{{number_format(($product->price*(100-$product->discount)/100))}} تومان</td>
                            <td>{{$item->count .' '.$product->unit}}</td>
                            @if(Auth()->user()->role ==1)
                                <td>{{$seller->name.' '.$seller->family}}</td>
                            @endif
                            <td>{{$item->state}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{Verta($item->created_at)}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--            </div>--}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        function send_status(tag,factor_number) {
            var status = $(tag).val();
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('orders.set_send_status')}}';
            var data = {_token: CSRF_TOKEN, factor_number: factor_number, status: status};
            $.post(url, data, function (msg) {
                if (msg == "ok") {
                    $.notify({
                        // options
                        message: '<i style="float: right;margin-top: -3px;margin-left: 10px" class="material-icons">warning</i> <span style="float: right"> با موفقیت ثبت شد</span>',
                        icon: '',
                    }, {
                        // settings
                        type: 'success',
                        allow_dismiss: false,
                        placement: {
                            from: "top",
                            align: "left"
                        },
                        animate: {
                            enter: 'animated fadeIn',
                            exit: 'animated fadeOut'
                        }
                    });
                }
            });
        }
    </script>
@endsection
