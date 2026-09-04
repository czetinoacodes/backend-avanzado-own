<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id,
            'name' => $this->name,
            'price' => $this->formattedPrice,
            'stock' => $this->stock,
            'category' => $this->whenLoaded('category', fn() => $this->category->name),
        ];
    }
}
