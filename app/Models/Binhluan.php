<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $table='binhluan';
    protected $fillable=[
        'ma_nguoidung',
        'ma_sp',
        'danh_gia',
        'noi_dung',
        'is_delete'
    ];
}
