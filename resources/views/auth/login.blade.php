<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="thung_chua sign-up-mode">
        <div class="khuon_thung_chua">
            <div class="signin-signup">
                <!-- Form Đăng Nhập -->
                <form action="{{ route('login') }}" method="post" class="sign-in-form">
                    @csrf
                    <h2 class="thuong_hieu">Đăng Nhập</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" />
                    </div>
                    @error('email')
                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mật Khẩu" name="password" />
                    </div>
                    @error('password')
                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                    @enderror
                    <input type="submit" value="Đăng Nhập" class="nut solid" />
                </form>
                <!-- Form Đăng Ký -->
                <form action="{{ route('register') }}" method="post" class="sign-up-form">
                    @csrf
                    <h2 class="thuong_hieu">Đăng Ký</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Tên Tài Khoản" name="name" value="{{ old('name') }}" />
                    </div>
                    @error('name')
                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" />
                    </div>
                    @error('email')
                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mật Khẩu" name="password" />
                    </div>
                    @error('password')
                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Nhập Lại Mật Khẩu" name="password_confirmation" />
                    </div>
                    @error('password_confirmation')
                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                    @enderror
                    <input type="submit" class="nut" value="Đăng Ký" />
                </form>
            </div>
        </div>
        <div class="panels-thung_chua">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Chưa Có Tài Khoản?</h3>
                    <p>Đăng ký để nhận những ưu đãi cho thành viên mới ngay hôm nay!</p>
                    <button class="nut transparent" id="sign-up-nut">Đăng Ký</button>
                </div>
                <img src="{{ asset('img/user/b.svg') }}" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Đã Có Tài Khoản?</h3>
                    <p>Hãy đăng nhập để sử dụng các tính năng của chúng tôi.</p>
                    <button class="nut transparent" id="sign-in-nut">Đăng Nhập</button>
                </div>
                <img src="{{ asset('img/user/sign_in.svg') }}" class="image" alt="" />
            </div>
        </div>
    </div>
@endsection
