<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Http\Client\ConnectionException;

/**
 * Class BlogService.
 */
class BlogService
{
    public function createBlog($blogData, $filename)
    {
        try {
            return Blog::create(['name' => $blogData['name'], 'description' => $blogData['description'], 'image' => $filename, 'tags'=> $blogData['tags'] ?? null]);
        } catch (ConnectionException $e) {
            Log::error('Blog creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create blog. Please try again later.'], 500);
        }
    }
}
