<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Blog;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;

/**
 * Class ArticleService.
 */
class ArticleService
{
    public function createArticle($articleData, $filename,$blogId)
    {
        try {
            return Article::create([
                'name' => $articleData['name'],
                'description' => $articleData['description'],
                'image' => $filename,
                'blog_id' => $blogId,
                'tags' => $articleData['tags'] ?? null
            ]);
        } catch (ConnectionException $e) {
            Log::error('Article creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create article. Please try again later.'], 500);
        }
    }
}
