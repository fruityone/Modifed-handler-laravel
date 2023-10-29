<?php

namespace App\Http\Controllers;


use App\Http\Requests\CommentCreationRequest;
use App\Models\Article;
use App\Models\Blog;
use App\Services\CommentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentController extends Controller
{
    private CommentService $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function createBlogComment(CommentCreationRequest $request, $blogId)
    {
        try {
            $blog = Blog::findOrFail($blogId);
        }
        catch (ModelNotFoundException $e){
            return response()->json(['message' => 'Blog not found'], 404);
        }
        $comment = $this->commentService->createComment($request->input('content'),auth('sanctum')->id(),$blog);
        return response()->json(['message' => 'Blog comment created',$comment]);
    }
    public function createArticleComment(CommentCreationRequest $request, $articleId){
        try {
            $article = Article::findOrFail($articleId);
        }
        catch (ModelNotFoundException  $e){
            return response()->json(['message' => 'Article not found'], 404);
        }
        $comment = $this->commentService->createComment($request->input('content'),auth('sanctum')->id(),$article);
        return response()->json(['message' => 'Article comment created',$comment]);
    }
}
