<?php

namespace App\Interfaces;

use Illuminate\Support\Facades\DB;

interface LikeInterface
{
    public function blogLikeExists(int $blogId);
    public function articleLikeExists(int $likeId);
}
