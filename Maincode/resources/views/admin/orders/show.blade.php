@extends('admin.layouts.index')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if (!in_array($order->status, [3, 4]))
                <form method="POST" action="{{ route('order.edit', ['id' => $order->id]) }}" class="form-inline mb-3">
                    @csrf
                    <select name="status" class="form-control">
                        @if ($order->status == 0)
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đang chuẩn bị đơn hàng</option>
                            <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Hủy</option>
                        @elseif ($order->status == 1)
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đang giao hàng</option>
                        @elseif ($order->status == 2)
                            <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đã giao hàng</option>
                        @endif
                    </select>
                    <button type="submit" name="submit" class="btn btn-primary ml-2">Cập nhật</button>
                </form>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($orders_detail as $row)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ number_format($row->price,-3,',',',') }} VND</td>
                            </tr>
                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
