<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>MT Store - Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="{{ route('admin.index') }}" class="brand-logo">MT Store</a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('logout') }}" class="dropdown-item">
                                        <i class="icon-key"></i> <span class="ml-2">Đăng Xuất </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    @if (auth()->check() && auth()->user()->role == 1)
                        <li class="nav-label first">Trang Chủ</li>
                        <li><a href="{{ route('admin.index') }}" aria-expanded="false"><i class="fa-solid fa-cube"></i><span class="nav-text">Bảng Điều Khiển</span></a></li>
                        <li class="nav-label">Quản Lý Cửa Hàng</li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-microchip"></i><span class="nav-text">Danh Mục</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('admin.categories.index') }}">Danh Sách Danh Mục</a></li>
                                <li><a href="{{ route('admin.categories.create') }}">Thêm Danh Mục</a></li>
                                <li><a href="{{ route('admin.colors.index') }}">Danh Sách Màu</a></li>
                                <li><a href="{{ route('admin.colors.create') }}">Thêm Màu</a></li>
                                <li><a href="{{ route('admin.brands.index') }}">Danh Sách Hãng</a></li>
                                <li><a href="{{ route('admin.brands.create') }}">Thêm Hãng</a></li>
                                <li><a href="{{ route('admin.banners.index') }}">Danh Sách Banner</a></li>
                                <li><a href="{{ route('admin.banners.create') }}">Thêm Banner</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-headphones-simple"></i><span class="nav-text">Sản Phẩm</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('admin.products.index') }}">Danh Sách Sản Phẩm</a></li>
                                <li><a href="{{ route('admin.products.create') }}">Thêm Sản Phẩm</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-ticket"></i><span class="nav-text">Voucher</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('admin.vouchers.index') }}">Danh Sách Voucher</a></li>
                                <li><a href="{{ route('admin.vouchers.create') }}">Thêm Voucher</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-truck-fast"></i><span class="nav-text">Đơn Hàng</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('admin.bills.index') }}">Danh Sách Đơn Hàng</a></li>
                            </ul>
                        </li>
                        <li class="nav-label">Quản Lý Khách Hàng</li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-users"></i><span class="nav-text">Người Dùng</span></a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('admin.users.index') }}">Danh Sách Người Dùng</a></li>
                            </ul>
                        </li>
                    @else
                        <script>alert('Bạn không đủ thẩm quyền');</script>
                    @endif
                </ul>
            </div>
        </div>

       @yield('content')
    </div>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>

    <script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendor/morris/morris.min.js') }}"></script>

    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>

    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>

    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('vendor/summernote/js/summernote.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/summernote-init.js') }}"></script>
    <script src="https://kit.fontawesome.com/9cc1e5b793.js" crossorigin="anonymous"></script>

</body>

</html>
