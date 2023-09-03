<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'tags'=>'nullable'
        ];
    }
}
