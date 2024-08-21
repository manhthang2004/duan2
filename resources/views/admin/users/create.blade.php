@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Người Dùng</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="tel" name="tel">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa Chỉ</label>
                                <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật Khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="form-gro
