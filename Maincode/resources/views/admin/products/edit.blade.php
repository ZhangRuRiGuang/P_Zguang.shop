@extends('admin.layouts.index')

@section('title', 'Cập nhật sản phẩm')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Cập nhật sản phẩm</h1>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('product.edit', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="title">Tên sản phẩm: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" id="title" name="title"
                        value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="price">Giá tiền: <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Nhập giá tiền" id="price" name="price"
                        value="{{ $product->price }}" min=1>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng: <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Nhập số lượng" id="quantity" name="quantity"
                        value="{{ $product->qty }}" min=1>
                </div>
                <div class="form-group">
                    <label for="view">Lượt xem:</label>
                    <input type="number" class="form-control" placeholder="Nhập số lượt xem" id="view" name="view"
                        min=0 value="{{ $product->view }}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm:</label>
                    <textarea class="form-control" id="description" name="content">{!! $product->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục sản phẩm: <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            @if ($category->id === $product->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Hãng sản phẩm: <span class="text-danger">*</span></label>
                    <select class="form-control" name="brand_id" id="brand_id">
                        @foreach ($brands as $brand)
                            @if ($brand->id === $product->brand_id)
                                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                            @else
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Nhà cung cấp: <span class="text-danger">*</span></label>
                    <select class="form-control" name="supplier_id" id="supplier_id">
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ $supplier->id === $product->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Chọn hình ảnh:</label>
                    <div class="custom-file">
                        <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg" />
                    </div>
                </div>
                <div class="image-preview mb-4" id="imagePreview">
                    <img src="{{ asset($product->image_path) }}" alt="Image Preview" class="image-preview__image"
                        style="display:block;" />
                    <span class="image-preview__default-text" style="display:none;">Hình ảnh</span>
                </div>
                <br />
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
