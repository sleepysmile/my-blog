<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FeedbackRequest
 * @package App\Http\Requests
 */
class FeedbackRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'website' => 'required|url',
            'message' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name',
            'email',
            'website',
            'message',
        ];
    }
}
