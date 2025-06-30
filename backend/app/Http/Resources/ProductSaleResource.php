<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductSaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userId = Auth::guard('api')->id();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'regular_price' => $this->price->regular_price,
            'discount_price' => $this->price->discount_price,
            'is_favorited' => $userId ? $this->favoriteBy('user_id', $userId)->exists() : false,
        ];
    }
}
