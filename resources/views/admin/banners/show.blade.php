@extends('admin.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">{{ $banner->title }}</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5>Mô Tả:</h5>
                        <p>{{ $banner->description }}</p>
                    </div>
                    <div class="mb-3 text-center">
                        <h5>Hình Ảnh:</h5>
                        <img src="{{ asset('storage/' . $banner->image) }}" class="img-fluid" style="max-width: 100%; height: auto;">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Trạng Thái:</h5>
                            <p class="badge {{ $banner->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $banner->status ? 'Đang kích hoạt' : 'Chưa kích hoạt' }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-primary">Quay Lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
