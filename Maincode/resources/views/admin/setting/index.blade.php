@extends('admin.layouts.index')

@section('title', 'Thiết lập trang web')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Thiết lập trang web</h1>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('setting.edit', ['id' => $setting->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="title">Tiêu đề trang: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Nhập tiêu đề trang" id="title" name="title"
                        value="{{ $setting->title }}">
                </div>
                <div class="form-group">
                    <label for="email">Email: <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="Nhập email" id="email" name="email"
                        value="{{ $setting->email }}">
                </div>
                <div class="form-group">
                    <label for="tel">Số điện thoại: <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" placeholder="Nhập số điện thoại" id="tel"
                        name="tel" value="{{ $setting->tel }}">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" id="address" name="address"
                        value="{{ $setting->address }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
