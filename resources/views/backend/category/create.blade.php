@extends('backend.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Thêm mới danh mục</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url("/backend/category/store") }}" name="category" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="name">Tên danh mục:</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', "") }}">
        </div>
        <div class="form-group">
            <label for="slug">Slug danh mục:</label>
            <input type="text" name="slug" class="form-control" id="text" value="{{old('slug',"") }}">
        </div>
        <div class="form-group">
            <label>Ảnh danh mục</label>
            <input type="file" name="image" class="form-control" > 
        </div>
        <div>
            <label for="desc">Mô tả danh mục</label>
            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{old('desc',"")}}</textarea>
        </div>
        <button type="submit" class="btn btn-info">Thêm danh mục</button>
    </form> 
@endsection

@section('appendjs')
    <link rel="stylesheet" href="{{ asset("/be-assets/js/bootstrap-datetimepicker.min.css") }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset("/be-assets/js/bootstrap-datetimepicker.min.js") }}"></script>

    <script type="text/javascript">
    $(function () {
        $('#product_publish').datetimepicker({
            format:"YYYY-MM-DD HH:mm:ss",
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            }
        });
    });
    </script>

    <script src="{{ asset("/be-assets/js/tinymce/tinymce.min.js") }}"></script>
    <script>
    tinymce.init({
        selector: '#desc'
    });
    </script>
@endsection