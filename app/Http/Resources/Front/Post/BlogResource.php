<?php

namespace App\Http\Resources\Front\Post;

use App\Http\Resources\Front\Category\IndexResource as CategoryResource;
use App\Http\Resources\Front\Tag\IndexResource as TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_ru' => $this->title,
            'title_ro' => $this->title_ro,
            'title_en' => $this->title_en,
            'image' => Storage::disk('posts')->url('360x220/'.$this->image),
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'user' => $this->user,
            'created_at' => $this->created_at->format('d M Y'),
            'updated_at' => $this->updated_at->format('d.m.Y[H:i:s]'),
        ];
    }
}
