<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cart->load('items.product');
        return view('cart.index', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $item = $cart->items()->firstOrCreate(['product_id' => $product->id], ['quantity' => 0]);
        $item->increment('quantity');
        return back()->with('success', 'เพิ่มลงตะกร้าแล้ว');
    }

    public function update(Request $request, CartItem $item)
    {
        $this->authorize('update', $item->cart); // ถ้ามี policy ก็จะเช็กเจ้าของ
        $qty = max(1, (int) $request->integer('quantity'));
        $item->update(['quantity' => $qty]);
        return back()->with('success', 'อัปเดตจำนวนแล้ว');
    }

    public function remove(CartItem $item)
    {
        $this->authorize('update', $item->cart); // ป้องกันแก้ของคนอื่น
        $item->delete();
        return back()->with('success', 'ลบออกจากตะกร้าแล้ว');
    }
}
