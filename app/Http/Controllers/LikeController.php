<?php

namespace App\Http\Controllers;


use App\Interfaces\LikeInterface;
use App\Models\Article;
use App\Models\Blog;
use App\Models\Like;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    private LikeInterface $likeRepository;

    public function __construct(LikeInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function createBlogLike($blogId)
    {
        try {
            $blog = Blog::findOrFail($blogId);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
        if (!$this->likeRepository->blogLikeExists($blogId)){
            $like = new Like();
        $like->user_id = auth('sanctum')->id();
        $like->save();
        $blog->likes()->attach($like->id);
        return response()->json(['message' => 'Blog  liked', $like], 201);
    }
        return response()->json(['message' => 'Blog already liked'], 400);
    }
    public function createArticleLike($articleId)
    {
        try {
            $article = Article::findOrFail($articleId);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        if (!$this->likeRepository->articleLikeExists($articleId)){
            $like = new Like();
        $like->user_id = auth('sanctum')->id();
        $like->save();
        $article->likes()->attach($like->id);
        return response()->json(['message' => 'Article  liked', $like], 201);
    }
    return response()->json(['message' => 'Article already liked'], 400);}
}
