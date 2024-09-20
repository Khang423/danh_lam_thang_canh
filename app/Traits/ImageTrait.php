<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    public static function storeImage($imageFile, $folder, $isThumb = false)
    {
        $hash = date('YmdHis') . Str::random(10);
        $imageFileName = 'image_' . $hash . '.jpg';
        $imageFileNameThumb = 'thumb_image_' . $hash . '.jpg';
        $imagePath = "assets/$folder/";
        $imageFullPath = $imagePath . $imageFileName;
        $imageFullPathThumb = $imagePath . $imageFileNameThumb;

        if (!Storage::disk('public_path')->exists($imagePath)) {
            Storage::disk('public_path')->makeDirectory($imagePath);
        }

        $img = Image::make($imageFile);
        $img->orientate()->save($imageFullPath, 70);

        // Check is allow store thumb image
        if ($isThumb) {
            $img = Image::make($imageFile);
            $img->orientate();
            $img->save($imageFullPathThumb, 50);
        }

        return [
            'url' => $imageFullPath,
            'thumb_url' => $imageFullPathThumb,
        ];
    }

    public static function storeImage360($imageFile, $folder, $isThumb = false)
    {
        $hash = date('YmdHis') . Str::random(10);
        $imageFileName = 'image_' . $hash . '.jpg';
        $imageFileNameThumb = 'thumb_image_' . $hash . '.jpg';
        $imagePath = "assets/$folder/";
        $imageFullPath = $imagePath . $imageFileName;
        $imageFullPathThumb = $imagePath . $imageFileNameThumb;

        if (!Storage::disk('public_path')->exists($imagePath)) {
            Storage::disk('public_path')->makeDirectory($imagePath);
        }

        $img = Image::make($imageFile);
        $img->orientate()->save($imageFullPath, 100);

        // Check is allow store thumb image
        if ($isThumb) {
            $img = Image::make($imageFile);
            $img->orientate();
            $img->save($imageFullPathThumb, 50);
        }

        return [
            'url' => $imageFullPath,
            'thumb_url' => $imageFullPathThumb,
        ];
    }

    public function storeFile($file, $folder, $isThumb = false)
    {
        $hash = date('YmdHis') . Str::random(10);
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = 'file_' . $hash . '.' . $fileExtension;
        $filePath = "assets/$folder/";
        $fullPath = $filePath . $fileName;
        $fileType = $file->getMimeType();

        if (!Storage::disk('public_path')->exists($filePath)) {
            Storage::disk('public_path')->makeDirectory($filePath);
        }

        if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
            $img = Image::make($file);
            $img->orientate()->save($fullPath, 70);

            if ($isThumb) {
                $thumbFileName = 'thumb_' . $fileName;
                $thumbFullPath = $filePath . $thumbFileName;
                $img->save($thumbFullPath, 50);

                return [
                    'url' => $fullPath,
                    'type' => $fileType,
                    'thumb_url' => $thumbFullPath,
                ];
            }

            return [
                'url' => $fullPath,
                'type' => $fileType,
                'thumb_url' => null,
            ];
        } elseif (in_array($fileExtension, ['mp4'])) {
            $file->move(public_path($filePath), $fileName);

            return [
                'url' => $fullPath,
                'type' => $fileType,
                'thumb_url' => null,
            ];
        } else {
            throw new \Exception('Unsupported file type');
        }
    }

    public static function storeLogo($imageFile, $folder)
    {
        $imageFileName = 'logo' . '.png';
        $imagePath = "assets/$folder/";
        $imageFullPath = $imagePath . $imageFileName;

        if (!Storage::disk('public_path')->exists($imagePath)) {
            Storage::disk('public_path')->makeDirectory($imagePath);
        }

        $img = Image::make($imageFile);
        $img->orientate()->save($imageFullPath, 100);

        return [
            'url' => $imageFullPath,
        ];
    }

    public static function deleteImage($imagePath)
    {
        return Storage::disk('public_path')->delete($imagePath);
    }
}
