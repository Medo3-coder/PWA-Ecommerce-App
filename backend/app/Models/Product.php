<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'special_price',
        'image',
        'category',
        'subcategory',
        'remark',
        'brand',
        'star',
        'product_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price'         => 'float',
        'special_price' => 'float',
        'star'          => 'float',
    ];
}
