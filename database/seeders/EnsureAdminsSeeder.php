<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EnsureAdminsSeeder extends Seeder
{
    public function run(): void
    {
        // ดึงอีเมลจากไฟล์ .env
        $emails = collect(explode(',', (string) env('ADMIN_EMAILS')))
            ->map(fn($e) => trim($e))
            ->filter();

        foreach ($emails as $email) {
            // ถ้ายังไม่มี user นี้ให้สร้างใหม่
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => Str::before($email, '@'),
                    'password' => bcrypt('password123'), // ตั้งรหัสชั่วคราว
                ]
            );

            // ถ้า role ยังไม่ใช่ admin ให้เปลี่ยน
            if ($user->role !== 'admin') {
                $user->forceFill(['role' => 'admin'])->save();
                $this->command->info("✅ {$email} is now admin");
            } else {
                $this->command->info("ℹ️ {$email} already admin");
            }
        }
    }
}
