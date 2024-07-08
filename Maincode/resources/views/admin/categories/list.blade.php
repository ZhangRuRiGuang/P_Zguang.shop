@extends('admin.layouts.index')

@section('title', 'Danh sách danh mục')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Danh mục sản phẩm</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>
                                    <a href="{{ asset($category->image_path) }}" target="_blank"><img
                                            src="{{ asset($category->image_path) }}" width=60></a>
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status == 1 ? 'Hiện' : 'Ẩn' }}</td>
                                <td>
                                    <a href="{{ route('category.delete', ['id' => $category->id]) }}"
                                        class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('Bạn có muốn xóa danh mục này ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('category.edit.form', ['id' => $category->id]) }}"
                                        class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    @if ($category->status == 1)
                                        <a href="{{ route('category.update.status', ['id' => $category->id, 'status' => 0]) }}"
                                            onclick="return confirm('Bạn muốn ẩn danh mục này ?')"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-ban"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('category.update.status', ['id' => $category->id, 'status' => 1]) }}"
                                            class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
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
