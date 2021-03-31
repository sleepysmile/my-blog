<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

/**
 * Class CommentController
 * @package App\Http\Controllers\Frontend
 */
class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return bool[]
     */
    public function create(CommentRequest $request)
    {
        $validated = $request->validated();
        $success = false;
        $result = Comment::create($validated);

        if ($result !== null) {
            $success = true;
        }

        return [
            'success' => $success
        ];
    }
}
