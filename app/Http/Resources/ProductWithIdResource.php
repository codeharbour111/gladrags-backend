<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $hasDiscount = $this->has_discount;
        if ($this->discount_date && Carbon::parse($this->discount_date)->isPast()) {
            $hasDiscount = false;
        }

        return 
        [
            'status' => 'success',
            'data' => [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'best_seller' => $this->best_seller,
            'has_discount' => $hasDiscount,
            'discount_price' => $this->discount_price,
            'discount_date' => $this->discount_date,
            'color' => $this->color,
            'sku' => $this->sku,
            'category' => new CategoryResource($this->category),
            'images' => new ProductImageCollection($this->images)
            ]
        ];
    }
}
