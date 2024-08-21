
@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Danh Mục Mới</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên Danh Mục</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
