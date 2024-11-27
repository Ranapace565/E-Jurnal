<?php
// Path menuju file database SQLite
$dbPath = __DIR__ . '/../storage/ejurnal.db';

try {
    // Membuat koneksi ke SQLite
    $pdo = new PDO("sqlite:" . $dbPath);

    // Mengatur agar PDO menampilkan error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Koneksi ke database berhasil!";
} catch (PDOException $e) {
    // Menangani error koneksi
    echo "Koneksi gagal: " . $e->getMessage();
}
