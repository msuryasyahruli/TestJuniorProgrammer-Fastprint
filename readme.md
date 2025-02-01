# Dokumentasi Proyek Manajemen Produk

## 📌 Deskripsi
Proyek ini adalah aplikasi berbasis web sederhana untuk **manajemen produk**. Fitur utama meliputi:
- **Menampilkan daftar produk** beserta kategori dan statusnya.
- **Menambahkan produk baru** dengan kategori dan status yang dipilih.
- **Mengubah informasi produk** yang telah ada.
- **Menghapus produk dengan konfirmasi alert**.

Aplikasi ini menggunakan **PHP dan MySQL** dengan **prepared statements** untuk meningkatkan keamanan dari SQL Injection.

---

## 📂 Struktur Folder
```
📁 project-folder
│── 📄 index.php        # Halaman utama (daftar produk)
│── 📄 tambah.php       # Form tambah produk
│── 📄 ubah.php         # Form ubah produk
│── 📄 config.php       # Konfigurasi database
│── 📄 style.css        # Gaya tampilan
│── 📄 readme.md        # Dokumentasi ini
│── 📄 query.sql        # Struktur dan data awal database
```

---

## 🛠 Instalasi & Konfigurasi

### 1️⃣ **Kloning atau Unduh Proyek**
```
git clone https://github.com/username/repo.git
cd project-folder
```

### 2️⃣ **Buat Database & Import Struktur**
1. **Buka phpMyAdmin**
2. **Buat database baru** dengan nama bebas misal `produk_db`
3. **Import file `query.sql`**

```
CREATE DATABASE produk_db;
USE produk_db;
SOURCE path/to/query.sql;
```

### 3️⃣ **Konfigurasi Database**
Buka file `config.php` dan sesuaikan dengan konfigurasi database Anda:
```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "produk_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
```

### 4️⃣ **Jalankan di Browser**
Jalankan proyek menggunakan server lokal seperti **XAMPP**:
```
http://localhost/project-folder/
```

---

## 🚀 Fitur Aplikasi

### 1️⃣ **Menampilkan Daftar Produk**
Produk akan ditampilkan dalam bentuk tabel pada `index.php`.
- Nama kategori dan status ditampilkan berdasarkan **relasi dengan tabel lain**.
- Tombol **Tambah** untuk menambahkan produk.
- Tombol **Ubah** untuk mengedit produk.
- Tombol **Hapus** dengan alert konfirmasi sebelum menghapus data.

### 2️⃣ **Menambahkan Produk Baru**
- Form tersedia di `tambah.php`.
- Pilihan kategori dan status diambil dari database.
- Menggunakan **prepared statements** untuk keamanan.

### 3️⃣ **Mengubah Produk**
- Form tersedia di `ubah.php`.
- Data produk yang dipilih akan **ditampilkan secara otomatis** dalam input melalui id dari params.
- Opsi kategori dan status yang sudah ada akan **terpilih otomatis**.

### 4️⃣ **Menghapus Produk dengan Konfirmasi**
- Saat klik tombol **Hapus**, akan muncul alert konfirmasi.
- Jika dikonfirmasi, produk akan dihapus dari database dan halaman akan dimuat ulang.

---

## 📋 Struktur Database
### **1. Tabel `produk`**
```sql
CREATE TABLE produk (
    id_produk INT PRIMARY KEY AUTO_INCREMENT,
    nama_produk VARCHAR(255) NOT NULL,
    harga INT NOT NULL,
    kategori_id INT,
    status_id INT,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id_kategori),
    FOREIGN KEY (status_id) REFERENCES status(id_status)
);
```
### **2. Tabel `kategori`**
```sql
CREATE TABLE kategori (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL
);
```
### **3. Tabel `status`**
```sql
CREATE TABLE status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    nama_status VARCHAR(100) NOT NULL
);
```

---

## 🛠 Teknologi yang Digunakan
- **HTML, CSS** → Tampilan frontend
- **PHP** → Backend dan komunikasi dengan database
- **MySQL** → Database
- **JavaScript** → Alert/konfirmasi
- **Prepared Statements** → Keamanan terhadap SQL Injection

---

## 🏆 Kontributor
👤 **Muhammad Surya Syahruli**  
📧 Email: msuryasyahruli18@gmail.com  
🌐 GitHub: [github.com/msuryasyahruli](https://github.com/msuryasyahruli)  

---

## 🔗 Lisensi
Proyek ini dibuat untuk keperluan pembelajaran dan bebas digunakan serta dimodifikasi.
