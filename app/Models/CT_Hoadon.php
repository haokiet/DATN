<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CT_Hoadon extends Model
{
    use HasFactory;
    protected $table='ct_hoadon';
    protected $fillable=[
        'ma_hoadon',
        'ma_sp',
        'so_luong'
    ];
}
