<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * กำหนดฟิลด์ที่สามารถบันทึกค่าได้
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
    ];

    /**
     * ความสัมพันธ์: สินค้าแต่ละชิ้นอยู่ในหมวดหมู่เดียว
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ความสัมพันธ์: สินค้าหนึ่งมีหลายรูปภาพ
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * ความสัมพันธ์: สินค้าหนึ่งมีรีวิวหลายรายการ
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * ความสัมพันธ์: สินค้าหนึ่งอยู่ในตะกร้าได้หลายใบ
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * ความสัมพันธ์: สินค้าหนึ่งปรากฏในคำสั่งซื้อหลายรายการ
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * ความสัมพันธ์: สินค้าหนึ่งอยู่ในรายการโปรดของหลายคน
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * คำนวณค่าเฉลี่ยเรตติ้ง (ถ้ามีรีวิว)
     */
    public function avgRating()
    {
        return $this->reviews()->avg('rating');
    }
}
