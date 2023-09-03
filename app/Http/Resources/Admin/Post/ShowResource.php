<?php

namespace App\Http\Resources\Admin\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'title_ro' => $this->title_ro,
            'title_en' => $this->title_en,
            'image' => Storage::disk('posts')->url($this->image),
            'content' => $this->content,
            'content_ro' => $this->content_ro,
            'content_en' => $this->content_en,
            'category_id' => $this->category_id,
            'tags' => $this->tags->pluck('id'),
            'created_at' => $this->created_at->format('d.m.Y[H:i:s]'),
            'updated_at' => $this->updated_at->format('d.m.Y[H:i:s]'),
        ];
    }
}
