<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * กำหนดฟิลด์ที่ให้บันทึกค่าได้ (mass assignable)
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    /**
     * ความสัมพันธ์: รีวิวนี้เป็นของผู้ใช้คนหนึ่ง
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ความสัมพันธ์: รีวิวนี้เป็นของสินค้าชิ้นหนึ่ง
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
