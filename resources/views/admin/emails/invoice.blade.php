<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .status-badge {
            padding: 5px 10px;
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }
        .status-waiting { background-color: #ffc107; }
        .status-confirmed { background-color: #28a745; }
        .status-completed { background-color: #dc3545; }
        .status-canceled { background-color: #6c757d; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Chi Tiết Đơn Hàng</h2>
    </div>
    <div>
        <h5>Tên Người Nhận:</h5>
        <p>{{ $bill->name_user ?? 'N/A' }}</p>
        <h5>Số Điện Thoại:</h5>
        <p>{{ $bill->tel_user ?? 'N/A' }}</p>
        <h5>Địa Chỉ:</h5>
        <p>{{ $bill->address_user ?? 'N/A' }}</p>
        <h5>Ngày Đặt Hàng:</h5>
        <p>{{ $bill->date->format('d/m/Y') ?? 'N/A' }}</p>
        <h5>Phương Thức Thanh Toán:</h5>
        <p>{{ $bill->payment_name ?? 'N/A' }}</p>
        <h5>Mã Giảm Giá:</h5>
        <p>
            @if($bill->voucher)
                {{ $bill->voucher . ' (-' . $bill->discount . '%)' }}
            @else
                Không có
            @endif
        </p>
        <h5>Tổng Tiền:</h5>
        <p>{{ number_format($bill->total, 0, '.', '.') ?? 'N/A' }}đ</p>
        <h5>Trạng Thái Đơn Hàng:</h5>
        <p>
            @if($bill->id_status == 1)
                <span class="status-badge status-waiting">Chờ Xác Nhận</span>
            @elseif($bill->id_status == 2)
                <span class="status-badge status-confirmed">Đã Xác Nhận</span>
            @elseif($bill->id_status == 3)
                <span class="status-badge status-completed">Đã Hoàn Thành</span>
            @else
                <span class="status-badge status-canceled">Đã Bị Hủy</span>
            @endif
        </p>
    </div>
    <div>
        <h5>Danh Sách Sản Phẩm</h5>
        @if($bill->otherBills->isNotEmpty())
            <table>
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
                            <td>{{ $item->product->pro_name ?? 'N/A' }}</td>
                            <td>{{ $item->color_product ?? 'N/A' }}</td>
                            <td>{{ $item->product->brand->name ?? 'N/A' }}</td>
                            <td>{{ $item->quantity_pro ?? 'N/A' }}</td>
                            <td>{{ number_format($item->price_pro, 0, '.', '.') ?? 'N/A' }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Không có sản phẩm nào trong đơn hàng này.</p>
        @endif
    </div>
</body>
</html>
