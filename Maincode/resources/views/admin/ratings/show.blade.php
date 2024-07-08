@extends('admin.layouts.index')

@section('title', 'Chi tiết đánh giá')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Chi tiết đánh giá</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Người dùng</th>
                            <th>Số sao</th>
                            <th>Đánh giá</th>
                            <th>Ảnh đính kèm</th>
                            <th>Ngày đánh giá</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($ratings as $row)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->star }}</td>
                                <td>{{ $row->comment }}</td>
                                <td>
                                    @if ($row->image)
                                        <a href="{{ asset($row->image) }}" target="_blank"><img src="{{ asset($row->image) }}"
                                            width=60></a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($row->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('rating.delete', ['id' => $row->id]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa đánh giá này ?')">
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
