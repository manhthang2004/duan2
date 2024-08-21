@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="text-decoration-none">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh Mục</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-4 text-md-end">
            @if (isset($products))
                <p>Tìm thấy {{ $products->total() }} Sản Phẩm</p>
            @endif
        </div>
    </div>
</div>

<div class="container pb-3 mb-5" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-12 col-md-4 col-lg-3 col-xl-3 mt-4">
            <form action="{{ route('product.list') }}" method="GET" class="filter-form p-4">
                @csrf

                <!-- Hãng -->
                <div class="mb-4">
                    <h5 class="filter-title">Hãng</h5>
                    <div class="list-group">
                        <input type="radio" name="brand" value="all" id="brand-all" class="d-none" {{ request('brand') === 'all' ? 'checked' : '' }}>
                        <label for="brand-all" class="list-group-item list-group-item-action {{ request('brand') === 'all' ? 'active' : '' }}">Tất cả</label>
                        
                        @foreach ($brands as $brand)
                            <input type="radio" name="brand" value="{{ $brand->id }}" id="brand-{{ $brand->id }}" class="d-none" {{ request('brand') == $brand->id ? 'checked' : '' }}>
                            <label for="brand-{{ $brand->id }}" class="list-group-item list-group-item-action {{ request('brand') == $brand->id ? 'active' : '' }}">{{ $brand->name }}</label>
                        @endforeach
                    </div>
                </div>
                
                <hr>
                
                <!-- Loại Sản Phẩm -->
                <div class="mb-4">
                    <h5 class="filter-title">Loại Sản Phẩm</h5>
                    <div class="list-group">
                        <input type="radio" name="cate" value="all" id="cate-all" class="d-none" {{ request('cate') === 'all' ? 'checked' : '' }}>
                        <label for="cate-all" class="list-group-item list-group-item-action {{ request('cate') === 'all' ? 'active' : '' }}">Tất cả</label>
                        
                        @foreach ($categories as $category)
                            <input type="radio" name="cate" value="{{ $category->id }}" id="cate-{{ $category->id }}" class="d-none" {{ request('cate') == $category->id ? 'checked' : '' }}>
                            <label for="cate-{{ $category->id }}" class="list-group-item list-group-item-action {{ request('cate') == $category->id ? 'active' : '' }}">{{ $category->name }}</label>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-2" type="submit">Lọc</button>
            </form>

            <div class="dropdown-menu-end d-flex flex-wrap justify-content-start mt-4">
                <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sắp Xếp
                </button>
                <ul class="dropdown-menu p-0">
                    <li><a class="dropdown-item" href="#">Mới Nhất</a></li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item" href="#">Giá Từ Thấp -> Cao</a></li>
                    <li><a class="dropdown-item" href="#">Giá Từ Cao -> Thấp</a></li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 col-xl-9 mt-4">
            <div class="row">
                @foreach ($products as $pro)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        @php
                            $price_format = number_format($pro->price, 0, '.', '.');
                            $discount_format = number_format($pro->discount, 0, '.', '.');
                            $sale = ($pro->discount / $pro->price ) *100;
                            $newprice = number_format($pro->price - $pro->discount, 0, '.', '.');
                        @endphp
                        <div class="card product-card border-0 shadow-sm rounded overflow-hidden">
                            <a href="{{ route('product.show', ['id' => $pro->id]) }}" class="text-decoration-none text-dark">
                                <div class="position-relative">
                                    <img src="{{ Storage::url($pro->img) }}" class="card-img-top" alt="">
                                    @if ($pro->discount > 0)
                                        <span class="badge bg-danger position-absolute top-0 start-0 rounded-end p-2 m-2">- {{ ceil($sale) }}%</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pro->pro_name }}</h5>
                                    <p class="card-text">
                                        @if ($pro->discount != 0)
                                            <del class="text-muted">{{ $price_format }}đ</del>
                                            <span class="text-danger fw-bold">{{ $newprice }}đ</span>
                                        @else
                                            <span class="text-primary fw-bold">{{ $price_format }}đ</span>
                                        @endif
                                    </p>
                                    <p class="card-text">
                                        <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star text-warning"></i>
                                        <span class="rate-quantity">(31 đánh giá)</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3">
                    @if ($products->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link">Trước</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}">Trước</a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}">Sau</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link">Sau</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .filter-form {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .filter-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .list-group-item {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .list-group-item.active {
        background-color: #007bff;
        color: #fff;
    }

    .product-card {
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .badge {
        font-size: 0.9rem;
    }

    .rate {
        font-size: 1rem;
    }

    .star-rate {
        font-size: 1rem;
    }
</style>
@endsection
