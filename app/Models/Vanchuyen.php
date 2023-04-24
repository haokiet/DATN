<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vanchuyen extends Model
{
    use HasFactory;
    protected $table='vanchuyen';
    protected $fillable=[
        'ten_vc',
        'don_gia_vc'
    ];
}
