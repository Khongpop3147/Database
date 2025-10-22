<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่อนุญาตให้บันทึกแบบ mass assignment
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * ความสัมพันธ์: รถเข็นนี้เป็นของผู้ใช้คนหนึ่ง
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ความสัมพันธ์: รถเข็นนี้มีหลายรายการสินค้า (CartItem)
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * (ตัวช่วย) นับจำนวนรายการทั้งหมดในรถเข็น (รวมตาม quantity)
     */
    public function totalQuantity(): int
    {
        // ต้องมีความสัมพันธ์ product ใน CartItem จึงจะดึงราคาได้ใน subtotal()
        return (int) $this->items()->sum('quantity');
    }

    /**
     * (ตัวช่วย) คำนวณราคารวมของรถเข็น (ไม่รวมส่วนลด/คูปอง)
     */
    public function subtotal(): float
    {
        // อย่าลืม eager load: Cart::with('items.product')->find($id)
        return (float) $this->items->sum(function ($i) {
            return $i->quantity * ($i->product->price ?? 0);
        });
    }
}
