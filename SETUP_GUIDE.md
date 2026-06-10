# PANDUAN SETUP PROJECT MEETOPIA

## Ikhtisar Project
**MeeTopia** adalah platform manajemen event MICE (Meetings, Incentives, Conferences, Exhibitions) yang dibangun menggunakan Laravel 10 dengan database MariaDB (XAMPP).

### Fitur Utama
- Authentication System (Register, Login, Role Admin/User, Forgot Password)
- Event Management (CRUD event, upload poster, set kuota & harga)
- Ticket Booking System (Pilih event, pesan tiket, invoice otomatis)
- Payment System (Upload bukti bayar, verifikasi admin)
- E-Ticket Generator (QR Code, download PDF)
- Dashboard Admin (Statistik, grafik, monitoring)
- Reporting System (Laporan peserta, transaksi, kehadiran, export PDF/Excel)

### Database Tables
1. `users` - Data pengguna (admin & user)
2. `events` - Data event
3. `bookings` - Data pemesanan tiket
4. `payments` - Data pembayaran
5. `tickets` - Data e-ticket
6. `attendance` - Data kehadiran

---

## STEP 1: Install Prerequisites

### 1.1 Install XAMPP
1. Download XAMPP dari https://www.apachefriends.org/download.html
2. Pilih versi yang include **PHP 8.1+** dan **MariaDB**
3. Install XAMPP di komputer Anda
4. Buka **XAMPP Control Panel**
5. Start **Apache** dan **MySQL**

### 1.2 Install Composer
1. Download Composer dari https://getcomposer.org/download/
2. Install Composer (pilih versi untuk PHP dari XAMPP)
3. Verifikasi instalasi:
   ```bash
   composer --version
   ```

### 1.3 Verifikasi PHP
```bash
php --version
# Pastikan PHP 8.1 atau lebih baru
```

---

## STEP 2: Setup Database di XAMPP

### 2.1 Buka phpMyAdmin
1. Buka browser, akses: http://localhost/phpmyadmin
2. Klik tab **"New"** atau **"Database"**
3. Buat database baru:
   - Nama database: `meetopia`
   - Collation: `utf8mb4_unicode_ci`
4. Klik **"Create"**

### 2.2 Cek Koneksi MariaDB
- Host: `127.0.0.1`
- Port: `3306`
- Username: `root`
- Password: *(kosongkan jika default XAMPP)*

---

## STEP 3: Copy Project ke Komputer

### 3.1 Copy folder MeeTopia
Copy seluruh folder `MeeTopia` ke directory web server Anda:
```bash
# Pilihan A: Letakkan di htdocs XAMPP
C:\xampp\htdocs\MeeTopia

# Pilihan B: Letakkan di folder manapun (disarankan untuk development)
# Misalnya: C:\Projects\MeeTopia
```

### 3.2 Buka terminal di folder project
```bash
cd C:\Projects\MeeTopia
# atau
cd C:\xampp\htdocs\MeeTopia
```

---

## STEP 4: Install Dependencies

### 4.1 Install Composer packages
```bash
composer install
```
*Tunggu hingga proses selesai (mungkin membutuhkan beberapa menit)*

### 4.2 Jika ada error, coba:
```bash
composer install --no-scripts
composer dump-autoload
```

---

## STEP 5: Konfigurasi Environment

