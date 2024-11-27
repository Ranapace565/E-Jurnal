<?php
// Koneksi ke database SQLite
$dbFile = __DIR__ . '/../storage/ejurnal.db';
$db = new PDO('sqlite:' . $dbFile);

// Jalankan perintah VACUUM
$db->exec('VACUUM;');
echo "VACUUM selesai dijalankan.";
