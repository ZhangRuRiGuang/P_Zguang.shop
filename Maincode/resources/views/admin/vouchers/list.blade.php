@extends('admin.layouts.index')

@section('title', 'Danh sách mã khuyến mãi')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Mã khuyến mãi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã khuyến mãi</th>
                            <th>Mệnh giá</th>
                            <th>Số lượng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $voucher->code }}</td>
                                <td>{{ number_format($voucher->price,-3,',',',') }} VND</td>
                                <td>{{ $voucher->qty }}</td>
                                <td>
                                    <a href="{{ route('voucher.delete',['id'=>$voucher->code]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa mã khuyến mãi này ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('voucher.edit.form',['id'=>$voucher->code]) }}"
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
