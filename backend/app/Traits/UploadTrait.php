<?php
namespace App\Traits;

use Illuminate\Support\Facades\File;
// use Intervention\Image\Facades\Image;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
trait UploadTrait
{

    public function uploadAllTypes($file, $directory, $width = null, $height = null)
    {
        $storagePath = 'storage/images/' . $directory;

        $this->createDirectoryIfNotExists($storagePath);

        // Get the file MIME type
        $fileMimeType = $file->getClientMimeType();
        $fileType     = explode('/', $fileMimeType)[0];

        // Allowed MIME types for images and documents

        if ($fileType === 'image') {
            // Allowed image MIME types
            $allowedImageMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];

            if (! in_array($fileMimeType, $allowedImageMimeTypes)) {
                return 'default.png';
            }

            return $this->uploadImage($file, $directory, $width, $height);
        }

        // Allowed document MIME types
        $allowedDocumentMimeTypes = [
            'application/pdf', 'application/msword', 'application/excel',
            'application/vnd.ms-excel', 'application/vnd.msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        if (! in_array($fileMimeType, $allowedDocumentMimeTypes)) {
            return 'default.png';
        }

        return $this->uploadFile($file, $directory);
    }

    public function uploadFile($file, $directory)
    {

        $directoryPath = public_path('storage/images/' . $directory);
        $filename      = time() . '_' . rand(1000000, 9999999) . '-' . $file->getClientOriginalExtension();

        // Move file to the specified directory
        $file->move($directoryPath, $filename);

        return $filename;

    }

    public function uploadImage($file, $directory, $width = null, $height = null)
    {
        $storagePath = public_path('storage/images/' . $directory);
        $this->createDirectoryIfNotExists($storagePath);
        $filename = time() . '_' . rand(1000000, 9999999) . '.' . $file->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());
        $img     = $manager->read($file);

        // Resize image if width and height are provided
        if ($width && $height) {
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->save($storagePath . '/' . $filename);
        return $filename;
    }

    private function createDirectoryIfNotExists($path)
    {
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
    }

    public function getimage($name, $directory)
    {
        return url("storage/images/$directory/" . $name);
    }

    public function defaultImage($filename)
    {
        return url("storage/images/{$filename}");
    }

    public function deleteFile($filename, $directory)
    {
        if ($filename && $filename !== 'default.png' && file_exists(public_path("storage/images/'.$directory.'/'.$filename"))) {
            unlink("storage/images/$directory/$filename");
        }

    }
}
