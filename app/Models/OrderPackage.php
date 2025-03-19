<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'package_name',
        'package_description',
        'package_weight',
        'package_length',
        'package_width',
        'package_height',
        'package_weight_vol',
    ];
}
