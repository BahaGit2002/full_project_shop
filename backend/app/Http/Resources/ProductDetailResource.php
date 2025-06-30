<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'name' => $this->name,
            'brand' => $this->brand,
            'country' => $this->country,
            'packaging' => $this->packaging,
            'image' => $this->image,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'price' => [
                'id' => $this->price->id,
                'has_discount' => $this->price->has_discount,
                'regular_price' => $this->price->regular_price,
                'discount_price' => $this->price->discount_price,
            ],
        ];
    }
}
