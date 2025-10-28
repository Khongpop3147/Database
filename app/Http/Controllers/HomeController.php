<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        // Get top selling products (hot products)
        $topProducts = Product::with(['images', 'wishlists'])
            ->withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();
        
        // If no products with orders exist, fallback to latest products
        if ($topProducts->isEmpty() || $topProducts->first()->order_items_count == 0) {
            $topProducts = Product::with(['images', 'wishlists'])
                ->latest()
                ->take(5)
                ->get();
        }
        
        $hotProductIds = $topProducts->pluck('id')->toArray();
        
        // Get latest products (excluding hot products) - ensure we always have products
        $latest = Product::with(['images', 'wishlists'])
            ->whereNotIn('id', $hotProductIds)
            ->latest()
            ->take(12)
            ->get();
        
        // If $latest is empty (not enough products), get all products
        if ($latest->isEmpty()) {
            $latest = Product::with(['images', 'wishlists'])
                ->latest()
                ->take(12)
                ->get();
        }
        
        $banners = Banner::active()->get();
        
        return view('home', compact('latest', 'banners', 'topProducts', 'hotProductIds'));
    }
}
