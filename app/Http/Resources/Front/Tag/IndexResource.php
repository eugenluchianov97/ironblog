<?php

namespace App\Http\Resources\Front\Tag;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'name_ru' => $this->name,
            'name_ro' => $this->name_ro,
            'name_en' => $this->name_en,
        ];
    }
}
