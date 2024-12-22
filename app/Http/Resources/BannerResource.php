<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'image' => asset('storage/'.$this->image) //Storage::url("{$this->image}")
        ];
    }
}
