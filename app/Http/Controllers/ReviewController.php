<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // ผู้ใช้ต้องล็อกอินอยู่แล้ว (เราใส่ route ไว้ในกลุ่ม auth)
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating'    => ['required','integer','min:1','max:5'],
            'comment'   => ['nullable','string','max:2000'],
        ]);

        $data['user_id']    = $request->user()->id;
        $data['product_id'] = $product->id;

        Review::create($data);

        return back()->with('success', 'ขอบคุณสำหรับรีวิว!');
    }
}
