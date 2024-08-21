@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Sửa Màu Sắc</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.colors.update', $color->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="product_id" class="form-label">Sản Phẩm</label>
                                <select id="product_id" name="product_id" class="form-select">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $product->id == $color->product_id ? 'selected' : '' }}>
                                            {{ $product->pro_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="color_name" class="form-label">Tên Màu</label>
                                <input type="text" id="color_name" name="color_name" class="form-control" value="{{ old('color_name', $color->color_name) }}">
                                @error('color_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Ảnh</label>
                                <input type="file" id="image" name="image" class="form-control">
                                @if($color->image)
                                    <img src="{{ Storage::url($color->image) }}" width="100px" alt="Current Image">
                                @endif
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số Lượng</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $color->quantity) }}">
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Quay Lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
