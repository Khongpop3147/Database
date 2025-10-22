<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withAvg('reviews', 'rating')->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['images', 'reviews.user']);
        return view('products.show', compact('product'));
    }
}
