@extends('admin.layouts.index')

@section('title', 'Danh sách nhà cung cấp')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Nhà cung cấp</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>
                                    <a href="{{ route('supplier.delete',['id'=>$supplier->id]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa nhân viên này ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('supplier.edit.form',['id'=>$supplier->id]) }}"
                                        class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
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
