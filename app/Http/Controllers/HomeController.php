<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Product::with(['images', 'category'])->latest()->take(6)->get();
        $featured = Product::with(['images', 'category'])->inRandomOrder()->take(4)->get();
        $categories = \App\Models\Category::all();
        
        return view('home', compact('latest', 'featured', 'categories'));
    }
}
