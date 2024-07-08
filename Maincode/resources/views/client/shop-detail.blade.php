@extends('client.layouts.template')

@section('main')

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 p-4" style="background-color: #7f7e7e;">
                <div class="d-flex">
                    <img src="{{ asset($shop->image) }}" class="img-thumbnail" width="120"/>
                    <div class="ml-4 text-white">
                        <span style="font-weight:bold;font-size:24px;">{{ $shop->name }}</span>
                        <p><i>Chủ gian hàng: {{ \App\Models\Admin::find($shop->admin_id)->name }}</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <p><i class="fa-solid fa-store"></i> Sản phẩm: {{ $products->count() }}</p>
                        <p><i class="fa-solid fa-phone"></i> Số điện thoại: {{ $shop->phone }}</p>
                        <p><i class="fa-solid fa-location-dot"></i> Địa chỉ: {{ $shop->address }}</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <p><i class="fa-solid fa-user-check"></i> Tham gia: {{ date('m/Y', strtotime($shop->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__tab" style="padding-top:0 !important">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active">Sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
            @if ($products->count() > 0)
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $category)
                                @if (\App\Models\Product::where('category_id', $category->id)->where('shop_id', $shop->id)->get()->count() > 0)
                                    <li data-filter=".{{ str_replace(' ', '', $category->name) }}">{{ $category->name }}</li> 
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Featured Section Begin -->
                <div class="col-lg-12">
                    <div class="row featured__filter">
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6 mix {{ str_replace(' ', '', \App\Models\Category::find($product->category_id)->name) }}">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="{{ asset($product->image_path) }}">
                                        @if (!Auth::guard('admin')->check())
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }});"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                                        <h5>{{ number_format($product->price,-3,',',',') }} VND</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Featured Section End -->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    {!! $products->links() !!}
                </div>
            @else
                <div class="col-lg-4 col-md-6 col-sm-6">
                    Không có sản phẩm nào
                </div>
            @endif
        </div>
    </div>
</section>
<!-- Product Section End -->
@if ($shop->description)
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__tab" style="padding-top:0 !important">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active">Mô tả shop</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <p>{!! $shop->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Product Details Section End -->
@stop