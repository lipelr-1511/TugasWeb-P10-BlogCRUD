# TugasWeb-P10-BlogCRUD

Aplikasi **Blog CRUD** sederhana menggunakan **Laravel** — Tugas Rutin Pertemuan 10.
Pengguna dapat membuat, melihat, mengubah, dan menghapus postingan blog dengan validasi form, pesan flash, dan pagination.

---

## Biodata

| | |
|---|---|
| **Nama** | Felipe Maranatha Lumbanraja |
| **NIM** | 4253250014 |
| **Kelas** | PSIK 25C |
| **Mata Kuliah** | Pemrograman Web |


---

## Daftar Isi
1. [Fitur](#fitur)
2. [Kesesuaian dengan Requirement Tugas](#kesesuaian-dengan-requirement-tugas)
3. [Teknologi](#teknologi)
4. [Struktur File](#struktur-file)
5. [Cara Instalasi](#cara-instalasi)
6. [Cara Menjalankan](#cara-menjalankan)
7. [Cara Penggunaan](#cara-penggunaan)
8. [Daftar Route](#daftar-route)
9. [Aturan Validasi](#aturan-validasi)
10. [Troubleshooting](#troubleshooting)

---

## Fitur
- **Create** — menambah postingan baru (judul dan isi).
- **Read** — daftar postingan (6 per halaman) dan halaman detail.
- **Update** — mengedit postingan.
- **Delete** — menghapus postingan dengan konfirmasi.
- Validasi form dengan **pesan error per field** dan **old input** (isian tidak hilang saat error).
- **Flash message** sukses dan gagal (komponen alert Bootstrap).
- **Pagination** dengan Route Model Binding.

## Kesesuaian dengan Requirement Tugas

| # | Requirement | Implementasi |
|---|---|---|
| 1 | `Route::resource('posts')` + named routes | `routes/web.php` |
| 2 | PostController resource (7 method) | `app/Http/Controllers/PostController.php` |
| 3 | Blade layout master + `@extends`/`@yield` | `resources/views/layouts/app.blade.php` |
| 4 | Minimal 2 komponen (Alert, Card) | `components/alert.blade.php`, `components/card.blade.php` |
| 5 | Validasi + error per field + old input | `store()`/`update()` + `@error` dan `old()` di form |
| 6 | Flash message sukses/gagal | `session('success')` dan `session('error')` di layout |
| 7 | `@csrf` semua form + `@method` PUT/DELETE | Form create, edit, dan hapus (index/show) |
| 8 | Route Model Binding + pagination | `show(Post $post)`, `paginate(6)`, `{{ $posts->links() }}` |

## Teknologi
- PHP 8.2+ dan Laravel 11 / 12
- Composer
- SQLite (default) atau MySQL
- Blade Templating
- Bootstrap 5 (via CDN)

## Struktur File

Repository ini berisi proyek Laravel lengkap. File yang dibuat/diubah untuk tugas ini:

```
.
├── app/
│   ├── Http/Controllers/PostController.php
│   ├── Models/Post.php
│   └── Providers/AppServiceProvider.php      (pagination Bootstrap)
├── database/migrations/
│   └── 2026_10_06_000001_create_posts_table.php
├── resources/views/
│   ├── components/
│   │   ├── alert.blade.php
│   │   └── card.blade.php
│   ├── layouts/
│   │   └── app.blade.php
│   └── posts/
│       ├── index.blade.php
│       ├── create.blade.php
│       ├── show.blade.php
│       └── edit.blade.php
└── routes/web.php
```

## Cara Instalasi

**Prasyarat:** PHP 8.2+, Composer, dan Git. Database memakai **SQLite** secara default, jadi tidak perlu menyalakan MySQL.

### 1. Clone repository
```bash
git clone https://github.com/lipelr-1511/TugasWeb-P10-BlogCRUD.git
cd TugasWeb-P10-BlogCRUD
```

### 2. Install dependency
```bash
composer install
```

### 3. Siapkan file environment
```bash
# Windows (PowerShell / CMD)
copy .env.example .env

# macOS / Linux
cp .env.example .env
```

Buat application key:
```bash
php artisan key:generate
```

### 4. Siapkan database

**Opsi A — SQLite (default, disarankan).** Buat file database kosong:
```bash
# Windows (PowerShell)
New-Item database\database.sqlite -ItemType File

# macOS / Linux
touch database/database.sqlite
```
Jika dilewati, Laravel akan menawarkan membuatnya otomatis saat `migrate` (ketik `yes`).

**Opsi B — MySQL.** Buat database kosong `blog_db`, lalu ubah di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan migration
```bash
php artisan migrate
```
Jika muncul pertanyaan yes/no, ketik `yes` atau tekan Enter. Hasil yang benar menampilkan `create_posts_table ... DONE`.

## Cara Menjalankan

```bash
php artisan serve
```

Buka **http://127.0.0.1:8000** di browser. Halaman utama otomatis diarahkan ke `/posts`.

> Biarkan terminal tetap terbuka selama aplikasi dipakai. Tekan `Ctrl + C` untuk menghentikan server.

## Cara Penggunaan

| Aksi | Langkah |
|---|---|
| **Melihat daftar post** | Buka `/posts`. Post terbaru tampil paling atas, 6 post per halaman. |
| **Menambah post** | Klik **+ Tambah Post**, isi judul dan isi konten, lalu klik **Simpan Post**. |
| **Melihat detail** | Klik **Baca Selengkapnya** pada kartu post. |
| **Mengedit post** | Klik **Edit** (di daftar atau halaman detail), ubah isian, lalu klik **Update Post**. |
| **Menghapus post** | Klik **Hapus**, lalu setujui dialog konfirmasi. |
| **Pindah halaman** | Gunakan tombol pagination di bagian bawah daftar. |

Setelah setiap aksi, pesan hijau muncul jika berhasil dan merah jika gagal. Jika isian tidak valid, pesan error muncul di bawah field terkait dan isian sebelumnya tetap terisi.

## Daftar Route

Hasil dari `Route::resource('posts', PostController::class)`. Lihat selengkapnya dengan `php artisan route:list`.

| Method | URI | Nama Route | Method Controller |
|---|---|---|---|
| GET | `/posts` | `posts.index` | `index` |
| GET | `/posts/create` | `posts.create` | `create` |
| POST | `/posts` | `posts.store` | `store` |
| GET | `/posts/{post}` | `posts.show` | `show` |
| GET | `/posts/{post}/edit` | `posts.edit` | `edit` |
| PUT/PATCH | `/posts/{post}` | `posts.update` | `update` |
| DELETE | `/posts/{post}` | `posts.destroy` | `destroy` |

## Aturan Validasi

| Field | Aturan |
|---|---|
| `title` | wajib diisi, teks, maksimal 200 karakter |
| `body` | wajib diisi, teks, minimal 10 karakter |

## Troubleshooting

| Masalah | Solusi |
|---|---|
| `Base table or view not found: posts` | Jalankan `php artisan migrate`. |
| `Access denied for user` / koneksi database gagal | Hanya untuk MySQL: periksa `DB_*` di `.env` dan pastikan MySQL menyala. |
| Tombol pagination tampil besar/berantakan | Pastikan `Paginator::useBootstrapFive()` ada di `app/Providers/AppServiceProvider.php`. |
| Perubahan `.env` tidak terbaca | Jalankan `php artisan config:clear`. |
| Halaman `419 Page Expired` | Pastikan form memiliki `@csrf`, lalu muat ulang halaman. |
| Perubahan view tidak muncul | Jalankan `php artisan view:clear`. |
| `Could not open input file: artisan` | Terminal belum berada di folder proyek. Jalankan `cd TugasWeb-P10-BlogCRUD`. |
| `could not find driver` | Aktifkan ekstensi `pdo_sqlite` dan `sqlite3` di `php.ini`, lalu restart. |
| `No application encryption key has been specified` | Jalankan `php artisan key:generate`. |
| `vendor/autoload.php` tidak ditemukan | Jalankan `composer install`. |
| Browser tidak bisa membuka `127.0.0.1:8000` | Pastikan `php artisan serve` masih berjalan di terminal. Jika port dipakai, gunakan `php artisan serve --port=8001`. |

---
