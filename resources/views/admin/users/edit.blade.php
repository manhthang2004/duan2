@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sửa Người Dùng</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="tel" name="tel" value="{{ $user->tel }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa Chỉ</label>
                                <textarea class="form-control" id="address" name="address">{{ $user->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật Khẩu (để trống nếu không thay đổi)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <label for="role">Vai Trò</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
