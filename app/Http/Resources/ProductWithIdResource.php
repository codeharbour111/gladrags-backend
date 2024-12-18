<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductWithIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'status' => 'success',
            'data' => [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'has_discount' => $this->has_discount,
            'discount_date' => $this->discount_date,
            'color' => $this->color,
            'sku' => $this->sku,
            'category' => new CategoryResource($this->category),
            'images' => new ProductImageCollection($this->images)
            ]
        ];
    }
}
