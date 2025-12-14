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
        'product_status_id',
    ];

    public function reviews()
    {
        return $this->hasMany(ProductReview::class , 'product_id' , 'id');
    }
    // This allows each product to have multiple versions/variants.
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class , 'product_id' , 'id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id' , 'id');
    }

    // pivot table
    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_tag', 'product_id', 'product_tag_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'product_section');
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'product_status_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('cover') ?: null;
    }

}
