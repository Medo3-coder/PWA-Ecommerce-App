<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model {

    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_one',
        'image_two',
        'image_three',
        'image_four',
        'short_description',
        'color',
        'size',
        'long_description',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
