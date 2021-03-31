<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    /**
     * @param Comment $comment
     */
    public function deleting(Comment $comment)
    {
        $comment->children()->delete();
    }
}
