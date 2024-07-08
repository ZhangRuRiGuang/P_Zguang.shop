@extends('client.layouts.template')

@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/comment.css') }}">
@stop

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text bg-dark">
                    <h2>{{ $product->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{  asset($product->image_path) }}" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->name }}</h3>
                    <div class="product__details__rating">
                        @for ($count = 1;$count <= 5;$count++)
                            @php
                                if (isset($rating[0]) && $count <= round($rating[0]->avgStar)) {
                                    $color = 'color:#edbb0e;';
                                } else {
                                    $color = 'color:#ccc;';
                                }
                            @endphp
                            <i class="fa fa-star" style="{{ $color }}"></i>
                        @endfor
                        <span>({{ $rating[0]->countRating ?? 0 }} đánh giá)</span>
                    </div>
                    <div class="product__details__price">{{ number_format($product->price,-3,',',',') }} VND</div>
                    @if (!Auth::guard('admin')->check())
                      <a href="javascript:void(0)" onclick="addToCart({{ $product->id }});" class="primary-btn">THÊM GIỎ HÀNG</a> 
                    @endif
                    @if (Auth::check())
                      @if (!in_array($product->id,$wishlist))
                        <a href="{{ route('client.add.wishlist',['id' => $product->id]) }}"><button type="button" class="btn btn-danger" style="padding:0.84rem;">YÊU THÍCH</button></a>
                      @else
                        <a href="{{ route('client.add.wishlist',['id' => $product->id]) }}"><button type="button" class="btn btn-secondary" style="padding:0.84rem;" disabled>ĐÃ YÊU THÍCH</button></a>
                      @endif
                    @endif
                    <ul>
                        <li><b>Danh mục</b> <span>{{ $product->cate_title }}</span></li>
                        <li><b>Hãng sản phẩm</b> <span>{{ $product->brand_title }}</span></li>
                        <li><b>Nhà cung cấp</b> <span>{{ $product->supplier_title }}</span></li>
                        <li><b>Trạng thái</b> <span>{{ $product->qty > 0 ? 'Còn hàng' : 'Hết hàng' }}</span></li>
                        <li><b>Lượt xem</b> <span>{{ $product->view }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
              <a href="{{ route('shop.detail', ['id' => $product->shop_id]) }}">
                <div class="d-flex p-4" style="background-color: #7f7e7e;">
                  <img src="{{ asset(\App\Models\Shop::find($product->shop_id)->image) }}" class="img-thumbnail" width="120"/>
                  <div class="ml-4 text-white">
                      <span style="font-weight:bold;font-size:24px;">{{ \App\Models\Shop::find($product->shop_id)->name }}</span>
                      <p><i>Chủ gian hàng: {{ \App\Models\Admin::find(\App\Models\Shop::find($product->shop_id)->admin_id)->name }}</i></p>
                      <p><i>Số điện thoại: {{ \App\Models\Shop::find($product->shop_id)->phone }}</i></p>
                      <p><i>Địa chỉ: {{ \App\Models\Shop::find($product->shop_id)->address }}</i></p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active">Mô tả sản phẩm</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="product__details__tab">
                  <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active">Đánh giá</a>
                      </li>
                  </ul>
                  <div class="tab-content">
                      <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <h5 class="text-uppercase pb-80 mb-5">Đã có {{ $ratings->count() }} đánh giá về sản phẩm này</h5>
                        <!-- Start comment-sec Area -->
                        <div class="comment-sec-area">
                          <div class="container">
                            <div class="row flex-column">
                            <div class="comment">
                                  @foreach ($ratings as $rating)
                                    <div class="comment-list comment-container">
                                      <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                          <div class="thumb">
                                            <img src="{{ asset('client/img/people.png') }}" alt="Avatar" width="50px">
                                          </div>
                                          <div class="desc mb-4">
                                            <h5><a href="javascript:void(0)">{{ $rating->user->name }}</a></h5>
                                            <div class="date">{{ date('d/m/Y H:i:s', strtotime($rating->created_at)) }}</div>
                                            @for ($count = 1;$count <= 5;$count++)
                                                @php
                                                    if ($count <= $rating->star) {
                                                        $color = 'color:#edbb0e;';
                                                    } else {
                                                        $color = 'color:#ccc;';
                                                    }
                                                @endphp
                                                <i class="fa fa-star" style="{{ $color }}"></i>
                                            @endfor
                                            @if ($rating->image)
                                                <div class="mt-2 mb-2"><a href="{{ asset($rating->image) }}" target="_blank"><img src="{{ asset($rating->image) }}"
                                                width=100></a></div>
                                            @endif
                                            <p class="comment">
                                              {{ $rating->comment }}
                                            </p>
                                        </div>
                                      </div>
                                    </div>
                                  @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End comment-sec Area -->
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-12">
            <div class="product__details__tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active">Đánh giá của bạn</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                      @if (Auth::check())
                            <p>Chất lượng sản phẩm <span class="text-danger">*</span>
                                @for ($count = 1;$count <= 5;$count++)
                                    @if ($count == 1)
                                        <i class="fa fa-star rating" id="{{ $product->id }}-{{ $count }}" data-index="{{ $count }}" data-product_id="{{ $product->id }}" style="color: #edbb0e; cursor: pointer;"></i>
                                    @else
                                        <i class="fa fa-star rating" id="{{ $product->id }}-{{ $count }}" data-index="{{ $count }}" data-product_id="{{ $product->id }}" style="color: #ccc; cursor: pointer;"></i>
                                    @endif
                                @endfor
                            </p>
                            <form class="mt-3" action="{{ route('add.rating') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="star" id="star" value="1">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                <div class="form-group">
                                    <label for="image">Ảnh đính kèm</label>
                                    <div class="custom-file">
                                        <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg">
                                    </div>
                                </div>
                                <div class="image-preview mb-4" id="imagePreview">
                                    <img src="" alt="Image Preview" class="image-preview__image" />
                                    <span class="image-preview__default-text">Hình ảnh</span>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung <span class="text-danger">*</span></label>
                                    <textarea class="form-control mb-10" name="comment" cols="5" rows="4"
                                    placeholder="Nhập đánh giá của bạn về sản phẩm này" required></textarea>
                                </div>
                                <button type="submit" name="submit" class="primary-btn mt-3" style="border: none;">Đánh giá</button>
                            </form>
                        @else
                            <a href="{{ route('auth.show.login') }}" class="primary-btn mt-3">Để đánh giá vui lòng đăng nhập</a>
                        @endif
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{  asset($product->image_path) }}">
                          @if (!Auth::guard('admin')->check())
                            <ul class="product__item__pic__hover">
                                <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }});"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                          @endif
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                            <h5>{{ number_format($product->price,-3,',',',') }} VND</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Product Section End -->
@stop