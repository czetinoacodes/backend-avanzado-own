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
       return [
            'id' => $this->id,
            'nombre' => $this->name,
            'precio' => $this->price,
            'existencia' => $this->stock,
            'promocionado' => $this->is_featured,
            'categoria' => $this->whenLoaded('category', fn () => $this->category->name),
        ];
    }
}
