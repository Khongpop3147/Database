<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่สามารถบันทึกค่าได้ (mass assignable)
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    /**
     * ความสัมพันธ์: รายการนี้อยู่ในรถเข็นใด
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * ความสัมพันธ์: รายการนี้อ้างถึงสินค้าชิ้นใด
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * (ตัวช่วย) คำนวณราคารวมของรายการนี้ = จำนวน * ราคาสินค้า
     */
    public function total(): float
    {
        return (float) ($this->quantity * ($this->product->price ?? 0));
    }
}
