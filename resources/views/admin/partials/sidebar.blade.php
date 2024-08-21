<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            @if (auth()->check() && auth()->user()->role >= 1)
                <li class="nav-label first">Trang Chủ</li>
                <li>
                    <a class="" href="{{ route('admin.index') }}" aria-expanded="false"><i class="fa-solid fa-cube"></i><span class="nav-text">Bảng Điều Khiển</span></a>
                </li>
                <li class="nav-label">Quản Lý Cửa Hàng</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-microchip"></i><span class="nav-text">Danh Mục</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.categories.index') }}">Danh Sách Danh Mục</a></li>
                        <li><a href="{{ route('admin.categories.create') }}">Thêm Danh Mục</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-headphones-simple"></i><span class="nav-text">Sản Phẩm</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.products.index') }}">Danh Sách Sản Phẩm</a></li>
                        <li><a href="{{ route('admin.products.create') }}">Thêm Sản Phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-ticket"></i><span class="nav-text">Voucher</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.vouchers.index') }}">Danh Sách Voucher</a></li>
                        <li><a href="{{ route('admin.vouchers.create') }}">Thêm Voucher</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-truck-fast"></i><span class="nav-text">Đơn Hàng</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.orders.index') }}">Danh Sách Đơn Hàng</a></li>
                    </ul>
                </li>
                <li class="nav-label">Quản Lý Khách Hàng</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-users"></i><span class="nav-text">Người Dùng</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.users.index') }}">Danh Sách Người Dùng</a></li>
                        <li><a href="#">Danh Sách Hội Viên</a></li>
                    </ul>
                </li>
            @else
                <script>alert('Bạn không đủ thẩm quyền');</script>
            @endif
        </ul>
    </div>
</div>
