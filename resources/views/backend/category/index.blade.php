@extends('backend.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Danh sách danh mục</h1>
    <div style="padding:10px; border: 1pxs solid #4e73df; margin-bottom:10px ">
        <form action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" name="search_category" method="get" class="form-inline">

            <input name="category_name" value="{{ $searchKeyword }}" class="form-control" style="width:350px; margin-right:20px;" placeholder="Nhập tên sản phẩm bạn muốm tìm kiếm ..... " autocomplete="off">

            <select name="sort" class="form-control" style="width:150px; margin-right:20px" id="">
                <option value="">Sắp xếp</option>
                <option value="name_asc" {{ $sort == "name_asc" ? "selected" : "" }}>Tên tăng dần</option>
                <option value="name_desc" {{ $sort == "name_desc" ? "selected" : "" }}>Tên giảm dần</option>
            </select>

            <div style="padding="10px 0>
                <input type="submit" name="search" class="btn btn-success" value="Lọc kết quả">
            </div>

            <div style="padding:10px 0">
                <a href="#" id="clear-search" class="btn btn-warning">Clear filter</a>
            </div>

            <input type="hidden" name="page" value="1">
        </form>
    </div>
    {{ $category->links() }}
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <div style="padding: 20px">
        <a href="{{ url("/backend/category/create") }}" class="btn btn-info">Thêm sản phẩm</a>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id danh mục</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Tên danh mục</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id danh mục</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Tên danh mục</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if(isset($category) && !empty($category))
                                            @foreach($category as $categor)
                                        <tr>
                                            <th>{{ $categor->id }}</th>
                                            <th>@if($categor->image)
                                                    <?php
                                                        $categor->image = str_replace("public/", "" ,$categor->image);
                                                        
                                                    ?>
                                                    
                                                    <div>
                                                        <img src="{{ asset("storage/$categor->image") }}" alt="" style="width:200px; height:auto;">
                                                    </div>
                                                @endif
                                            </th>
                                            <th>{{ $categor->name }}</th>
                                            <th>
                                                <a href="{{ url("/backend/category/delete/$categor->id") }}" class="btn btn-warning">Xóa</a>
                                                <a href="{{ url("/backend/category/edit/$categor->id") }}" class="btn btn-danger" >Sửa</a>
                                            </th>
                                        </tr>
                                        @endforeach
                                        @else
                                            Chưa có bản ghi nào trong bảng này
                                        @endif
                                    </tbody>
                                </table>
@endsection

@section('appendjs')
    <!-- clear-filter -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#clear-search").on("click", function(e){
                e.preventDefault();
                // chặn sự kiện chuyển trang của thẻ a khi click vào clear

                $("input[name='category_name']").val('');
                // .val để đặt ô input có name kia là rỗng(cái trong ''  đó)(nó clear đi đấy)

                $("form[name='search_category']").trigger("submit");
                // trigger là kích hoạt hành động submit của cái form kia khi nó đã clear ô input đi rồi. nó sẽ trả về các bản ghi khi chưa tìm kiếm
            });
           
            $("a.page-link").on("click", function (e){
                e.preventDefault();
                var rel = $(this).attr("rel");
                // dòng này lấy ra giá trị của rel trên cửa sổ insprect lên phần phân trang. rel sẽ có 2 giá trị là next và prev

                if(rel == "next"){
                    var page= $("body").find(".page-item.active > .page-link").eq(0).text();
                    // find() là hàm dùng để lấy giá trị của bộ chọn bên trong () cái ..page-item.active > .page-link là lấy cái nào có class kia và sau nó là thẻ có class page-link (nhớ lại cái viết tắt của html). eq() là hàm xác định thành phần ở vị trí thứ mấy(bắt đầu từ 0). text() là lấy nội dung của thẻ html. ở dòng này là từ thẻ body lấy ra giá trị trong thẻ html của thành phần đầu tiên với bộ chọn là thẻ nào phải có đủ .page-item.active > .page-link. 
                    console.log(":" + page);
                    page = parseInt(page);
                    page +=1;
                }else if(rel == "prev"){
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(page);
                    page = parseInt(page);
                    page -=1;
                } else {
                    var page = $(this).text();
                }

                console.log(page);
                $("input[name='page']").val(page);

                $("form[name='search_category']").trigger("submit");

            });
        });
    </script>
@endsection