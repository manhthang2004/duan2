@extends('admin.index')

@section('content')
<style>
    img.color-image {
    background-color: transparent;
    border-radius: 4px;
}

</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Danh Sách Màu Sắc</h4>
                        <a href="{{ route('admin.colors.create') }}" class="btn btn-light text-primary border-0 shadow-sm">Thêm Màu Sắc</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản Phẩm</th>
                                        <th>Tên Màu</th>
                                        <th>Ảnh</th>
                                        <th>Số Lượng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colors as $color)
                                        <tr>
                                            <td>{{ $color->id }}</td>
                                            <td>{{ $color->product->pro_name }}</td>
                                            <td>{{ $color->color_name }}</td>
                                            <td><img src="{{ Storage::url($color->image) }}" width="50px" alt="Color Image" class="color-image"></td>
                                            <td>{{ $color->quantity }}</td>
                                            <td>
                                                <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-warning text-white">Sửa</a>
                                                <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
