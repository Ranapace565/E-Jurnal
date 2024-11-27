<?php

// Koneksi ke database SQLite
$dbFile = __DIR__ . '/../storage/ejurnal.db';
$db = new PDO('sqlite:' . $dbFile);

// Fungsi untuk menghapus semua tabel
function dropAllTables($db)
{
	// Dapatkan semua nama tabel di database
	$query = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';");
	$tables = $query->fetchAll(PDO::FETCH_COLUMN);

	// Hapus setiap tabel yang ditemukan
	foreach ($tables as $table) {
		$db->exec("DROP TABLE IF EXISTS $table;");
	}
	echo "Semua tabel telah dihapus.\n";
}

// Fungsi untuk menjalankan migrasi
function runMigration($db)
{
	$createFilesTable = "CREATE TRIGGER after_group_delete
AFTER DELETE ON groups
FOR EACH ROW
BEGIN
    UPDATE students
    SET group_id = NULL
    WHERE group_id = OLD.id;
END;";

	$db->exec($createFilesTable);

	echo "Migrasi selesai. Tabel telah dibuat ulang.\n";
}

// Jalankan proses refresh migrasi
// dropAllTables($db);
runMigration($db);
