<?php
namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory, UploadTrait;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'parent_id',
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    public function getImageAttribute()
    {
        if (isset($this->attributes['image']) && File::exists(public_path('storage/images/categories/' . $this->attributes['image']))) {
            $image = $this->getimage($this->attributes['image'], 'categories');
        } else {
            $image = $this->defaultImage('default.jpg');
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if ($value != null && is_file($value)) {
            // Delete the old image if it exists
            if (isset($this->attributes['image'])) {
                $this->deleteFile($this->attributes['image'], 'categories');
            }
            // Upload the new image and set the attribute
            $this->attributes['image'] = $this->uploadAllTypes($value, 'categories');
        }
    }

    // Auto-generate slug when name is set
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Parent category relationship
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    // Child categories relationship
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    // Products relationship
    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    // Get all ancestors of the category
    public function ancestors()
    {
        $ancestors = collect();
        $category  = $this;

        while ($category->parent) {
            $category = $category->parent;
            $ancestors->push($category);
        }
        return $ancestors;
    }

    // Get all descendants of the category
    public function descendants()
    {
        $descendants = collect();

        foreach ($this->children() as $child) {
            $descendants = $descendants->merge($child->descendants());
        }
        return $descendants;
    }

    // Scope for active categories
    public function scopeActive($query)
    {
        return $this->query('is_active', true);
    }

    // Scope for root categories (no parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // Get full path of category (e.g., "Electronics > Phones > Smartphones")
    public function getFullPathAttribute()
    {
        $path     = collect([$this->name]);
        $category = $this;

        while ($category->parent) {
            $category = $category->parent; // get the parent category
            $path->prepend($category->name);
        }
        return $path->implode(' > ');
    }

}
