<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    //
    // khai bảo tên bảng
    protected $table = 'products';

    // khai báo khóa chính của bảng
    protected $primarykey = 'id';
}
