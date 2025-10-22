<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function summary()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.product')->firstOrFail();
        abort_if($cart->items->isEmpty(), 404);
        $subtotal = $cart->items->sum(fn($i)=> $i->quantity * ($i->product->price ?? 0));
        return view('checkout.summary', compact('cart','subtotal'));
    }

    public function confirm()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.product')->firstOrFail();
        $subtotal = $cart->items->sum(fn($i)=> $i->quantity * ($i->product->price ?? 0));

        $order = Order::create([
            'user_id'  => auth()->id(),
            'subtotal' => $subtotal,
            'discount' => 0,
            'total'    => $subtotal,
            'status'   => 'paid',
        ]);

        foreach ($cart->items as $ci) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $ci->product_id,
                'quantity'  => $ci->quantity,
                'price'     => $ci->product->price ?? 0,
            ]);
        }
        $cart->items()->delete();

        return redirect()->route('home')->with('success', 'สั่งซื้อสำเร็จ!');
    }
}
