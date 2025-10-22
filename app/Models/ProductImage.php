<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * กำหนดฟิลด์ที่สามารถบันทึกค่าได้ (mass assignable)
     */
    protected $fillable = [
        'product_id',
        'path',
        'is_primary',
    ];

    /**
     * ความสัมพันธ์: รูปนี้เป็นของสินค้าชิ้นหนึ่ง
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
