@extends('client.layouts.template')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Hóa đơn của tôi</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tổng tiền</th>
                            <th>Mã khuyến mâĩ</th>
                            <th>Địa chỉ</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->count() > 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ !is_null($order->voucher_code) ? number_format($order->total - \App\Models\Voucher::where('code', $order->voucher_code)->first()->price,-3,',',',') : number_format($order->total,-3,',',',') }} VND</td>
                                    <td>{{ !is_null($order->voucher_code) ? $order->voucher_code : 'Không có' }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->type == 0 ? 'Thanh toán Online' : 'Thanh toán COD' }}</td>
                                    <td>
                                        @if ($order->status === 0)
                                            {{ 'Chờ xác nhận' }}
                                        @elseif ($order->status === 1)
                                            {{ 'Đang chuẩn bị đơn hàng' }}
                                        @elseif ($order->status === 2)
                                            {{ 'Đang giao hàng' }}
                                        @elseif ($order->status === 3)
                                            {{ 'Đã giao hàng' }}
                                        @elseif ($order->status === 4)
                                            {{ 'Hủy' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('my.order.show', ['id' => $order->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td align="center" colspan="7">Không có đơn hàng</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@stop