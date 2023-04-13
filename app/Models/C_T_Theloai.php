<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_T_Theloai extends Model
{
    use HasFactory;
    protected $table='ct_theloai';
    protected $fillable=[
        'ma_sp',
        'ma_theloai'
    ];
}
