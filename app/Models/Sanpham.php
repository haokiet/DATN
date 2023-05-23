<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table='sanpham';
    protected $fillable=[
        'ma_nguoidung',
        'ma_theloai',
        'anh_sp',
        'ten_sp',
        'mo_ta',
        'so_luong',
        'gia_goc',
        'khuyen_mai',
        'ngay_km',
        'ket_thuc_km',
        'trang_thai',
        'is_delete'
    ];
}
