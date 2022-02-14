@extends('backend.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Xóa danh mục</h1>   
    <form name="category" action="{{ url("/backend/category/destroy/$category->id") }}"  method="post">
       @csrf
        <div class="form-group">
            <label for="name">ID danh mục:</label>
            <p>{{ $category->id }}</p>
        </div>

        <div class="form-group">
            <label for="name">Tên danh mục:</label>
            <p>{{ $category->name }}</p>
        </div>
        
        <button type="submit" class="btn btn-info">Xóa danh mục</button>
    </form> 
    
@endsection