<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_catalog_id',
        'code',
        'name',
        'description',
        'price',
        'images',
        'demo',
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
