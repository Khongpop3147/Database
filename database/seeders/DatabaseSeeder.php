<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ตัวอย่างการสร้าง user ปกติ (ไม่บังคับใช้ก็ได้)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 🔹 เรียก EnsureAdminsSeeder เพื่อล็อก admin ตาม .env
        $this->call([
            EnsureAdminsSeeder::class,
        ]);
    }
}
