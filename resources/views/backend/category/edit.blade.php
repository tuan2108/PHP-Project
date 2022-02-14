@extends('backend.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Sửa danh mục</h1>
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>   
                @endforeach
            </ul>
        </div>
    @endif

    <form name="category" action="{{ url("/backend/category/update/$category->id") }}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên danh mục:</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="slug">Slug danh mục:</label>
            <input type="text" name="slug" class="form-control" id="text" value="{{ $category->slug }}">
        </div>
        <div class="form-group">
            <label>Ảnh danh mục</label>
            <input type="file" name="image" class="form-control" > 
            @if($category->image)
                <?php
                    $category->image = str_replace("public/", "", $category->image);
                ?>

                <div>
                    <img src="{{ asset("storage/$category->image ") }}" style="width: 200px; height:auto" alt="">
                </div>
            @endif
        </div>
        <div>
            <label for="desc">Mô tả danh mục</label>
            <textarea name="desc" id="" cols="30" rows="10" class="form-control" >{{ old($category->desc) }}</textarea>
        </div>
        <button type="submit" class="btn btn-info">Cập nhật danh mục</button>
    </form> 
@endsection