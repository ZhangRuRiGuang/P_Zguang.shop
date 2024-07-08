@extends('admin.layouts.index')

@section('title', 'Thêm sản phẩm')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Thêm sản phẩm</h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="title">Tên sản phẩm: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="price">Giá tiền: <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Nhập giá tiền" id="price" name="price"
                        min=1>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng: <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Nhập số lượng" id="quantity" name="quantity"
                        min=1>
                </div>
                <div class="form-group">
                    <label for="view">Lượt xem:</label>
                    <input type="number" class="form-control" placeholder="Nhập số lượt xem" id="view" name="view"
                        min=0>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả sản phẩm:</label>
                    <textarea class="form-control" id="description" name="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục sản phẩm: <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Hãng sản phẩm: <span class="text-danger">*</span></label>
                    <select class="form-control" name="brand_id" id="brand_id">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Nhà cung cấp: <span class="text-danger">*</span></label>
                    <select class="form-control" name="supplier_id" id="supplier_id">
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Chọn hình ảnh: <span class="text-danger">*</span></label>
                    <div class="custom-file">
                        <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg" required />
                    </div>
                </div>
                <div class="image-preview mb-4" id="imagePreview">
                    <img src="" alt="Image Preview" class="image-preview__image" />
                    <span class="image-preview__default-text">Hình ảnh</span>
                </div>
                <br />
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
@endsection
