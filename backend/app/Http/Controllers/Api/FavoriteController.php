<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = $user->favoriteProducts()->get();
        return ProductListResource::collection($products);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();
        $productId = $request->input('product_id');

        if ($user->favoriteProducts ()->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Product already favorites'], 400);
        };

        $user->favoriteProducts()->attach($productId);

        return response()->json(['message' => 'Product added to favorites'], 201);
    }

    public function destroy($productId): JsonResponse
    {
        $user = auth()->user();
        if (!$user->favoriteProducts()->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Product not in favorites'], 400);
        }

        $user->favoriteProducts()->detach($productId);
        return response()->json(['message' => 'Product removed from favorites'], 204);
    }


}
