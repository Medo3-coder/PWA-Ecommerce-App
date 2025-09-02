<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    public $table = 'product_tags';
    protected $fillable = [
        'name',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag', 'product_tag_id', 'product_id');
    }

}
