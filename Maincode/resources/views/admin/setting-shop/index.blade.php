@extends('admin.layouts.index')

@section('title', 'Thiết lập cửa hàng')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Thiết lập cửa hàng</h1>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('setting.shop.edit', ['id' => $setting['id']]) }}" method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="inputName">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" id="inputName" class="form-control" placeholder="Họ tên" name="name"
                        value="{{ $user->name }}" autofocus required>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email <span class="text-danger">*</span></label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email"
                        value="{{ $user->email }}" autofocus required>
                </div>
                <div class="form-group">
                    <label for="inputShop">Tên cửa hàng</label>
                    <input type="text" id="inputShop" class="form-control" placeholder="Tên cửa hàng" name="shop"
                        value="{{ $setting->name }}" autofocus required>
                </div>
                <div class="form-group">
                    <label for="inputPhone">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="tel" id="inputPhone" class="form-control" placeholder="Số điện thoại" name="phone"
                        pattern="[0-9]{10}" value="{{ $setting->phone }}" autofocus required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" id="inputAddress" class="form-control" placeholder="Địa chỉ" name="address"
                        value="{{ $setting->address }}" autofocus required>
                </div>
                <div class="form-group">
                    <label for="content">Mô tả cửa hàng</label>
                    <textarea class="form-control" placeholder="Mô tả cửa hàng" id="content" name="des" cols="10" rows="3"
                        autofocus>{{ $setting->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Chọn hình ảnh:</label>
                    <div class="custom-file">
                        <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg" />
                    </div>
                </div>
                <div class="image-preview mb-4" id="imagePreview">
                    <img src="{{ asset($setting->image) }}" alt="Image Preview" class="image-preview__image"
                        style="display:block;" />
                    <span class="image-preview__default-text" style="display:none;">Hình ảnh</span>
                </div>
                <br />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
