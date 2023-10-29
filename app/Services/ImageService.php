<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ImageService.
 */
class ImageService
{
    public function uploadImage($base64Image)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        $imageInfo = getimagesizefromstring($imageData);
        if ($imageInfo === false) {
            return response()->json(['error' => 'Invalid image format']);
        }
        $mimeType = $imageInfo['mime'];
        $extension = image_type_to_extension($imageInfo[2]);
        $currentTime = now()->format('YmdHis');
        $filename = $currentTime.Str::random(20) . $extension;
        Storage::disk('public')->put($filename, $imageData);
    }
}
