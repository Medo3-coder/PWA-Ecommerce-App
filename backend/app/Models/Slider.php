<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;


class Slider extends Model
{
    use HasFactory , UploadTrait;
    protected $fillable = ['image'];

    public function getImageAttribute(){
        if(isset($this->attributes['image']) && File::exists(public_path('storage/images/sliders/' . $this->attributes['image']))){
            // Retrieve the image path if it exists
            return $this->getimage($this->attributes['image'] , 'sliders');
        }
        // Retrieve the default image from the site settings
        $defaultImage  = SiteSetting::first()->default_image ?? 'default.jpg';

        // Return the default image path if the category image doesn't exist
        return $this->defaultImage($defaultImage);
    }


    public function setImageAttribute($value) {
        if ($value != null && is_file($value)) {
            // Delete the old image if it exists
            if (isset($this->attributes['image'])) {
                $this->deleteFile($this->attributes['image'], 'sliders');
            }
            // Upload the new image and set the attribute
            $this->attributes['image'] = $this->uploadAllTypes($value, 'sliders');

        }
    }

}
