<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thanhtoan extends Model
{
    use HasFactory;
    protected $table='thanhtoan';
    protected $fillable=[
        'ma_hoadon',
        'ma_phuongthuc',
        'tong_tien',
        'trang_thai'
    ];
}
