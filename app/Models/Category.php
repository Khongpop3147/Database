<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * ฟิลด์ที่สามารถบันทึกค่าได้ (mass assignable)
     */
    protected $fillable = [
        'name',
    ];

    /**
     * ความสัมพันธ์: หมวดหมู่หนึ่งมีหลายสินค้า
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