### 5.1 File .env sudah disediakan, pastikan konfigurasi database benar
Buka file `.env` dan sesuaikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meetopia
DB_USERNAME=root
DB_PASSWORD=
```

> **Penting**: Jika MySQL/MariaDB di XAMPP Anda menggunakan password, isi di `DB_PASSWORD`

### 5.2 Generate Application Key
```bash
php artisan key:generate
```

### 5.3 Buat symbolic link untuk storage
```bash
php artisan storage:link
```

---

## STEP 6: Migrate Database

### 6.1 Jalankan migration
```bash
php artisan migrate
```
*Ini akan membuat semua tabel: users, events, bookings, payments, tickets, attendance*

### 6.2 Jalankan seeder (untuk data awal admin)
```bash
php artisan db:seed
```
*Ini akan membuat akun admin default:*
- **Email**: admin@meetopia.com
- **Password**: admin123

Dan akun user demo:
- **Email**: user@meetopia.com
- **Password**: user123

---

## STEP 7: Jalankan Server

### 7.1 Menggunakan Laravel built-in server (disarankan untuk development)
```bash
php artisan serve
```
Buka browser: **http://localhost:8000**

### 7.2 Atau melalui XAMPP (jika project di htdocs)
Buka browser: **http://localhost/MeeTopia/public**

---

## STEP 8: Akses Aplikasi

### User Side
- **Home**: http://localhost:8000/
- **Daftar Event**: http://localhost:8000/events
- **Login**: http://localhost:8000/login
- **Register**: http://localhost:8000/register

### Admin Side
- **Dashboard**: http://localhost:8000/admin/dashboard
- **Kelola Events**: http://localhost:8000/admin/events
- **Kelola Users**: http://localhost:8000/admin/users
- **Transaksi**: http://localhost:8000/admin/transactions
- **Laporan**: http://localhost:8000/admin/reports

### Akun Default
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@meetopia.com | admin123 |
| User | user@meetopia.com | user123 |

---

## STRUKTUR PROJECT

```
MeeTopia/
├── app/
│   ├── Console/
│   │   └── Kernel.php
│   ├── Exceptions/
│   │   └── Handler.php
│   ├── Exports/
│   │   ├── AttendanceExport.php
│   │   ├── BookingsExport.php
│   │   └── UsersExport.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── EventController.php
│   │   │   │   ├── ReportController.php
│   │   │   │   ├── TransactionController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Auth/
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── BookingController.php
│   │   │   ├── EventController.php
│   │   │   ├── HomeController.php
│   │   │   ├── PaymentController.php
│   │   │   └── TicketController.php
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   ├── UserMiddleware.php
│   │   │   └── ... (default Laravel middleware)
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── Attendance.php
│   │   ├── Booking.php
│   │   ├── Event.php
│   │   ├── Payment.php
│   │   ├── Ticket.php
│   │   └── User.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/
│   └── app.php
├── config/
│   ├── app.php
│   └── database.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_events_table.php
│   │   ├── 2024_01_01_000003_create_bookings_table.php
│   │   ├── 2024_01_01_000004_create_payments_table.php
│   │   ├── 2024_01_01_000005_create_tickets_table.php
│   │   ├── 2024_01_01_000006_create_attendance_table.php
│   │   └── 2024_01_01_000007_create_password_reset_tokens_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── index.php
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── events/
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── index.blade.php
│       │   ├── reports/
│       │   │   ├── attendance.blade.php
│       │   │   ├── index.blade.php
│       │   │   ├── participants.blade.php
│       │   │   └── transactions.blade.php
│       │   ├── transactions/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   └── users/
│       │       └── index.blade.php
│       ├── auth/
│       │   ├── forgot-password.blade.php
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── bookings/
│       │   ├── create.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── events/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── payments/
│       │   └── upload.blade.php
│       ├── tickets/
│       │   ├── index.blade.php
│       │   ├── pdf.blade.php
│       │   ├── show.blade.php
│       │   └── verify.blade.php
│       ├── home.blade.php
│       └── layouts/
│           ├── admin.blade.php
│           └── app.blade.php
├── routes/
│   ├── api.php
│   └── web.php
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
├── .env
├── .env.example
├── .gitignore
├── artisan
└── composer.json
```

---

## TROUBLESHOOTING

### 1. Error "Could not open input file: artisan"
Pastikan Anda berada di folder project yang benar:
```bash
cd C:\Projects\MeeTopia
```

### 2. Error koneksi database
- Pastikan MySQL/MariaDB di XAMPP sudah start
- Cek kredensial di file `.env`
- Pastikan database `meetopia` sudah dibuat di phpMyAdmin

### 3. Error "Class not found" setelah composer install
```bash
composer dump-autoload
php artisan clear-compiled
php artisan optimize:clear
```

### 4. Error permission pada storage
```bash
# Windows: tidak perlu
# Linux/Mac:
chmod -R 775 storage bootstrap/cache
```

### 5. Error 500 Internal Server Error
```bash
php artisan key:generate
php artisan config:clear
php artisan cache:clear
```

### 6. Gambar/poster tidak muncul
```bash
php artisan storage:link
```
Pastikan folder `storage/app/public` ada dan accessible.

### 7. Composer install lambat
```bash
composer install --prefer-dist --no-dev
```

---

## USER FLOW

### Peserta (User)
1. Register akun baru
2. Login ke sistem
3. Browse event yang tersedia
4. Lihat detail event
5. Booking tiket (pilih jumlah)
6. Upload bukti pembayaran
7. Tunggu verifikasi admin
8. Dapat e-ticket dengan QR Code
9. Download e-ticket PDF

### Admin
1. Login dengan akun admin
2. Akses dashboard (statistik lengkap)
3. Buat event baru (isi data + upload poster)
4. Verifikasi pembayaran peserta
5. Lihat laporan (peserta, transaksi, kehadiran)
6. Export laporan ke PDF/Excel
7. Kelola users

---

## CATATAN PENTING

1. **Folder vendor/ tidak disertakan** - Anda harus menjalankan `composer install` untuk menggenerate folder ini
2. **Default password admin** adalah `admin123` - segera ganti setelah setup!
3. **Upload poster event** akan disimpan di `storage/app/public/posters/`
4. **Bukti pembayaran** disimpan di `storage/app/public/bukti-transfer/`
5. **QR Code** di-generate menggunakan package `simplesoftwareio/simple-qrcode`
6. **Export PDF** menggunakan `barryvdh/laravel-dompdf`
7. **Export Excel** menggunakan `maatwebsite/excel`

---

## TEKNOLOGI YANG DIGUNAKAN

| Komponen | Teknologi |
|----------|-----------|
| Framework | Laravel 10 |
| Bahasa | PHP 8.1+ |
| Database | MariaDB (via XAMPP) |
| Frontend | Bootstrap 5.3, Bootstrap Icons |
| QR Code | simplesoftwareio/simple-qrcode |
| PDF Export | barryvdh/laravel-dompdf |
| Excel Export | maatwebsite/excel |
| Font | Google Fonts (Inter) |
