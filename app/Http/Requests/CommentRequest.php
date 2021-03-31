<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'website' => 'required|url',
            'message' => 'required',
            'owner_name' => 'required|max:255',
            'owner_id' => 'required|int',
            'parent_id' => 'exists:comment,id|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'name',
            'email',
            'website',
            'message',
            'owner_name',
            'owner_id',
        ];
    }
}
