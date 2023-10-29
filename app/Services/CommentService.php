<?php

namespace App\Services;

use App\Models\Comment;

/**
 * Class CommentService.
 */
class CommentService
{
    public function createComment($content,$userId,$structure)
    {
        $comment = new Comment(['content' => $content, 'user_id' =>$userId]);
        $structure->comments()->save($comment);
        return $comment;
    }
}
