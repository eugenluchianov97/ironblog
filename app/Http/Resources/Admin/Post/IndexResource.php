<?php

namespace App\Http\Resources\Admin\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IndexResource extends JsonResource
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
            'user' => $this->user,
            'image' => Storage::disk('posts')->url($this->image),
            'category' => $this->category,
            'created_at' => $this->created_at->format('d.m.Y[H:i:s]'),
            'updated_at' => $this->updated_at->format('d.m.Y[H:i:s]'),
        ];
    }
}
