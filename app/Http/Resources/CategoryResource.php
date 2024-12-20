<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // dd(Storage::url("{$this->image}"));
        return 
        [
            'id' => $this->id,
            'name' => $this->name,
            //'image' => Storage::url("{$this->image}"), //asset('storage/'.$this->image),
            'image' => asset('storage/'.$this->image),
            'sizes' => $this->sizes
        ];
    }
}
