<?php
require_once 'config.php';
proteksi_halaman();

$page_aktif = $_GET['page'] ?? 'input_bank';

if (!array_key_exists($page_aktif, $DAFTAR_MENU)) {
    $page_aktif = 'input_bank'; 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor - <?= $DAFTAR_MENU[$page_aktif]['judul'] ?></title>
    <style>
        :root { --primary-color: #007bff; --bg-color: #f4f6f9; }
        body { font-family: Arial, sans-serif; background: var(--bg-color); margin: 0; padding: 0; display: flex; min-height: 100vh; }
        
        .sidebar { width: 260px; background: #2c3e50; color: white; display: flex; flex-direction: column; transition: 0.3s; }
        .sidebar-brand { padding: 20px; font-size: 20px; font-weight: bold; background: #1a252f; text-align: center; }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; flex: 1; }
        .sidebar-menu li a { display: block; padding: 15px 20px; color: #ecf0f1; text-decoration: none; font-size: 16px; border-left: 4px solid transparent; }
        .sidebar-menu li a:hover, .sidebar-menu li.active a { background: #34495e; border-left-color: var(--primary-color); }
        .logout-btn { background: #e74c3c; padding: 15px; text-align: center; color: white; text-decoration: none; font-weight: bold; }
        
        .main-content { flex: 1; padding: 20px; display: flex; flex-direction: column; }
        .topbar { background: white; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .topbar h2 { margin: 0; font-size: 22px; color: #333; }
        
        .grid-layout { display: grid; grid-template-columns: 1fr; gap: 20px; }
        @media(min-width: 1200px) { .grid-layout { grid-template-columns: 1fr 2fr; } }
        .box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        
        .form-group { margin-bottom: 12px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 15px; }
        button.btn-submit { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; }
        .search-box { width: 100%; padding: 12px; margin-bottom: 15px; border: 2px solid var(--primary-color); border-radius: 4px; font-size: 16px; box-sizing: border-box; }
        .table-responsive { overflow-x: auto; max-height: 500px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: var(--primary-color); color: white; position: sticky; top: 0; }
        tr:nth-child(even) { background: #f9f9f9; }

        @media(max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">⚡ Jembatan Data</div>
        <ul class="sidebar-menu">
            <?php foreach ($DAFTAR_MENU as $id => $menu): ?>
                <li class="<?= $page_aktif === $id ? 'active' : '' ?>">
                    <a href="dashboard.php?page=<?= $id ?>">
                        <?= $menu['icon'] ?> <?= $menu['judul'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="logout.php" class="logout-btn">👋 Keluar Sistem</a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h2><?= $DAFTAR_MENU[$page_aktif]['judul'] ?></h2>
            <small>Status: Terhubung</small>
        </div>

        <div class="content-body">
            <?php 
            $file_halaman = "pages/" . $page_aktif . ".php";
            if (file_exists($file_halaman)) {
                include $file_halaman;
            } else {
                echo "<div class='box'><h3>Halaman belum dibuat</h3><p>Silakan buat file <code>$file_halaman</code>.</p></div>";
            }
            ?>
        </div>
    </div>

</body>
</html>
