@extends('backend.layouts.main')

@section('title', 'Xóa đơn hàng thành công')

@section('content')
    <h1>Xóa đơn hàng</h1>

    <form action="{{ url("/backend/orders/destroy/$order->id") }}" name="product" method="post">
        @csrf

        <div class="form-group">
            <label for="product_name">Id đơn hàng:</label>
            <p>{{ $order->id }}</p>
        </div>

        <div class="form-group">
            <label for="product_name">Tên khách hàng</label>
            <p>{{ $order->customer_name }}</p>
        </div>

        <button type="submit" class="btn btn-danger">Xác nhận xóa đơn hàng</button>
    </form>
@endsection