<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'price',
        'is_available',
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
