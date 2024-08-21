@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Sửa Banner</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Tiêu Đề</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Mô Tả</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description', $banner->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @if($banner->image)
                                    <img src="{{ Storage::url($banner->image) }}" width="100px" class="mt-2">
                                @endif
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" {{ $banner->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Kích Hoạt</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
