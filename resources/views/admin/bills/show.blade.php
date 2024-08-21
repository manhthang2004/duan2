@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chi Tiết Đơn Hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tên Người Nhận:</h5>
                                <p>{{ $bill->name_user }}</p>
                                <h5>Số Điện Thoại:</h5>
                                <p>{{ $bill->tel_user }}</p>
                                <h5>Địa Chỉ:</h5>
                                <p>{{ $bill->address_user }}</p>
                                <h5>Ngày Đặt Hàng:</h5>
                                <p>{{ $bill->date->format('d/m/Y') }}</p>
                                <h5>Phương Thức Thanh Toán:</h5>
                                <p>{{ $bill->payment_name }}</p>
                                <h5>Mã Giảm Giá:</h5>
                                <p>
                                    @if($bill->voucher)
                                        {{ $bill->voucher . ' (-' . $bill->discount . '%)' }}
                                    @else
                                        Không có
                                    @endif
                                </p>
                                <h5>Tổng Tiền:</h5>
                                <p>{{ number_format($bill->total, 0, '.', '.') }}đ</p>
                                <h5>Trạng Thái Đơn Hàng:</h5>
                                <p>
                                    @if($bill->id_status == 1)
                                        <span class="badge bg-warning">Chờ Xác Nhận</span>
                                    @elseif($bill->id_status == 2)
                                        <span class="badge bg-success">Đã Xác Nhận</span>
                                    @elseif($bill->id_status == 3)
                                        <span class="badge bg-danger">Đã Hoàn Thành</span>
                                    @else
                                        <span class="badge bg-secondary">Đã Bị Hủy</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5>Danh Sách Sản Phẩm</h5>
                                @if($bill->otherBills->isNotEmpty())
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Màu</th>
                                                <th>Hãng Sản Phẩm</th>
                                                <th>Số Lượng</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bill->otherBills as $item)
                                                <tr>
                                                    <td>{{ $item->product->pro_name }}</td>
                                                    <td>{{ $item->color_product }}</td>
                                                    <td>{{ $item->product->brand->name }}</td>
                                                    <td>{{ $item->quantity_pro }}</td>
                                                    <td>{{ number_format($item->price_pro, 0, '.', '.') }}đ</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Không có sản phẩm nào trong đơn hàng này.</p>
                                @endif
                            </div>
                        </div>

                        @if($bill->id_status == 1)
                            <form action="{{ route('admin.bills.confirm', $bill->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success mt-3">Xác Nhận Đơn Hàng</button>
                            </form>
                        @endif
                        
                        <a href="{{ route('admin.bills.pdf', $bill->id) }}" class="btn btn-primary mt-3">Xuất PDF</a>
                        @if($bill->id_status == 1)
                        <form action="{{ route('admin.bills.send-invoice', $bill->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">Gửi Hóa Đơn qua Email</button>
                        </form>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
