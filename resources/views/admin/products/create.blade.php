@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Sản Phẩm Mới</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="pro_name">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="pro_name" name="pro_name" value="{{ old('pro_name') }}" required>
                                @error('pro_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="discount">Giá Khuyến Mại</label>
                                <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}">
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="img">Ảnh</label>
                                <input type="file" class="form-control" id="img" name="img" required>
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="detail">Mô Tả</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3" required>{{ old('detail') }}</textarea>
                                @error('detail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Danh Mục</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name ?? 'Không có danh mục' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Hãng</label>
                                <select class="form-control" id="brand_id" name="brand_id" required>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name ?? 'Không có thương hiệu' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
