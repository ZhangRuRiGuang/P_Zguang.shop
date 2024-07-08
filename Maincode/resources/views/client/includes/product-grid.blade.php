@if ($products->count() > 0)
    @foreach ($products as $product)
        @if (\App\Models\Shop::find($product->shop_id)->status == 1)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->image_path) }}">
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
        @endif
    @endforeach
    <div class="col-lg-12 col-md-12 col-sm-12">
        {!! $products->links() !!}
    </div>
@else
    <div class="col-lg-4 col-md-6 col-sm-6">
        Không có sản phẩm nào
    </div>
@endif