# 🚀 คู่มือติดตั้งโปรเจค ShopHub

## คำสั่งสำหรับ Clone มาใหม่ (Windows + Docker)

```powershell
# 1. Clone และเข้าโฟลเดอร์
git clone https://github.com/Khongpop3147/Database.git
cd Database

# 2. สร้างไฟล์ .env
copy .env.example .env

# 3. เปิด Docker
docker compose up -d

# 4. ติดตั้ง PHP packages
docker compose exec laravel.test composer install

# 5. สร้าง App Key
docker compose exec laravel.test php artisan key:generate

# 6. สร้างตารางในฐานข้อมูล
docker compose exec laravel.test php artisan migrate --seed

# 7. สร้าง symlink สำหรับรูปภาพ
docker compose exec laravel.test php artisan storage:link

# 8. ติดตั้งและ build frontend
npm install
npm run build
```

เสร็จแล้วเปิด: **http://localhost**

---

## ⚠️ แก้ปัญหาที่พบบ่อย

**Error: Table 'wishlists' doesn't exist**

```powershell
docker compose exec laravel.test php artisan migrate
```

**หน้าเว็บไม่มี styling / โลโก้ใหญ่**

```powershell
npm install
npm run dev
```
