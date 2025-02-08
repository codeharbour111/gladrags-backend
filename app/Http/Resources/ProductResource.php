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
        return
        [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'best_seller' => $this->best_seller,
            'has_discount' => $this->has_discount,
            'discount_date' => $this->discount_date,
            'discount_price' => $this->discount_price,
            'color' => $this->color,
            'sku' => $this->sku,
            'created_at' => $this->created_at,
            'category' => new CategoryResource($this->category),
            'images' => new ProductImageCollection($this->images)
        ];
    }
}
