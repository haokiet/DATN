<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phuongthuc extends Model
{
    use HasFactory;
    protected $table='phuongthuc';
    protected $fillable=[
        'ten_pt'
    ];
}
