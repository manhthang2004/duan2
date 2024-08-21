@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sửa Sản Phẩm</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="pro_name">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="pro_name" name="pro_name" value="{{ old('pro_name', $product->pro_name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="discount">Giá Khuyến Mại</label>
                                <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount) }}">
                            </div>
                            <div class="form-group">
                                <label for="img">Ảnh</label>
                                <input type="file" class="form-control" id="img" name="img">
                                @if ($product->img)
                                    <img src="{{ Storage::url($product->img) }}" width="100px" alt="Product Image">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="detail">Mô Tả</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3" required>{{ old('detail', $product->detail) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Danh Mục</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name ?? 'Không có danh mục' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Hãng</label>
                                <select class="form-control" id="brand_id" name="brand_id" required>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name ?? 'Không có thương hiệu' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
