<?php
session_start();
$_SESSION['last_activity'] = time(); // perbarui saat ada aktivitas
$timeout_duration = 1800; // contoh 30 menit

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset(); // hapus semua variabel sesi
    session_destroy(); // hapus sesi
    header("Location: login.php"); // redirect ke halaman login
    exit();
}
$_SESSION['last_activity'] = time(); // update waktu aktivitas
