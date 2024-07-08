@extends('client.layouts.template')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giới thiệu</h2>
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
                <p style="font-size: 2rem;line-height:1.5;text-align:justify;">
                    <b>{{ $setting->title }}</b> là một website cung cấp hàng tiêu dùng cho người dân. Với mong muốn mang tới mọi gia đình sự tiện nghi trong mùa covid 19.
                    Cùng chung tay xây dựng một cuộc sống an toàn và chất lượng cho người dân Việt Nam
                </p>
                <p style="font-size: 2rem;line-height:1.5;text-align:justify;">
                    Cùng chung tay xây dựng một cuộc sống an toàn và chất lượng cho người dân Việt Nam
                </p>
            </div>
            <div class="col-lg-6 col-md-6">
                <p style="font-size: 2rem;line-height:1.5;text-align:justify;">
                    Thông tin liên hệ
                </p>
                <p style="font-size: 1.3rem;line-height:1.5;text-align:justify;">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ: {{ $setting->address }}
                    <br>
                    <i class="fa fa-phone" aria-hidden="true"></i> Số điện thoại: {{ $setting->tel }}
                    <br>
                    <i class="fa fa-envelope" aria-hidden="true"></i> Email: {{ $setting->email }}
                </p>
            </div>
            <div class="col-lg-6 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d476861.2536842293!2d105.37248187207724!3d20.973446117554786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135008e13800a29%3A0x2987e416210b90d!2zSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1655443066530!5m2!1svi!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@stop