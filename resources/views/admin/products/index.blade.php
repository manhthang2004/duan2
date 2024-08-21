@extends('admin.index')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Danh Sách Sản Phẩm</h4>
                            <a href="{{ route('admin.products.create') }}"
                                class="btn btn-light text-primary border-0 shadow-sm">Thêm Sản Phẩm</a>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="min-width: 845px">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá</th>
                                            <th>Giá Khuyến Mại</th>
                                            <th>Ảnh</th>
                                            <th>Mô Tả</th>
                                            <th>Danh Mục</th>
                                            <th>Hãng</th>
                                            <th>Màu Sắc</th> <!-- Thêm cột màu sắc -->
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->pro_name }}</td>
                                                <td class="text-end text-success">
                                                    {{ number_format($product->price, 0, ',', '.') }}đ</td>
                                                <td class="text-end text-danger">
                                                    {{ number_format($product->discount, 0, ',', '.') }}đ</td>
                                                <td><img src="{{ Storage::url($product->img) }}" width="50px"
                                                        class="rounded" alt="Product Image"></td>
                                                <td>{{ $product->detail }}</td>
                                                <td class="text-primary">{{ $product->category->name }}</td>
                                                <td class="text-info">{{ $product->brand->name }}</td>
                                                <td>
                                                    @foreach ($product->colorProducts as $color)
                                                        <div>
                                                            <img src="{{ Storage::url($color->image) }}" width="30px"
                                                                alt="Color Image">
                                                            <span>{{ $color->color_name }}</span>
                                                            <span>{{ $color->quantity }}</span>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="btn btn-warning text-white">Sửa</a>
                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger text-white"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="dataTables_paginate paging_simple_numbers" id="example_paginate"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
