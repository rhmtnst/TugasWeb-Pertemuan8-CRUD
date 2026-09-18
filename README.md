# TugasWeb-Pertemuan8-CRUD

## CRUD Inventaris dengan PHP Native, MySQL, dan PDO

Project ini dibuat untuk memenuhi Tugas Rutin 8 mata kuliah Pemrograman Web.

Aplikasi merupakan sistem CRUD sederhana untuk mengelola data inventaris produk menggunakan PHP Native, MySQL, dan PDO.

## Fitur

- Menampilkan daftar produk
- JOIN tabel products, categories, dan suppliers
- Menambahkan produk
- Mengedit produk
- Menghapus produk dengan halaman konfirmasi
- Dropdown kategori dan supplier
- Validasi input
- Prepared Statement untuk query yang menerima input pengguna
- PDO Singleton
- htmlspecialchars() untuk output HTML
- Pesan keberhasilan setelah proses CRUD
- Tampilan antarmuka sederhana dan responsif

## Teknologi

- PHP Native
- MySQL
- PDO
- HTML
- CSS
- Laragon
- phpMyAdmin
- Visual Studio Code

## Struktur Folder

```text
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

Database

Nama database:

inventaris_db

Tabel:

categories
suppliers
products

Relasi:

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

Tabel products memiliki:

category_id sebagai Foreign Key ke categories.id
supplier_id sebagai Foreign Key ke suppliers.id
Cara Menjalankan Project
1. Jalankan Laragon

Pastikan Apache dan MySQL dalam keadaan running.

2. Buat Database

Buka phpMyAdmin:

http://localhost/phpmyadmin

Buat database:

inventaris_db
3. Import Database

Pilih database inventaris_db.

Kemudian pilih menu Import.

Pilih file:

schema.sql

Klik Import atau Go.

Database akan membuat tabel:

categories
suppliers
products

beserta data awal.

4. Jalankan Aplikasi

Buka browser:

http://localhost/TugasWeb-Pertemuan8-CRUD/
Akun Database

Konfigurasi default Laragon:

Host     : localhost
Database : inventaris_db
Username : root
Password : kosong
Keamanan

Aplikasi menggunakan:

PDO Prepared Statement
PDO::ATTR_EMULATE_PREPARES => false
Validasi input
htmlspecialchars() untuk output
POST untuk proses penghapusan data

