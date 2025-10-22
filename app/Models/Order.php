<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่อนุญาตให้บันทึกแบบ mass assignment
     */
    protected $fillable = [
        'user_id',
        'subtotal',
        'discount',
        'total',
        'status',     // ตัวอย่าง: pending, paid, shipped, cancelled
    ];

    /**
     * ความสัมพันธ์: ออเดอร์นี้เป็นของผู้ใช้คนหนึ่ง
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ความสัมพันธ์: ออเดอร์นี้มีหลายรายการสินค้า
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * (ตัวช่วย) ดึง products ที่อยู่ในออเดอร์นี้ผ่าน order_items
     */
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderItem::class,
            'order_id',   // Foreign key บน order_items ชี้มาที่ orders
            'id',         // Local key บน products
            'id',         // Local key บน orders
            'product_id'  // Foreign key บน order_items ชี้ไปที่ products
        );
    }

    /**
     * (ตัวช่วย) คำนวณยอดรวมจาก items เผื่อใช้งานเวลาต้อง re-calc
     */
    public function recalcTotals(): void
    {
        $subtotal = $this->items->sum(fn ($i) => $i->quantity * $i->price);
        $this->subtotal = $subtotal;
        // ถ้ามีคูปอง/ส่วนลด ใส่ logic คำนวณ discount ตรงนี้
        $this->discount = $this->discount ?? 0;
        $this->total = max(0, $this->subtotal - $this->discount);
        $this->save();
    }
}
