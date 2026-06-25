# ⚡ Sistem Jembatan Data Google Sheets

Aplikasi web pribadi berbasis PHP dan Google Apps Script yang berfungsi sebagai jembatan enkapsulasi data untuk memasukkan data akun bank secara otomatis dan terpusat ke Google Sheets. 

Sistem ini dirancang khusus agar ringan, responsif, dan mudah dikelola langsung melalui perangkat tablet/mobile.

## 🚀 Fitur Utama
- **Secure Login System:** Membatasi akses input data hanya untuk admin.
- **Dynamic Sidebar Menu:** Memudahkan penambahan menu form baru di masa depan cukup melalui file konfigurasi tanpa membongkar struktur HTML.
- **Form Input Otomatis:** Input data akun bank yang langsung terhubung ke Google Sheets API.
- **Live Search & Tabel Data:** Menampilkan data dari Google Sheets secara *real-time* dilengkapi fitur pencarian instan di dashboard.

## 📁 Struktur File
- `config.php` - Pusat pengaturan (Login, URL Apps Script, & Menu Dinamis).
- `index.php` - Halaman gerbang login utama.
- `dashboard.php` - Bingkai dasbor utama (Sidebar & Topbar).
- `logout.php` - Menghapus session sistem dan keluar aman.
- `pages/` - Folder penyimpanan modul halaman (konten).
  - `pages/input_bank.php` - Modul khusus Form & Tabel Akun Bank.

## 🛠️ Cara Pemasangan
1. Upload folder ini ke web server yang mendukung PHP.
2. Tempelkan kode Google Apps Script pada Google Sheets target.
3. Lakukan *Deploy as Web App* pada Google Apps Script dengan akses *Anyone*.
4. Salin URL Web App yang didapat, lalu masukkan ke dalam `config.php` pada bagian `GOOGLE_SCRIPT_URL`.
5. Buka domain/hosting kamu dan sistem siap digunakan.
