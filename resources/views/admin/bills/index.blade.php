@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Danh Sách Đơn Hàng</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Người Nhận</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Địa Chỉ</th>
                                    <th>Ngày Đặt Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td>{{ $bill->id }}</td>
                                        <td>{{ $bill->name_user }}</td>
                                        <td>{{ $bill->tel_user }}</td>
                                        <td>{{ $bill->address_user }}</td>
                                        <td>{{ $bill->date }}</td>
                                        <td>{{ number_format($bill->total, 0, '.', '.') }}đ</td>
                                        <td>{{ $bill->status->status_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.bills.show', $bill->id) }}" class="btn btn-info">Xem Chi Tiết</a>
                                            <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</button>
                                            </form>
                                            @if($bill->status === 'pending')
                                                <form action="{{ route('admin.bills.confirm', $bill->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Xác Nhận Đơn Hàng</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
