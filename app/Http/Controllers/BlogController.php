<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCreationRequest;
use App\Models\Blog;
use App\Services\BlogService;

class BlogController extends Controller
{
    public function create(BlogCreationRequest $request,BlogService $blogService)
    {
        $blogData=$request->validated();
            $filename = $request->file('image')->hashName();
            $request->file('image')->store('public/images');
            $blog = $blogService->createBlog($blogData,$filename);
        return response()->json(['message' => 'Blog uploaded successfully', $blog]);
    }
    public function index(){
        return response()->json([Blog::paginate(10)]);
    }
}
