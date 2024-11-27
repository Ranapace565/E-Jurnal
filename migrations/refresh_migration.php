<?php

// Koneksi ke database SQLite
$dbFile = __DIR__ . '/../storage/ejurnal.db';
$db = new PDO('sqlite:' . $dbFile);

// Fungsi untuk menghapus semua tabel
function dropAllTables($db)
{
    $query = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        $db->exec("DROP TABLE IF EXISTS $table;");
    }
    echo "Semua tabel telah dihapus.\n";
}

// Fungsi untuk menjalankan migrasi dari file SQL di folder migrations
function runMigration($db)
{
    $migrationFiles = glob(__DIR__ . '/../migrations/tables/*.sql'); // Dapatkan semua file SQL di folder migrations

    foreach ($migrationFiles as $file) {
        $sql = file_get_contents($file); // Baca isi file SQL
        $db->exec($sql); // Jalankan SQL untuk membuat tabel
        echo "Migrasi dijalankan untuk file: " . basename($file) . "\n";
    }

    echo "Migrasi selesai. Tabel telah dibuat ulang.\n";
}

// Jalankan proses refresh migrasi
dropAllTables($db);
runMigration($db);
