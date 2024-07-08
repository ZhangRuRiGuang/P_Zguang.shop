@extends('admin.layouts.index')

@section('title', 'Danh sách người dùng')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Người dùng</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tài khoản người dùng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Giới tính</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->sex == 0 ? 'Nam' : 'Nữ' }}</td>
                                <td>
                                    <a href="{{ route('customer.delete',['id' => $customer->id]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa tài khoản này, nếu xóa thì mọi đơn hàng liên quan cũng sẽ bị xóa ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
