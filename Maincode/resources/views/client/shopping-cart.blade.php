@extends('client.layouts.template')

@section('main')
<style>
    .shop_detail:hover {
        color: #F64E2F;
    }
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('client.home') }}">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        @php
                            use App\Models\Cart;
                            use App\Models\Product;
                            use App\Models\Shop;
                            $oldCart = Session::get('cart');
                            $cart = new Cart($oldCart);
                            $shops = [];
                            if (!empty($cart->items)) {
                                foreach ($cart->items as $key => $item) {
                                    $product = Product::find($key);
                                    $shops[$product->shop_id][] = $item;
                                }
                            }
                        @endphp
                        <tbody>
                            @if (!empty($shops))
                                @foreach ($shops as $key => $shop)
                                    <tr>
                                        <th colspan="3" style="text-align:left;">
                                            <div style="display:flex;align-items:center;">
                                                <input type="checkbox" value = "{{ $key }}" name="choose-shop" style="width:30px;height:20px;"/>
                                                <a href="{{ route('shop.detail', ['id' => $key]) }}"><h4 class="shop_detail"><i class="fa-solid fa-shop"></i> {{ Shop::find($key)->name }}</h4></a>
                                            </div>
                                        </th>
                                    </tr>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($shop as $row)
                                        @php
                                            $total += $row['price'];
                                        @endphp
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{  asset($row['item']['image_path']) }}" alt="{{ $row['item']['name'] }}" width="100">
                                                <h5>{{ $row['item']['name'] }}</h5>
                                            </td>
                                            <td class="shoping__cart__price" width="200">
                                                {{ number_format($row['item']['price'],-3,',',',') }} VND
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <a href="{{ route('decrease.item', ['id' => $row['item']['id']]) }}"><span class="dec qtybtn">-</span></a>
                                                        <input type="text" value="{{ $row['qty'] }}" readonly>
                                                        <a href="{{ route('increase.item', ['id' => $row['item']['id']]) }}"><span class="inc qtybtn">+</span></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ number_format($row['price'],-3,',',',') }} VND
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{ route('delete.item', ['id' => $row['item']['id']]) }}"><span class="icon_close"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align:left;"><h4 class="text-danger">Tổng tiền: {{ number_format($total,-3,',',',') }} VND</h4></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" align="center">Chưa có sản phẩm</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ route('client.home') }}" class="primary-btn cart-btn">TIẾP TỤC MUA HÀNG</a>
                </div>
                @if (Auth::check())
                    <form action="{{ route('client.checkout') }}" method="POST">

                        @csrf

                        <input type="hidden" id="shop_arr" name="shop_id"/>

                        <div class="shoping__cart__btns" style="float:right">
                            <button type="submit" class="primary-btn">THANH TOÁN</button>
                        </div>
                    </form>
                @else
                    <div class="shoping__cart__btns" style="float:right">
                        <a href="{{ route('auth.show.login') }}" class="primary-btn">VUI LÒNG ĐĂNG NHẬP</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
@stop
@section('js')
    <script>
        var arr = [];
        $('input[name="choose-shop"]').change(function() {
            var value = $(this).val();
            if(this.checked) {
                arr.push(value);
            } else {
                var index = arr.indexOf(value);
                if (index > -1) {
                    arr.splice(index, 1);
                }
            }
            $('#shop_arr').val(arr);
        });
    </script>
@endsection