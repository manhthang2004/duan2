@extends('layouts.app')

@section('content')
<main id="main" role="main">
    <section id="checkout-container" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <i class="fa fa-credit-card fa-5x text-primary mb-3"></i>
                <h1 class="display-4 font-weight-bold">Thanh Toán Đơn Hàng</h1>
                <p class="lead text-muted">Hoàn tất đơn hàng của bạn với các thông tin dưới đây</p>
            </div>

            <div class="row">
                <!-- Giỏ hàng -->
                <div class="col-md-4 order-md-2 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Giỏ Hàng Của Bạn</h4>
                            <span class="badge badge-light badge-pill float-right">{{ $cartItems->count() }}</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($cartItems as $item)
                                @php
                                    $productPrice = $item->product->price - $item->product->discount;
                                    $totalItemPrice = $productPrice * $item->quantity;
                                    $totalItemPriceFormatted = number_format($totalItemPrice, 0, '.', '.');
                                @endphp
                                <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
                                    <div>
                                        <h6 class="my-0 font-weight-bold">{{ $item->product->pro_name }}</h6>
                                        <small class="text-muted">Màu: {{ $item->color->color_name }}</small><br>
                                        <small class="text-muted">Số Lượng: {{ $item->quantity }}</small>
                                    </div>
                                    <span class="text-muted">{{ $totalItemPriceFormatted }}đ</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center">Giỏ hàng của bạn đang trống.</li>
                            @endforelse
                            <li class="list-group-item d-flex justify-content-between border-0 bg-light">
                                <span>Tổng Tiền</span>
                                <strong>{{ number_format($totalAmount, 0, '.', '.') }}đ</strong>
                            </li>
                            @if ($voucherDiscount > 0)
                                <li class="list-group-item d-flex justify-content-between bg-light border-0">
                                    <div class="text-success">
                                        <h6 class="my-0">Mã Giảm Giá (Voucher)</h6>
                                        <span class="text-success">{{ $voucherCode }}</span>
                                    </div>
                                    <span class="text-success">-{{ $voucherDiscount }}%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between border-0">
                                    <span>=</span>
                                    <strong>{{ number_format($discountedTotal, 0, '.', '.') }}đ</strong>
                                </li>
                            @endif
                        </ul>
                        <form class="card-footer p-3 border-top-0 shadow-sm" action="{{ route('apply_voucher') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="voucher_code" placeholder="Nhập mã giảm giá" value="{{ old('voucher_code') }}" aria-label="Mã giảm giá">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Áp Dụng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Thông tin thanh toán -->
                <div class="col-md-8 order-md-1">
                    <div class="card border-light shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Thông Tin Thanh Toán</h4>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('cart.checkout.post') }}">
                                @csrf
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border-primary" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                                    <label for="firstname">Họ</label>
                                    <div class="invalid-feedback">
                                        Vui lòng điền họ của bạn.
                                    </div>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border-primary" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                                    <label for="lastname">Tên</label>
                                    <div class="invalid-feedback">
                                        Vui lòng điền tên của bạn.
                                    </div>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="tel" class="form-control border-primary" name="tel" id="tel" value="{{ old('tel', Auth::user()->tel) }}" required>
                                    <label for="tel">Số Điện Thoại</label>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại hợp lệ.
                                    </div>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control border-primary" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập địa chỉ email hợp lệ.
                                    </div>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border-primary" name="address" id="address" value="{{ old('address', Auth::user()->address) }}" required>
                                    <label for="address">Địa Chỉ</label>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập địa chỉ giao hàng của bạn.
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h4 class="mb-4">Phương Thức Thanh Toán</h4>
                                <input type="hidden" name="total_amount" value="{{ $discountedTotal }}">
                                <input type="hidden" name="voucher_discount" value="{{ $voucherDiscount }}">
                                <input type="hidden" name="voucher_code" value="{{ $voucherCode }}">
                                
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit" name="payment_method" value="COD">
                                        <i class="fa fa-credit-card mr-2"></i> Thanh Toán COD
                                    </button>
                                    <button class="btn btn-success btn-lg" type="submit" name="payment_method" value="VN PAY">
                                        <i class="fa fa-globe mr-2"></i> Thanh Toán VN PAY
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
