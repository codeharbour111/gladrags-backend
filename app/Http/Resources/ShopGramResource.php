<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopGramResource extends JsonResource
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
            'image' => asset('storage/'.$this->image) //Storage::url("{$this->image}")
        ];
    }
}
