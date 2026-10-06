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
- MySQL atau SQLite
- Blade Templating
- Bootstrap 5 (via CDN)

## Struktur File

Folder `blog/` berisi file yang dibuat/diubah di atas proyek Laravel bawaan:

```
blog/
├── app/
│   ├── Http/Controllers/PostController.php
│   └── Models/Post.php
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

**Prasyarat:** PHP 8.2+, Composer, dan database (MySQL via XAMPP/Laragon, atau SQLite).

### 1. Buat proyek Laravel baru
Buka terminal di folder `www` (Laragon) atau `htdocs` (XAMPP):

```bash
composer create-project laravel/laravel blog
cd blog
```

### 2. Salin file dari repo ini
Salin seluruh isi folder `blog/` pada repo ini ke dalam proyek `blog` yang baru dibuat, lalu pilih **timpa** untuk file yang sudah ada (`routes/web.php`, `Post.php`, dll.).

### 3. Atur database di `.env`

**Opsi A — MySQL** (buat database kosong bernama `blog_db` lebih dulu, atau biarkan Laravel menawarkan pembuatannya):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=
```

**Opsi B — SQLite:** gunakan pengaturan bawaan Laravel 11/12 (tidak perlu mengubah apa pun).

### 4. Aktifkan tampilan pagination Bootstrap
Buka `app/Providers/AppServiceProvider.php`, lalu ubah menjadi:

```php
<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
```

### 5. Jalankan migration
```bash
php artisan migrate
```
Jika muncul pertanyaan pembuatan database (yes/no), ketik `yes` atau tekan Enter.

## Cara Menjalankan

```bash
php artisan serve
```

Buka **http://127.0.0.1:8000** di browser. Halaman utama otomatis diarahkan ke `/posts`.

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
| `Access denied for user` / koneksi database gagal | Periksa `DB_*` di `.env` dan pastikan MySQL sudah menyala. |
| Tombol pagination tampil besar/berantakan | Pastikan `Paginator::useBootstrapFive()` sudah ditambahkan (langkah 4). |
| Perubahan `.env` tidak terbaca | Jalankan `php artisan config:clear`. |
| Halaman `419 Page Expired` | Pastikan form memiliki `@csrf`, lalu muat ulang halaman. |
| Perubahan view tidak muncul | Jalankan `php artisan view:clear`. |

---