<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public static function storeImage($imageFile, $folder)
    {
        $hash = date('YmdHis') . Str::random(10);
        $imageFileName = 'image_' . $hash . '.jpg';
        $imagePath = "assets/$folder/"; // Đường dẫn lưu ảnh
        $imageFullPath = $imagePath . $imageFileName; // Đường dẫn đầy đủ cho ảnh gốc

        if (!Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->makeDirectory($imagePath);
        }

        Storage::disk('public')->put($imageFullPath, file_get_contents($imageFile));

        return [
            'url' => Storage::url($imageFullPath), 
        ];
    }

    public static function deleteImage($imgPath)
    {
        Storage::disk('public')->delete($imgPath);
    }
}
