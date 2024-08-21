@extends('layouts.app')

@section('content')
@php
    // Định dạng giá
    $price_format = number_format($product->price, 0, '.', '.');
    $discount_format = number_format($product->price - $product->discount, 0, '.', '.');
    $sale = $product->discount ? ($product->discount / $product->price) * 100 : 0;
    $newprice_format = number_format($product->price - $product->discount, 0, '.', '.');
    $image = $colorPro ? $colorPro->image : $product->img;
@endphp


    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Trang Chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="text-decoration-none">{{ $product->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->pro_name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container mb-3" style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
        <div class="row">
            <div class="col-md-6 col-xl-4 mb-3 mt-3">
                <div class="card" style="width: 100%;">
                    <div class="collection-img position-relative image-container">
                        <img src="{{ Storage::url($product->img) }}" class="card-img-top" alt="">
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-8 mb-3 mt-3">
                <div class="card-body">
                    <div class="product-title-details">{{ $product->pro_name }}</div>
                    <div class="all-price-details d-flex flex-wrap">
                        @if ($product->discount)
                            <del>{{ $price_format }}đ</del>
                            <span class="new-price-details">{{ $discount_format }}đ</span>
                            <span class="product-percent-details">-{{ ceil($sale) }}%</span>
                        @else
                            <span class="new-price-details">{{ $newprice_format }}đ</span>
                        @endif
                    </div>

                    <div class="all-product-details">
                        <span><strong>Hãng Sản Xuất: </strong>{{ $product->brand->name }}</span>
                        <span><strong>Bảo Hành: </strong>12 Tháng</span>
                        <span><strong>Trạng Thái: </strong>
                            <span id="product-status">
                                {{ $colorPro && $colorPro->quantity <= 0 ? 'Hết hàng' : 'Còn hàng' }}
                            </span>
                        </span>
                        
                        @if ($colorPro && $colorPro->quantity != 0)
                            <span><strong>Số Lượng: </strong><span id="product-quantity">{{ $colorPro->quantity }}</span></span>
                        @endif
                        <span><strong>Đã Bán: </strong>{{ $product->sold ?? 0 }}</span>
                    </div>
                    <hr>
                    <div>
                        <span class="rate-details">5.0 </span><i class="star-rate-details fa-solid fa-star"></i>
                        <span class="rate-quantity-details">(31 đánh giá)</span>
                        <a class="check-rate-details" href="#comments"><span>Xem đánh giá</span></a>
                    </div>

                    <div class="accompanying-services mt-2">
                        <span><i class="fa-solid fa-check"></i> Miễn phí giao hàng toàn quốc.</span>
                        <span><i class="fa-solid fa-check"></i> Hỗ trợ đổi mới trong 14 ngày.</span>
                        <span><i class="fa-solid fa-check"></i> Bảo hành chính hãng.</span>
                        <span><i class="fa-solid fa-check"></i> Trả Góp 0%.</span>
                    </div>
                    <hr>

                    <div>
                        <span><strong>Màu Sắc: </strong><br>
                            @foreach ($product->colorProducts as $lc)
                                <a href="{{ route('product.show', ['id' => $product->id, 'color' => $lc->id]) }}" class="color-option" data-id="{{ $lc->id }}" data-quantity="{{ $lc->quantity }}" data-image="{{ $lc->image }}">
                                    <button type="button" style="width:30px;height:30px;border-radius:50%;background-color:{{ $lc->color_name }};"></button>
                                </a>
                            @endforeach
                        </span>
                    </div>

                    <form id="product-form" action="{{ route('cart.add') }}" method="POST" class="form-submit">
                        @csrf
                        @if ($colorPro)
                            <input type="hidden" name="color_product_id" id="color-product-id" value="{{ $colorPro->id }}">
                        @endif
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="product_name" value="{{ $product->pro_name }}">
                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                        <input type="hidden" name="product_discount" value="{{ $product->discount }}">
                        <input type="hidden" name="product_image" value="{{ $image }}">
                        <input type="hidden" name="action" id="form-action" value="add_to_cart">
                    
                        @if ($colorPro)
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <strong style="font-size: x-large; margin-right: 10px;">Số Lượng:</strong>
                                <input id="product-quantity-input" style="text-align: center;" type="number" name="quantity" min="1" max="{{ $colorPro->quantity }}" value="1">
                            </div>
                        @endif
                        
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" id="buy-now-btn" name="action" value="buy_now">Mua Ngay</button>
                            <button type="submit" class="btn btn-secondary" id="add-to-cart-btn" name="action" value="add_to_cart">Thêm Vào Giỏ</button>
                        </div>
                        <div id="error-message" style="color: red; display: none;">Vui lòng chọn màu sắc.</div>
                    </form>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-3">
        <div class="row mt-3">
            <div class="col-md-7 me-3 mb-4" style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                <h4 class="mb-3" style="font-weight: bold; color: #343a40;">Mô Tả Sản Phẩm</h4>
                <div class="product-description" style="line-height: 1.6; color: #495057;">
                    {{ $product->detail }}
                </div>
            </div>
            

            <div class="container mb-3">
                <div class="row mt-3">
                    <div class="col-md-12" style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
                        <h4 class="mt-2 mb-3"><strong>Sản Phẩm Cùng Loại</strong></h4>
                        <div class="row">
                            @if ($relatedProducts->count() > 0)
                                @foreach ($relatedProducts as $value)
                                    @php
                                        $price_other_format = number_format($value->price, 0, '.', '.');
                                        $discount_other_format = number_format($value->price-$value->discount, 0, '.', '.');
                                        $sale_other =  ($value->discount / $value->price )* 100;
                                    @endphp
                                    <div class="col-md-4 mb-4">
                                        <div class="card product-card">
                                            <a href="{{ route('product.show', ['id' => $value->id]) }}">
                                                <img src="{{ Storage::url($value->img) }}" class="card-img-top" alt="{{ $value->pro_name }}">
                                            </a>
                                            <div class="card-body text-center">
                                                <h6 class="card-title">{{ $value->pro_name }}</h6>
                                                <div class="price-details">
                                                    @if ($value->discount)
                                                        <del class="text-muted">{{ $price_other_format }}đ</del>
                                                        <span class="new-price">{{ $discount_other_format }}đ</span>
                                                        <span class="discount-percentage">-{{ ceil($sale_other) }}%</span>
                                                    @else
                                                        <span class="new-price">{{ $price_other_format }}đ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">Chưa có sản phẩm liên quan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div id="comments" class="container mb-4 bg-white rounded-lg shadow-xl p-5">
        <h4 class="mb-4 text-center text-primary"><strong>Đánh Giá</strong></h4>
    
        <!-- Danh sách bình luận -->
        <div class="comment-list mb-4">
            @forelse ($comments as $comment)
                <div class="comment-item mb-4 p-4 border border-primary rounded-lg bg-light shadow-md transition-transform transform hover:scale-105">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-2">
                                <img src="https://via.placeholder.com/40" alt="Avatar" class="rounded-circle border border-primary">
                            </div>
                            <div>
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted d-block">{{ $comment->created_at->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0">{{ $comment->comment }}</p>
                </div>
            @empty
                <p class="text-center text-muted">Chưa có bình luận nào.</p>
            @endforelse
        </div>
    
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('submit_comment') }}" method="POST" class="p-4 border border-primary rounded-lg bg-light shadow-md transition-transform transform hover:scale-105">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="comment" class="form-label text-primary">Bình luận:</label>
                        <textarea class="form-control border-0 rounded-lg shadow-sm" id="comment" name="comment" rows="5" placeholder="Nhập bình luận của bạn" required></textarea>
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Gửi Bình Luận</button>
                </form>
            </div>
        </div>
    </div>
    
    
    
    
    
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const colorOptions = document.querySelectorAll('.color-option');
            const productImage = document.getElementById('product-image');
            const productQuantityInput = document.getElementById('product-quantity-input');
            const colorProductIdInput = document.getElementById('color-product-id');
            const buyNowBtn = document.getElementById('buy-now-btn');
            const errorMessage = document.getElementById('error-message');
            
            let selectedColorId = colorProductIdInput.value;

            colorOptions.forEach(option => {
                option.addEventListener('click', function () {
                    const quantity = this.getAttribute('data-quantity');
                    const image = this.getAttribute('data-image');
                    const colorId = this.getAttribute('data-id');

                    productImage.src = `{{ asset('img/') }}/${image}`;
                    productQuantityInput.max = quantity;
                    colorProductIdInput.value = colorId;
                    selectedColorId = colorId;
                    errorMessage.style.display = 'none'; 
                });
            });

            buyNowBtn.addEventListener('click', function (event) {
                if (!selectedColorId) {
                    event.preventDefault(); 
                    alert('Vui lòng chọn màu sắc.');
                    errorMessage.style.display = 'block'; 
                } else {
                    document.getElementById('form-action').value = 'buy_now';
                    document.getElementById('product-form').submit();
                }
            });
        });
    </script>
@endsection


