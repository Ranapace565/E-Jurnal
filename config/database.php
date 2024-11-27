<?php
// Path menuju file database SQLite
// $dbPath = __DIR__ . '/../storage/ejurnal.db';

// try {
//     // Membuat koneksi ke SQLite
//     $pdo = new PDO("sqlite:" . $dbPath);

//     // Mengatur agar PDO menampilkan error
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "Koneksi ke database berhasil!";
// } catch (PDOException $e) {
//     // Menangani error koneksi
//     echo "Koneksi gagal: " . $e->getMessage();
// }
// /config/Database.php
class Database
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (self::$pdo === null) {
            try {
                // Sesuaikan DSN dengan tipe database Anda
                self::$pdo = new PDO('sqlite:' . __DIR__ . '/../storage/ejurnal.db');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi ke database gagal: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
