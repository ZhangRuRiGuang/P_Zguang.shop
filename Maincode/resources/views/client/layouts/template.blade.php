<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->title }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Font Awaesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/client/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/client/css/style.css') }}" type="text/css">
    @yield('css')
</head>

<body>
    @include('sweetalert::alert')
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a style="font-size: 30px;color: #e6330f;font-weight: bold;" href="{{ route('client.home') }}">
                zquang.shop
            </a>
        </div>
        <div class="humberger__menu__widget">
            @if (!Auth::check())
                @if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role == 0)
                    <div class="header__top__right__auth">
                        <a href="{{ route('auth.show.login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                    
                    </div>
                    <div class="header__top__right__auth">
                        <a href="{{ route('auth.show.register') }}">| Đăng ký</a>
                    </div>
                @else
                    <div class="header__top__right__auth">
                        @if (Auth::guard('admin')->user()->role == 0)
                            <a href="{{ route('shop.list') }}"><i class="fa fa-dashboard"></i> Hệ thống</a>
                        @elseif (Auth::guard('admin')->user()->role == 1)
                            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Hệ thống</a>
                        @else
                            <a href="{{ route('rating.list') }}"><i class="fa fa-dashboard"></i> Hệ thống</a>
                        @endif
                    </div>
                @endif
            @else
                <div class="header__top__right__auth">
                    <a href="{{ route('my.order') }}">Xin chào, {{ Auth::user()->name }}</a>
                </div>
                <div class="header__top__right__auth">
                    <a href="{{ route('auth.logout') }}">| Đăng xuất</a>
                </div>
            @endif
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> zquang.shop@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top" style="background-color: #e6330f;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li class="text-white"><i class="fa fa-envelope text-white"></i> {{ $setting->email }}</li>
                                <li class="text-white">Miễn phí ship với hóa đơn từ 500.000 VND</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            @if (!Auth::check())
                                @if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role == 0)
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('auth.show.login') }}" class="text-white"><i class="fa fa-user"></i> Đăng nhập</a>
                                    
                                    </div>
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('auth.show.register') }}" class="text-white">| Đăng ký</a>
                                    </div>
                                @else
                                    <div class="header__top__right__auth">
                                        @if (Auth::guard('admin')->user()->role == 0)
                                            <a href="{{ route('shop.list') }}" class="text-white"><i class="fa fa-dashboard"></i> Hệ thống</a>
                                        @elseif (Auth::guard('admin')->user()->role == 1)
                                            <a href="{{ route('dashboard') }}" class="text-white"><i class="fa fa-dashboard"></i> Hệ thống</a>
                                        @else
                                            <a href="{{ route('rating.list') }}" class="text-white"><i class="fa fa-dashboard"></i> Hệ thống</a>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <div class="header__top__right__auth">
                                    <a href="{{ route('my.order') }}" class="text-white">Xin chào, {{ Auth::user()->name }}</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{ route('auth.logout') }}" class="text-white">| Đăng xuất</a>
                                </div>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mb-3" style="background-color: #FA5330;">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a class="text-white" style="font-size: 30px;font-weight: bold;" href="{{ route('client.home') }}">
                            zquang.shop
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a class="text-white" style="font-size: 20px;" href={{ route('client.home') }}>Trang chủ</a></li>
                            <li><a class="text-white" style="font-size: 20px;" href={{ route('client.product') }}>Sản phẩm</a></li>
                            <li><a class="text-white" style="font-size: 20px;" href={{ route('client.introduce') }}>Giới thiệu</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            @if (Auth::check())
                                <li><a class="text-white" style="font-size: 20px;" href="{{ route('client.wishlist') }}"><i class="text-white fa fa-heart"></i> <span class="bg-warning text-white">{{ !is_null(\App\Models\Wishlist::where('user_id',Auth::user()->id)->get()) ? \App\Models\Wishlist::where('user_id',Auth::user()->id)->get()->count() : 0 }}</span> Yêu thích</a></li>
                            @endif
                            <li><a class="text-white" style="font-size: 20px;" href="{{ route('client.shopping.cart') }}"><i class="text-white fa fa-shopping-bag"></i> <span class="bg-warning text-white" id="qty_cart">{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}</span> Giỏ hàng</a></li>
                        </ul>
                        <div style="font-size: 20px;" class="text-white header__cart__price">Tổng: <span class="text-white" id="price_cart">{{ Session::has('cart') ? number_format(Session::get('cart')->totalPrice,-3,',',',') : 0 }} VND</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    @yield('main')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a style="font-size: 30px;color: #e6330f;font-weight: bold;" href="{{ route('client.home') }}">
                                zquang.shop
                            </a>
                        </div>
                        <ul>
                            <li>Địa chỉ: {{ $setting->address }}</li>
                            <li>Phone: {{ $setting->tel }}</li>
                            <li>Email: {{ $setting->email }}</li>
                        </ul>
                    </div>
                    <p style="font-weight: bold;color:black;">Chứng nhận bởi</p>
                    <img src="{{ asset('client/img/bo-cong-thuong.svg') }}" />
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Về Zquang.shop</h6>
                        <ul>
                            <li><a href="{{ route('client.introduce') }}">Giới thiệu Zquang.shop</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                            <li><a href="#">Chính sách bảo mật thanh toán</a></li>
                            <li><a href="#">Chính sách giải quyết khiếu nại</a></li>
                            <li><a href="#">Điều khoản sử dụng</a></li>
                            <li><a href="#">Điều kiện vận chuyển</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Hướng dẫn trả góp</a></li>
                            <li><a href="#">Chính sách đổi trả</a></li>
                            <li><a href="#">Phương thức vận chuyển</a></li>
                            <li><a href="#">Hướng dẫn đặt hàng</a></li>
                            <li><a href="#">Gửi yêu cầu hỗ trợ</a></li>
                            <li><a href="#">Chính sách hàng nhập khẩu</a></li>
                        </ul>
                    </div>
                    <div class="footer__widget">
                        <h6 class="mt-3">Hợp tác và liên kết</h6>
                        <ul>
                            <li><a href="#">Quy chế hoạt động</a></li>
                            <li><a href="#">Bán hàng cùng Zquang.shop</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Trở thành cổ đông Zquang.shop</a></li>
                            <li><a href="#">Lợi ích</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Liên hệ</h6>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                        <h6 class="mt-3">Phương thức thanh toán</h6>
                        <img src="{{ asset('client/img/payment-item.png') }}" width="300"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright ©<script>document.write(new Date().getFullYear());</script> | Bản quyền thuộc công ty TNHH Zquang.shop
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('client/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('client/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('client/js/main.js') }}"></script>
    <script src="{{ asset('client/js/add-to-cart.js') }}"></script>
    <script src="{{ asset('client/js/filter.js') }}"></script>
    <script src="{{ asset('client/js/sort.js') }}"></script>
    <script src="{{ asset('client/js/voucher.js') }}"></script>
    <script src="{{ asset('client/js/rating.js') }}"></script>
    <script src="{{ asset('client/js/image.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script>
		Stripe.setPublishableKey('pk_test_51HgKtQA1q67YUalkFwQkc2jdscUSgR0YNyEGU7x6IqODF0LMDWkhI7RRfon1waK1voxJNtSIb6jg3aqwmgAB9lmZ00ZKWKhrHa');

		var form = $('#checkout-form');


		form.submit(function(event) {
            if ($('input[type=radio][name=type]').val() == 0) {
                $('#charge-error').addClass('hidden');
                form.find('button').prop('disabled', true);
                Stripe.card.createToken({
                    number: $('#card-number').val(),
                    cvc: $('#card-cvc').val(),
                    exp_month: $('#card-expiry-month').val(),
                    exp_year: $('#card-expiry-year').val(),
                    name: $('#card-name').val()
                }, stripeResponseHandler);
                return false;
            } else {
                form.get(0).submit();
            }
		});	

	function stripeResponseHandler(status, response) {
		var token = response.id;
        form.append($('<input type="hidden" name="stripeToken" />').val(token));

        // Submit the form:
        form.get(0).submit();
	}
	</script>
    @yield('js')
</body>

</html>