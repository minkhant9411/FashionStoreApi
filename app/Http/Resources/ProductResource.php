<?php

namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Category;
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
            "id" => $this->id,
            'title' => $this->title,
            'size' => $this->size,
            'color' => $this->color,
            'brand' => Brand::find($this->brand_id)->title,
            'category' => Category::find($this->category_id)->title,
            'arrival_time' => $this->arrival_time,
        ];
    }
}
