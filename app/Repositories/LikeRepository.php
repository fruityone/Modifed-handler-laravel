<?php

namespace App\Repositories;



use App\Interfaces\LikeInterface;
use Illuminate\Support\Facades\DB;

class LikeRepository implements LikeInterface
{
    public function bloglikeexists(int $blogId)
    {
        return  DB::table('likes')
            ->join('blog_like', 'likes.id', '=', 'blog_like.like_id')
            ->where('blog_like.blog_id', $blogId)
            ->where('likes.user_id', auth('sanctum')->id())
            ->exists();
    }
    public function articlelikeexists(int $blogId){
        return  DB::table('likes')
            ->join('article_like', 'likes.id', '=', 'article_like.like_id')
            ->where('article_like.article_id', $blogId)
            ->where('likes.user_id', auth('sanctum')->id())
            ->exists();
    }
}
