<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่สามารถบันทึกค่าได้ (mass assignable)
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * ความสัมพันธ์: รายการนี้เป็นของออเดอร์หนึ่ง
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * ความสัมพันธ์: รายการนี้อ้างถึงสินค้าหนึ่ง
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
