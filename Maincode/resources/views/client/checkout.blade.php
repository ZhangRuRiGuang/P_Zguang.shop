@extends('client.layouts.template')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đặt hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('client.home') }}">Trang chủ</a>
                        <span>Đặt hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        @if(Session::has('invalid'))
            <div class="alert alert-danger alert-dismissible mt-2">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('invalid')}}
            </div>
        @endif
        <div class="checkout__form">
            <h4>Đặt hàng</h4>
            <form action="{{ route('pay') }}" method="POST" id="checkout-form">

                @csrf
                <input type='hidden' name='currency_code' value='VND'> 

                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Họ tên</p>
                                    <input type="text" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại</p>
                                    <input type="text" value="{{ Auth::user()->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email</p>
                                    <input type="text" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 24px;">
                            <p style="color: #1c1c1c;margin-bottom: 20px;">Phương thức thanh toán</p>
                            <input type="radio" name="type" value="0" checked> <span class="mr-2" style="color: #b2b2b2;">Thanh toán online</span>
                            <input type="radio" name="type" value="1"> <span style="color: #b2b2b2;">Thanh toán cod</span>
                        </div>
                        <div class="checkout__input">
                            <p>Số thẻ</p>
                            <input type="text" placeholder="Nhập số thẻ" id="card-number" class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>Hạn mức tháng</p>
                            <input type="number" placeholder="Nhập số thẻ" id="card-expiry-month" min=1 max=12 class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>Hạn mức năm</p>
                            <input type="number" placeholder="Nhập số thẻ" id="card-expiry-year" min=2025 max=2030 class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>CVC</p>
                            <input type="text" placeholder="Nhập CVC" id="card-cvc" class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ</p>
                            <input type="text" placeholder="Nhập địa chỉ" class="checkout__input__add" name="address" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Chi tiết đơn hàng</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng tiền</span></div>
                            <ul>
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
                                            if (in_array($product->shop_id, $shopIds)) {
                                                $shops[$product->shop_id][] = $item;
                                            }
                                        }
                                    }
                                    $total = 0;
                                @endphp
                                @foreach ($shops as $key => $shop)
                                    @foreach ($shop as $row)
                                        @php
                                            $total += $row['price'];
                                        @endphp
                                        <li>{{ $row['item']['name'] }} <span>{{ number_format($row['price'],-3,',',',') }} VND</span></li>
                                    @endforeach
                                @endforeach
                            </ul>
                            <div class="checkout__order__total">Thành tiền <span class="total-cart">{{ number_format($total,-3,',',',') }} VND</span></div>
                            <input type="hidden" id="total" name="total" value="{{ $total }}" />
                            <input type="hidden" id="shop_id" value="{{ implode(',',$shopIds) }}" name="shop_id"/>
                            <input type="text" class="form-control" placeholder="Nhập voucher của bạn" id="voucher" />
                            <button type="button" id="voucher-add" class="btn btn-primary">KIỂM TRA MÃ</button>
                            <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@stop
@section('js')
    <script>
        $('input[type=radio][name=type]').change(function() {
            if (this.value == 0) {
                $('#card-number').prop('required', true);
                $('#card-expiry-month').prop('required', true);
                $('#card-expiry-year').prop('required', true);
                $('#card-cvc').prop('required', true);
                $('#card-number').parent().show();
                $('#card-expiry-month').parent().show();
                $('#card-expiry-year').parent().show();
                $('#card-cvc').parent().show();
            } else {
                $('#card-number').prop('required', false);
                $('#card-expiry-month').prop('required', false);
                $('#card-expiry-year').prop('required', false);
                $('#card-cvc').prop('required', false);
                $('#card-number').parent().hide();
                $('#card-expiry-month').parent().hide();
                $('#card-expiry-year').parent().hide();
                $('#card-cvc').parent().hide();
            }
        });
    </script>
@endsection