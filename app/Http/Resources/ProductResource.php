<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $hasDiscount = $this->has_discount;
        if ($this->discount_date && Carbon::parse($this->discount_date)->isPast()) {
            $hasDiscount = false;
        }

        return
        [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'best_seller' => $this->best_seller,
            'has_discount' => $hasDiscount,
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
