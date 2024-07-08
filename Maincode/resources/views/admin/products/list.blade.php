@extends('admin.layouts.index')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Hãng</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng</th>
                            <th>Số lượng bán</th>
                            <th>Lượt xem</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $count }}</td>
                                <td><img src="{{ asset($product->image_path) }}" width=60px ></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price,-3,',',',') }} VND</td>
                                <td>{{ $product->cate_title }}</td>
                                <td>{{ $product->brand_title }}</td>
                                <td>{{ $product->supplier_title }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->qty_buy }}</td>
                                <td>{{ $product->view }}</td>
                                <td>{{ $product->status == 1 ? 'Hiện' : 'Ẩn' }}</td>
                                <td>
                                    <a href="{{ route('product.delete',['id'=>$product->id]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa sản phẩm này ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('product.edit.form',['id'=>$product->id]) }}"
                                        class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    @if ($product->status == 1)
                                        <a href="{{ route('product.update.status',['id' => $product->id, 'status' => 0]) }}"
                                            onclick="return confirm('Bạn muốn ẩn sản phẩm này ?')"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-ban"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('product.update.status',['id' => $product->id, 'status' => 1]) }}""
                                            class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
