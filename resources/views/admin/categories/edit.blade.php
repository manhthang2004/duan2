<!-- resources/views/admin/categories/edit.blade.php -->

@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sửa Danh Mục</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Tên Danh Mục</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
