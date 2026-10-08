# Tugas Web Pertemuan 8 – CRUD Inventaris

## 👤 Identitas

- **Nama:** Rahmat Hamonangan Nasution
- **NIM:** 4253250053
- **Universitas:** Universitas Negeri Medan
- **Mata Kuliah:** Pemrograman Web
- **Pertemuan:** 8
- **Topik:** CRUD dengan PHP Native dan MySQL

---

## 📌 Deskripsi

Project ini merupakan implementasi **CRUD (Create, Read, Update, Delete)** menggunakan **PHP Native** dan **MySQL**.

Aplikasi dibuat untuk mengelola data inventaris produk yang terdiri dari data produk, kategori, dan supplier.

Project menggunakan **PDO (PHP Data Objects)** untuk koneksi database serta menerapkan prepared statement untuk meningkatkan keamanan query database.

---

## 🎯 Tujuan

Tujuan dari project ini adalah:

1. Memahami konsep CRUD pada aplikasi web.
2. Memahami koneksi PHP dengan database MySQL.
3. Menggunakan PDO untuk koneksi database.
4. Menggunakan prepared statement pada query database.
5. Membuat relasi antar tabel menggunakan foreign key.
6. Membuat validasi input pada form.
7. Menerapkan sanitasi output menggunakan `htmlspecialchars()`.
8. Membuat antarmuka CRUD yang sederhana dan responsif.

---

## 🛠️ Teknologi yang Digunakan

- PHP Native
- MySQL
- PDO
- HTML5
- CSS3
- Laragon
- phpMyAdmin
- Visual Studio Code

---

## ✨ Fitur

### 1. Read

Menampilkan seluruh data produk dalam bentuk tabel.

Data yang ditampilkan meliputi:

- ID Produk
- Nama Produk
- Kategori
- Supplier
- Harga
- Stok
- Aksi

Data produk ditampilkan menggunakan JOIN dengan tabel kategori dan supplier.

### 2. Create

Menambahkan produk baru melalui form.

Data yang dapat dimasukkan:

- Nama Produk
- Kategori
- Supplier
- Harga
- Stok

Form dilengkapi dengan validasi input.

### 3. Update

Mengubah data produk yang sudah tersimpan.

Data produk dapat diedit melalui tombol **Edit**.

### 4. Delete

Menghapus data produk.

Sebelum data dihapus, pengguna diarahkan ke halaman konfirmasi untuk mencegah penghapusan secara tidak sengaja.

### 5. Relasi Database

Produk memiliki relasi dengan:

- Kategori
- Supplier

Relasi dibuat menggunakan **Foreign Key**.

### 6. Validasi Input

Validasi dilakukan untuk memastikan:

- Nama produk tidak kosong.
- Kategori dipilih.
- Supplier dipilih.
- Harga berupa angka dan tidak negatif.
- Stok berupa bilangan bulat.

### 7. Keamanan

Project menerapkan beberapa dasar keamanan:

- PDO Prepared Statement
- `PDO::ATTR_EMULATE_PREPARES => false`
- Validasi input
- `htmlspecialchars()` untuk output
- Method POST untuk proses penghapusan data

---

## 🗄️ Struktur Database

Database yang digunakan adalah `inventaris_db`.

### Tabel Database

#### `categories`

Menyimpan data kategori produk.

#### `suppliers`

Menyimpan data supplier.

#### `products`

Menyimpan data produk.

### Relasi Database

    categories
         │
         │ 1
         │
         │ N
      products
         │
         │ N
         │
         │ 1
      suppliers

Tabel `products` memiliki foreign key:

- `category_id` → `categories.id`
- `supplier_id` → `suppliers.id`

---

## 📁 Struktur Folder

    TugasWeb-Pertemuan8-CRUD/
    │
    ├── assets/
    │   └── style.css
    │
    ├── config/
    │   └── database.php
    │
    ├── create.php
    ├── delete.php
    ├── edit.php
    ├── index.php
    ├── schema.sql
    └── README.md

### Penjelasan File

| File/Folder | Fungsi |
|---|---|
| `assets/style.css` | Styling tampilan aplikasi |
| `config/database.php` | Konfigurasi koneksi database menggunakan PDO |
| `index.php` | Menampilkan daftar produk |
| `create.php` | Menambahkan produk |
| `edit.php` | Mengubah produk |
| `delete.php` | Menghapus produk |
| `schema.sql` | Struktur dan data awal database |
| `README.md` | Dokumentasi project |

---

## 🔄 Alur CRUD

### Create

    Form Tambah Produk
            ↓
    Validasi Input
            ↓
    Prepared Statement
            ↓
    INSERT ke Database
            ↓
    Kembali ke Daftar Produk

### Read

    Database
       ↓
    SELECT + JOIN
       ↓
    Data Produk
       ↓
    Ditampilkan dalam Tabel

### Update

    Pilih Edit
       ↓
    Ambil Data Berdasarkan ID
       ↓
    Tampilkan Form
       ↓
    Validasi
       ↓
    UPDATE Database
       ↓
    Kembali ke Daftar Produk

### Delete

    Pilih Hapus
       ↓
    Halaman Konfirmasi
       ↓
    Konfirmasi Penghapusan
       ↓
    DELETE Database
       ↓
    Kembali ke Daftar Produk

---

## 📸 Dokumentasi Tampilan

### 1. Daftar Produk

Menampilkan seluruh data produk yang tersimpan di database.

<img width="1366" height="768" alt="Screenshot (360)" src="https://github.com/user-attachments/assets/0c8c99a8-435b-4a42-a800-c5ff91010165" />


<!-- Tempel screenshot daftar produk di sini -->

---

### 2. Form Tambah Produk

Form digunakan untuk memasukkan produk baru.

<img width="1366" height="768" alt="Screenshot (361)" src="https://github.com/user-attachments/assets/2e661529-f299-4281-8929-8129435f7883" />

<!-- Tempel screenshot form tambah produk di sini -->

---

### 3. Produk Berhasil Ditambahkan

Setelah produk berhasil ditambahkan, sistem menampilkan pesan keberhasilan dan produk baru muncul pada daftar.

<img width="1366" height="768" alt="Screenshot (362)" src="https://github.com/user-attachments/assets/db55d502-cdb8-48c4-a946-070b775a53f9" />


<!-- Tempel screenshot hasil tambah produk di sini -->

---

### 4. Edit Produk

Form edit digunakan untuk mengubah data produk yang sudah tersedia.

<img width="1366" height="768" alt="Screenshot (363)" src="https://github.com/user-attachments/assets/04be590b-e257-4f04-881a-a487ecd25ee6" />


<!-- Tempel screenshot form/hasil edit produk di sini -->

---

### 5. Konfirmasi Hapus Produk

Sistem memberikan halaman konfirmasi sebelum produk benar-benar dihapus.

<img width="1366" height="768" alt="Screenshot (364)" src="https://github.com/user-attachments/assets/57069f07-bfff-455b-b2f1-01127867bec7" />


<!-- Tempel screenshot konfirmasi hapus produk di sini -->

---

## 🧪 Pengujian

| No | Pengujian | Hasil |
|---|---|---|
| 1 | Menampilkan daftar produk | ✅ Berhasil |
| 2 | Menambahkan produk | ✅ Berhasil |
| 3 | Validasi form | ✅ Berhasil |
| 4 | Mengedit produk | ✅ Berhasil |
| 5 | Menghapus produk | ✅ Berhasil |
| 6 | Relasi kategori | ✅ Berhasil |
| 7 | Relasi supplier | ✅ Berhasil |
| 8 | Prepared statement | ✅ Diterapkan |

---

