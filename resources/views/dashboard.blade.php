@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded p-4 shadow-sm">
                <div class="text-center mb-4">
                    <img src="{{ asset('img\user\IMG_2396.jpg') }}" alt="Avatar"
                        class="img-fluid rounded-circle border border-3 border-primary" style="width: 120px; height: 120px; object-fit: cover;">
                </div>

                <ul class="nav nav-pills flex-column">
                    @if (Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link d-flex align-items-center px-3 py-2">
                                <i class="fas fa-user-shield me-2"></i> Truy Cập Trang Admin
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ url('account_details') }}" class="nav-link d-flex align-items-center px-3 py-2">
                            <i class="fas fa-user me-2"></i> Thông Tin Tài Khoản
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('update_account') }}" class="nav-link d-flex align-items-center px-3 py-2">
                            <i class="fas fa-edit me-2"></i> Chỉnh Sửa Thông Tin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('change_password') }}" class="nav-link d-flex align-items-center px-3 py-2">
                            <i class="fas fa-key me-2"></i> Đổi Mật Khẩu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('liked_products') }}" class="nav-link d-flex align-items-center px-3 py-2">
                            <i class="fas fa-heart me-2"></i> Sản Phẩm Đã Thích
                        </a>
                    </li>
                    <hr class="my-3">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger d-flex align-items-center px-3 py-2"><i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-8 col-lg-9">
            <div class="bg-white rounded p-4 shadow-sm">
                <h2 class="mb-4">Xin Chào, <span class="text-primary">{{ Auth::user()->name }}</span></h2>
                <p class="mb-2"><strong>Email:</strong> <span class="text-secondary">{{ Auth::user()->email }}</span></p>
                <p class="mb-2"><strong>Số Điện Thoại:</strong> <span class="text-secondary">{{ Auth::user()->tel }}</span></p>
                <p class="mb-2"><strong>Địa Chỉ:</strong> <span class="text-secondary">{{ Auth::user()->address }}</span></p>
            </div>
        </div>
    </div>
</div>
@endsection
