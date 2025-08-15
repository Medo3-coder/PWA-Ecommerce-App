<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'product_category_id',
        'price',
        'quantity',
        'status',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    // This allows each product to have multiple versions/variants.
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_tag');
    }

    public function sections()
    {
       return $this->belongsToMany(Section::class , 'product_section');
    }

}
