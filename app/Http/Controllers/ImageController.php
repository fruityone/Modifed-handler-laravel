<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Services\ImageService;

class ImageController extends Controller
{
    public ImageService $imageService;
    public function __construct(ImageService $imageService)
    {
    $this->imageService = $imageService;
    }
    public function uploadImage(ImageUploadRequest $request)
    {
        $base64Image = $request->input('image');
        $this->imageService->uploadImage($base64Image);
        return response()->json(['message' => 'Image uploaded successfully']);
    }
}

