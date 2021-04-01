<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;

/**
 * Class FeedbackController
 * @package App\Http\Controllers\Frontend
 */
class FeedbackController extends Controller
{
    public function create(FeedbackRequest $request)
    {
        $validated = $request->validated();
        $success = false;

        if ($validated) {
            Feedback::query()
                ->create($validated);
            $success = true;
        }

        return [
            'success' => $success
        ];
    }
}
