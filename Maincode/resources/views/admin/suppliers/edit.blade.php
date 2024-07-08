@extends('admin.layouts.index')

@section('title', 'Cập nhật nhà cung cấp')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Cập nhật nhà cung cấp</h1>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('supplier.edit', ['id' => $supplier->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="name">Tên nhà cung cấp: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Nhập tên nhà cung cấp" id="name"
                        name="name" value="{{ $supplier->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="Nhập email" id="email" name="email"
                        value="{{ $supplier->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại: <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" placeholder="Nhập số điện thoại" id="phone"
                        name="phone" pattern="[0-9]{10}" value="{{ $supplier->phone }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
