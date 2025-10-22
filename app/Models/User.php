<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔹 เพิ่มส่วนความสัมพันธ์ด้านล่างนี้

    /**
     * ความสัมพันธ์: ผู้ใช้มีรถเข็น (Cart)
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * ความสัมพันธ์: ผู้ใช้มีคำสั่งซื้อ (Orders)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * ความสัมพันธ์: ผู้ใช้สามารถรีวิวสินค้าได้หลายรายการ
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
