<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Category extends Model {
    use HasFactory ,UploadTrait ;

    protected $fillable = ['category_name', 'category_image'];

    public function subcategories() {
        return $this->hasMany(Subcategory::class);
    }


    public function getImageAttribute()
    {
        if (isset($this->attributes['category_image']) && File::exists(public_path('storage/images/categories/' . $this->attributes['image']))) {
            // Retrieve the image path if it exists
            $image = $this->getImage($this->attributes['category_image'], 'categories');
        } else {
            $image = $this->defaultImage('default.jpg');
        }
        // Retrieve the default image from the site settings
      return $image;
    }


    public function setImageAttribute($value)
    {
        if ($value != null && is_file($value)) {
            // Delete the old image if it exists
            if (isset($this->attributes['category_image'])) {
                $this->deleteFile($this->attributes['category_image'], 'users');
            }
            // Upload the new image and set the attribute
            $this->attributes['category_image'] = $this->uploadAllTypes($value, 'categories');

        }
    }

    // protected static function boot() {

    //     parent::boot();

    //     // Automatically generate a slug when creating a new category
    //     static::creating(function ($category) {
    //         $category->slug = Str::slug('category_name');
    //     });

    //     // Automatically update the slug when updating a category name
    //     static::updating(function ($category) {
    //         $category->slug = Str::slug('category_name');
    //     });
    // }
}
