@extends('layouts.app')

@section('content')

    <body>
        @if (Auth::check())
            <div class="user-info">
                <p>Chào, {{ Auth::user()->name }}!</p>
                <!-- Thông tin người dùng -->
                <div class="user-info">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Số điện thoại:</strong> {{ Auth::user()->tel }}</p>
                    <p><strong>Địa chỉ:</strong> {{ Auth::user()->address }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn btn-logout">Đăng Xuất</button>
                </form>
            </div>
        @else
            <!-- Nếu chưa đăng nhập -->
            <div class="thung_chua sign-up-mode">
                <div class="khuon_thung_chua">
                    <div class="signin-signup">
                        <!-- Form Đăng Nhập -->
                        <form action="{{ route('login') }}" method="post" class="sign-in-form">
                            @csrf
                            <h2 class="thuong_hieu">Đăng Nhập</h2>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Tên Tài Khoản" name="user_name_login"
                                    value="{{ old('user_name_login') }}" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('user_name_login')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Mật Khẩu" name="pass_login" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('pass_login')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="submit" name="login" value="Đăng Nhập" class="nut solid" />
                            <p class="social-text">Hoặc Đăng Nhập Bằng</p>
                            <div class="social-media">
                                <a href="#" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </form>

                        <!-- Form Đăng Ký -->
                        <form action="{{ route('register') }}" method="post" class="sign-up-form">
                            @csrf
                            <h2 class="thuong_hieu">Đăng Ký</h2>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Tên" name="name" value="{{ old('name') }}" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="input-field">
                                <i class="fas fa-phone"></i>
                                <input type="text" placeholder="Số Điện Thoại" name="tel"
                                    value="{{ old('tel') }}" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('tel')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Mật Khẩu" name="password" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>

                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Nhập Lại Mật Khẩu" name="password_confirmation" />
                            </div>
                            <span style="color: red; font-weight: bold;">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </span>

                            <input type="submit" name="register" class="nut" value="Đăng Ký" />

                            <p class="social-text">Hoặc Đăng Ký Bằng</p>
                            <div class="social-media">
                                <a href="#" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panels-thung_chua">
                    <!-- Panel Trái -->
                    <div class="panel left-panel">
                        <div class="content">
                            <h3>Chưa Có Tài Khoản?</h3>
                            <p>
                                Đăng ký để nhận những ưu đãi cho thành viên mới ngay hôm nay!
                            </p>
                            <a href="{{ route('register') }}" class="nut transparent">Đăng Ký</a>
                        </div>
                        <img src="{{ asset('img/user/b.svg') }}" class="image" alt="" />
                    </div>

                    <!-- Panel Phải -->
                    <div class="panel right-panel">
                        <div class="content">
                            <h3>Đã Có Tài Khoản?</h3>
                            <p>
                                Hãy đăng nhập để sử dụng các tính năng của chúng tôi.
                            </p>
                            <a href="{{ route('login') }}" class="nut transparent">Đăng Nhập</a>
                        </div>
                        <img src="{{ asset('img/user/sign_in.svg') }}" class="image" alt="" />
                    </div>
                </div>
            </div>
        @endif
    </body>
@endsection
