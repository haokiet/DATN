<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    use HasFactory;
    protected $table='hoadon';
    protected  $fillable=[
        'ma_nguoidung',
        'ma_vanchuyen',
        'dia_chi_nhan',
        'ten_nhan',
        'trang_thai',
        'so_dt_nhan',
        'is_delete'
    ];
}
