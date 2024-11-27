Tempat asset penyimpanan server

untuk baca database ejurnal.db bisa menggunakan db browser atau table plus

dapat melakukan migrasi dengan menggunakan perintah berikut: 
PS C:\laragon\www\E-Jurnal> php migrations/table/fresh_migration.php

dapat melakukan seeding dengan menggunakan perintah berikut: 
PS C:\laragon\www\E-Jurnal> php migrations/factory/UserFactory.php 
//untuk menyesuaikan jumlah user dan username ubah variable :
$roles = "siswa";
$nis = 111121;
$many = 2;
pada migrations/factory/UserFactory.php 