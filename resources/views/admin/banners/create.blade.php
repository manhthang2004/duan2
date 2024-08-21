@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Thêm Banner</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Tiêu Đề</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Mô Tả</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh</label>
                                <input type="file" class="form-control-file" id="image" name="image" required>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                                <label class="form-check-label" for="status">Kích Hoạt</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
