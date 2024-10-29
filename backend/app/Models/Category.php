<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Category extends Model {
    use HasFactory;

    protected $fillable = ['category_name', 'category_image'];

    public function subcategories() {
        $this->hasMany(Subcategory::class);
    }

    public function getImageAttribute() {

        if (isset($this->attributes['image']) && File::exists(public_path('storage/images/categories/' . $this->attributes['image']))) {
            // Retrieve the image path if it exists
            return $this->getImage($this->attributes['image'], 'categories');
        }
        // Return the default image path if the category image doesn't exist
        return $this->defaultImage('categories');
    }

    public function setImageAttribute($value) {
        if ($value != null && is_file($value)) {
            // Delete the old image if it exists
            if (isset($this->attributes['image'])) {
                $this->deleteFile($this->attributes['image'], 'users');
            }
            // Upload the new image and set the attribute
            $this->attributes['image'] = $this->uploadAllTyps($value, 'categories');

        }
    }
}
