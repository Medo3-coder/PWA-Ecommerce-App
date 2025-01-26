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
        'quantity'
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

    public function productDetails(){
        return $this->hasOne(ProductDetail::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function subCategory(){
    //     return $this->belongsTo(Subcategory::class);
    // }

    // public function reviews(){
    //     return $this->hasMany(Rev);
    // }
}
