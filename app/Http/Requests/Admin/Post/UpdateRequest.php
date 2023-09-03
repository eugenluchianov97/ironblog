<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'title_ro' => 'nullable',
            'title_en' => 'nullable',
            'content' => 'required',
            'content_ro' => 'nullable',
            'content_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'tags' => 'nullable'
        ];
    }
}
