@extends('admin.index')

@section('content')
<style>
    img.banner-image {
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
                        <h4 class="card-title">Danh Sách Banner</h4>
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-light text-primary border-0 shadow-sm">Thêm Banner</a>
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
                                        <th>Tiêu Đề</th>
                                        <th>Ảnh</th>
                                        <th>Mô Tả</th>
                                        <th>Trạng Thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>{{ $banner->title }}</td>
                                            <td><img src="{{ Storage::url($banner->image) }}" width="100px" alt="Banner Image" class="banner-image"></td>
                                            <td>{{ $banner->description }}</td>
                                            <td>{{ $banner->status ? 'Kích Hoạt' : 'Ngưng Kích Hoạt' }}</td>
                                            <td>
                                                <a href="{{ route('admin.banners.show', $banner->id) }}" class="btn btn-success text-white">Xem</a>

                                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-warning text-white">Sửa</a>


                                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
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
