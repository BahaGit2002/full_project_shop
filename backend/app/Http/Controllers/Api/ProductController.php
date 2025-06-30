<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductSaleResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'price')->get();
        return ProductListResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductDetailResource($product);
    }

    public function sale()
    {
        $products = Product::whereHas('price', function ($query) {
            $query->where('has_discount', true);
        })->with('category', 'price')->get();
        return ProductSaleResource::collection($products);
    }
}
