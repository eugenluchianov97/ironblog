<?php

namespace App\Http\Resources\Admin\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'name' => $this->name,
            'name_ro' => $this->name_ro,
            'name_en' => $this->name_en,
            'created_at' => $this->created_at->format('d.m.Y[H:i:s]'),
            'updated_at' => $this->updated_at->format('d.m.Y[H:i:s]'),
        ];
    }
}
