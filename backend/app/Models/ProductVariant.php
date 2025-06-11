<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_attribute_id',
        'value',
        'additional_price',
        'quantity',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
