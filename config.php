<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. PENGATURAN AKSES LOGIN
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'rahasia123');

// 2. URL WEB APP GOOGLE APPS SCRIPT KAMU
define('GOOGLE_SCRIPT_URL', 'URL_WEB_APP_KAMU_DISINI');

// 3. PENGATURAN MENU DINAMIS (Tambahkan baris di sini untuk menambah menu baru)
$DAFTAR_MENU = [
    'input_bank' => [
        'judul' => 'Form Akun Bank',
        'icon'  => '🏦'
    ],
    // Jika nanti mau tambah menu baru, tinggal hapus tanda komentar di bawah ini:
    /*
    'menu_baru' => [
        'judul' => 'Form Menu Baru',
        'icon'  => '📁'
    ],
    */
];

// Fungsi untuk mengunci halaman agar tidak bisa diintip sebelum login
function proteksi_halaman() {
    if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
        header("Location: index.php");
        exit;
    }
}
?>
