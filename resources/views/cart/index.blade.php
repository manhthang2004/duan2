@extends('layouts.app')

@section('title', 'MT Store - Giỏ Hàng')

@section('content')

    <style>
        .ui-w-40 {
            width: 40px !important;
            height: auto;
        }

        .card {
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .ui-product-color {
            display: inline-block;
            overflow: hidden;
            margin: .144em;
            width: .875rem;
            height: .875rem;
            border-radius: 10rem;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            vertical-align: middle;
        }

        .float-right {
            float: right;
        }

        th.text-right.py-3[style="width: 100px;"],
        td.text-right.font-weight-semibold.align-middle.p-4[style="width: 100px;"] {
            white-space: nowrap;
        }

        .delete_all_class {
            text-decoration: none;
            color: red;
        }

        .delete_all_class:hover {
            text-decoration: underline;
            color: red;
        }

        .pro_name {
            text-decoration: none;
        }

        .pro_name:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container p-0 my-5 clearfix"
        style="background-image: linear-gradient(to right, #0E2241 , #00b3ff); border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">

        <div class="card">
            <div class="card-header" style="background-image: linear-gradient(to right, #0E2241 , #00b3ff); color: white;">
                <p class="m-0 pt-2 pb-2" style="font-family: 'Tahoma'; font-weight: bold; font-size: x-large;">
                    Giỏ Hàng Của Bạn
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('cart.updateQuantity') }}" method="POST">
                        @csrf
                        <table class="table table-bordered mb-5">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center py-3" style="min-width: 400px;">Sản Phẩm & Chi Tiết</th>
                                    <th class="text-center py-3" style="width: 100px;">Ảnh</th>
                                    <th class="text-right py-3" style="width: 100px;">Giá</th>
                                    <th class="text-center py-3" style="width: 120px;">Số Lượng</th>
                                    <th class="text-right py-3" style="width: 100px;">Tổng Tiền</th>
                                    <th class="text-center py-3" style="width: 100px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totals = 0;
                                    $totalAmount = 0; 
                                @endphp
                                @foreach ($cartItems as $item)
                                    @php
                                        $discountedPrice = $item->product->price - $item->product->discount;
                                        $itemTotal = $discountedPrice * $item->quantity;
                                        $totalAmount += $itemTotal;

                                        $itemTotalFormatted = number_format($itemTotal, 0, '.', '.');
                                        $discountedPriceFormatted = number_format($discountedPrice, 0, '.', '.');
                                    @endphp
                                    <tr>
                                        <td class="p-4">
                                            <div class="media align-items-center d-flex">
                                                <a
                                                    href="{{ route('product.show', ['id' => $item->product_id, 'color' => $item->color_id ?? 'default-color']) }}">
                                                    <img src="{{ Storage::url($item->img) }}" class="card-img-top" alt="">
                                                    
                                                </a>

                                                <div class="media-body">
                                                    <a href="{{ route('product.show', ['id' => $item->product_id, 'color' => $item->color_id ?? 'default-color']) }}"
                                                        class="pro_name d-block text-dark">{{ $item->product_name }}</a>
                                                    <small>
                                                        <span class="text-muted"><strong>Tên </strong>:
                                                            {{ $item->product->pro_name }}</span><br>
                                                        <span class="text-muted"><strong>Hãng</strong>:
                                                            {{ $item->product->brand->name }}</span> <br>
                                                        <span class="text-muted"><strong>Màu</strong>:</span>
                                                        <span class="ui-product-color ui-product-color-sm align-text-bottom"
                                                            style="background-color: {{ $item->color->color_name ?? '#ffffff' }};"></span>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center p-4">
                                            <img src="{{ Storage::url($item->product->img) }}" class="img-fluid" width="100" height="100">
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">
                                            {{ $discountedPriceFormatted }}đ
                                        </td>
                                        <td class="align-middle p-4">
                                            <input type="number" name="quantity_pro[{{ $item->product_id }}]"
                                                min="1" max="{{ $item->product->quantity }}"
                                                value="{{ $item->quantity }}"
                                                onchange="updateQuantity('{{ $item->product_id }}', '{{ $item->cart_id }}', this.value)">
                                            <input type="hidden" name="product_id[{{ $item->product_id }}]"
                                                value="{{ $item->product_id }}">
                                            <input type="hidden" name="cart_id[{{ $item->product_id }}]"
                                                value="{{ $item->cart_id }}">

                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">
                                            {{ $itemTotalFormatted }}đ
                                        </td>
                                        <td class="text-center align-middle px-0">
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"
                                                href="{{ route('cart.remove', ['id_cart' => $item->cart_id, 'color_id' => $item->color_id]) }}"
                                                class="shop-tooltip close float-none text-danger text-decoration-none" title
                                                data-original-title="Remove" style="font-size: xx-large;">×</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-2">
                    @if ($totalAmount != 0)
                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">Tổng Thanh Toán</label>
                            <div class="text-large" style="color: red;"><strong>{{ number_format($totalAmount, 0, '.', '.') }}đ</strong></div>
                        </div>
                    @endif
                </div>
                <div class="float-right">
                    <a href="{{ url('/') }}" class="btn btn-lg btn-default md-btn-flat">Quay Lại</a>
                    @if ($totalAmount != 0)
                        <a href="{{ route('cart.checkout') }}" class="btn btn-lg btn-primary">Thanh Toán</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(productId, cartId, amount) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('cart.updateQuantity') }}";

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const productIdInput = document.createElement('input');
            productIdInput.type = 'hidden';
            productIdInput.name = 'product_id';
            productIdInput.value = productId;
            form.appendChild(productIdInput);

            const cartIdInput = document.createElement('input');
            cartIdInput.type = 'hidden';
            cartIdInput.name = 'cart_id';
            cartIdInput.value = cartId;
            form.appendChild(cartIdInput);

            const amountInput = document.createElement('input');
            amountInput.type = 'hidden';
            amountInput.name = 'amount';
            amountInput.value = amount;
            form.appendChild(amountInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>

@endsection
