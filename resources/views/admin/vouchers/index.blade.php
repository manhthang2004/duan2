@extends('admin.index')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Voucher List</h4>
                <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary">Add Voucher</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->id }}</td>
                                <td>{{ $voucher->code }}</td>
                                <td>{{ $voucher->discount }}</td>
                                <td>
                                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
