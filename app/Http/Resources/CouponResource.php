<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'code' => $this->code,
            'discount' => $this->discount,
            'eligible_price' => $this->eligible_price,
            'expire_date' => $this->expire_date
        ];
    }
}
