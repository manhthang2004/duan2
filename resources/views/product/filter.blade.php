@extends('layouts.app')

@section('content')


<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 mb-3">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="text-decoration-none">Trang
                            Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh Mục</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-4 text-md-end">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                @if (isset($_POST['btn_search']) || isset($_POST['btn_filter']))
                    @if (isset($count))
                        <p>Tìm thấy {{ $count }} Sản Phẩm</p>
                    @else
                        <p>Không có sản phẩm phù hợp.</p>
                    @endif
                @endif
            </nav>
        </div>
    </div>
</div>

<div class="container pb-3 mb-5" style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
    <div class="row">
        <!-- Bộ Lọc Tổng Hợp -->
        <div class="col-12 col-md-4 col-lg-3 col-xl-2 mt-4" style="border-right: 1px solid gainsboro;">
            <div>
                <form action="{{ route('product.filter') }}" method="POST">
                    @csrf
                    <h5>Hãng</h5>
                    <div class="d-flex flex-wrap align-items-center">
                        <input class="col-1 col-md-2" type="radio" name="brand" value="all" checked> Tất cả
                        @foreach ($brands as $brand)
                                <input class="col-1 col-md-2" type="radio" name="brand" value="{{ $brand->id }}">
                                {{ $brand->name }}
                        @endforeach
                    </div>
                    <hr>
                    <h5 class="mt-3">Loại Sản Phẩm</h5>
                    <div class="d-flex flex-wrap align-items-center">
                        <input class="col-1 col-md-2" type="radio" name="cate" value="all" checked> Tất cả
                        @foreach ($categories as $category)
                        <input class="col-1 col-md-2" type="radio" name="cate" value="{{ $category->id }}">
                        {{ $category->cate_name }}
                        @endforeach
                    </div>
                    <input class="btn mt-2 w-100" type="submit" name="btn_filter" value="Lọc">
                </form>
            </div>
            <div class="dropdown-menu-end d-flex flex-wrap justify-content-start mt-4">
                <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sắp Xếp
                </button>
                <ul class="dropdown-menu p-0">
                    <li><a class="dropdown-item" href="{{ route('product.list', ['load_type' => 'lastest']) }}">Mới
                            Nhất</a></li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item" href="{{ route('product.list', ['load_type' => 'price_up']) }}">Giá
                            Từ Thấp -> Cao</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('product.list', ['load_type' => 'price_down']) }}">Giá Từ Cao -> Thấp</a>
                    </li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item"
                            href="{{ route('product.list', ['load_type' => 'most_view']) }}">Được Xem Nhiều Nhất</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sản Phẩm -->
        @foreach ($filteredProducts as $pro)
            @php
                $price_format = number_format($pro->price, 0, ".", ".");
                $discount_format = number_format($pro->discount, 0, ".", ".");
                $sale = 100 - ($pro->discount / ($pro->price / 100));
            @endphp
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                <div class="card" style="width: 100%;">
                    <div class="collection-img position-relative">
                        <a href="{{ route('product.show', ['id' => $pro->id]) }}">
                            <img src="./Duan/image_product/{{ $pro->img }}" class="card-img-top" alt="...">
                        </a>
                        @if ($pro->discount > 0)
                            <span class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                                - {{ ceil($sale) }}%
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="product-title">
                            <a href="{{ route('product.show', ['id' => $pro->id]) }}">
                                {{ $pro->pro_name }}
                            </a>
                        </div>
                        <div>
                            @if ($pro->discount != 0)
                                <del class="old-price">{{ $price_format }}đ</del>
                                <span class="new-price">{{ $discount_format }}đ</span>
                            @else
                                <span class="new-price">{{ $price_format }}đ</span>
                            @endif
                        </div>
                        <div>
                            <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star"></i>
                            <span class="rate-quantity">(31 đánh giá)</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Phân Trang -->
</div>
@endsection