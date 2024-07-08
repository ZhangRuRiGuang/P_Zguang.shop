@extends('admin.layouts.index')

@section('title', 'Danh sách cửa hàng')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Cửa hàng</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Tên cửa hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Chủ cửa hàng</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($shops as $shop)
                            <tr>
                                <td>{{ $count }}</td>
                                <td><img src="{{ asset($shop->image) }}" width=60px></td>
                                <td>{{ $shop->name }}</td>
                                <td>{{ $shop->phone }}</td>
                                <td>{{ $shop->address }}</td>
                                <td>{{ \App\Models\Admin::find($shop->admin_id)->name }}</td>
                                <td>{{ $shop->status == 1 ? 'Đang hoạt động' : 'Tạm ngưng hoạt động' }}</td>
                                <td>
                                    <a href="{{ route('shop.delete', ['id' => $shop->id]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa cửa hàng này ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @if ($shop->status == 1)
                                        <a href="{{ route('shop.disable', ['id' => $shop->id]) }}"
                                            onclick="return confirm('Bạn muốn tạm ngưng hoạt động cửa hàng này ?')"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('shop.enable', ['id' => $shop->id]) }}"
                                            onclick="return confirm('Bạn muốn mở hoạt động cửa hàng này ?')"
                                            class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-unlock"></i>
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
