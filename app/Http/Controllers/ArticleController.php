<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreationRequest;
use App\Models\Article;
use App\Models\Blog;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function create(ArticleCreationRequest $request,ArticleService $blogService,$blogId)
    {
        $blog=Blog::findOrFail($blogId);
        $articleData=$request->validated();
        $filename = $request->file('image')->hashName();
        $request->file('image')->store('public/images');
        $article = $blogService->createArticle($articleData,$filename,$blog->id);
        return response()->json(['message' => 'Article uploaded successfully', $article]);
    }
    public function index(){
        return response()->json([Article::paginate(10)]);
    }
}
