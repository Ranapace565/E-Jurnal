<?php
echo "Data dummy berhasil dimasukkan ke tabel users.";
// Konfigurasi database
require_once __DIR__ . '/../../config/database.php';

$pdo = Database::getConnection();

$roles = "siswa";
$nis = 111121;
$many = 2;

// Membuat 10 data dummy
$usernames = generateUsername($nis, $many);

for ($i = 0; $i < $many; $i++) {
    $username = $usernames[$i];
    $password = generatePassword($username);

    $role = $roles;

    $user_id = createUser($pdo, $username, $password, $role);

    // Membuat student dengan menggunakan user_id
    createStudent($pdo, $user_id);

    echo "User $username dengan peran $role berhasil dibuat.\n";
}

echo "Data dummy berhasil dimasukkan ke tabel users.";

// Fungsi untuk menghasilkan username acak
function generateUsername($nis, $many)
{
    // ,$length = 8
    $username = [];
    $nis1 = $nis;
    for ($i = 1; $i <= $many; $i++) {
        $username[] = $nis1++;
    }
    return $username;
}

// Fungsi untuk menghasilkan password hash
function generatePassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

// Fungsi untuk menghasilkan token acak
function generateToken()
{
    return bin2hex(random_bytes(16));
}

// Fungsi untuk memasukkan data ke dalam tabel `users`
function createUser($pdo, $username, $password, $role)
{
    $stmt = $pdo->prepare("INSERT INTO users (id,username, password, role) VALUES (:id,:username, :password, :role)");
    $stmt->bindParam(':id', $username);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    return $pdo->lastInsertId();
}

function createStudent($pdo, $user)
{
    $stmt = $pdo->prepare("INSERT INTO students (id, user_id) VALUES (:id, :userid)");
    $stmt->bindParam(':id', $user);
    $stmt->bindParam(':userid', $user);
    $stmt->execute();

    $student_id = $pdo->lastInsertId();

    // Buat observasi untuk student ini
    createObservation($pdo, $student_id);

    return $student_id;
}

function createObservation($pdo, $student_id)
{
    // Insert observation untuk student
    $stmt = $pdo->prepare("INSERT INTO observations (id, nis) VALUES (:id, :nis)");
    $stmt->bindParam(':id', $student_id);
    $stmt->bindParam(':nis', $student_id);
    // $stmt->bindValue(':job', "Job Title Default"); 
    $stmt->execute();
    $observation_id = $pdo->lastInsertId();

    // Buat indikator untuk observasi ini
    createIndicators($pdo, $observation_id);

    return $observation_id;
}

function createIndicators($pdo, $observation_id)
{
    // Contoh data indicators
    $indicatorsData = [
        ["description" => "Penerapan Soft skills yang dibutuhkan dalam dunia kerja (tempat PKL) ", "indicatories" => [
            ["objective" => "Melaksanakan Komunikasi telepon sesuai kaidah", "achievement" => '0'],
            ["objective" => "Menunjukan integritas (antara lain jujur, disiplin komitmen, dan tanggung jawab)", "achievement" => '0'],
            ["objective" => "Memiliki Etos kerja", "achievement" => '0'],
            ["objective" => "Menunjukan kemandirian", "achievement" => '0'],
            ["objective" => "Menunjukan kerjasama", "achievement" => '0'],
            ["objective" => "Menunjukan kepedulian sosial dan lingkungan", "achievement" => '0'],
        ]],
        ["description" => "Menerapkan Norma, POS dan K3LH yang ada di Dunia Kerja (Tempat PKL)", "indicatories" => [
            ["objective" => "Menggunakan APD dengan tertib dan benar", "achievement" => '0'],
            ["objective" => "Melaksanakan pekerjaan dengan POS", "achievement" => '0'],
        ]],
        ["description" => "Menerapkan kompetensi teknis yang sudah dipelajari di sekolah dan/atau baru", "indicatories" => [
            ["objective" => "", "achievement" => '0'],
        ]],
        ["description" => "Dipelajari pada dunia kerja (tempat PKL) Memahami alur bisnis dunia kerja tempat PKL dan wawasan wirausaha", "indicatories" => [
            ["objective" => "Mengidentifikasi kegiatan usaha ditempat kerja", "achievement" => '0'],
            ["objective" => "Menjelaskan rencana usaha yang akan dilaksanakan", "achievement" => '0'],
        ]],

    ];
    $notes = [
        ["note" => "Catatan Guru Pembimbing"],
        ["note" => "Catatan instruktur Industri"],
    ];

    foreach ($indicatorsData as $indicator) {
        $stmt = $pdo->prepare("INSERT INTO indicators (observation_id, description) VALUES (:observation_id, :description)");
        $stmt->bindParam(':observation_id', $observation_id);
        $stmt->bindParam(':description', $indicator['description']);
        $stmt->execute();

        $indicator_id = $pdo->lastInsertId();

        // Buat indicatories untuk setiap indikator
        foreach ($indicator['indicatories'] as $indicatory) {
            $stmtIndicatory = $pdo->prepare("INSERT INTO indicatories (indicators_id, objective, achievement) VALUES (:indicator_id, :objective, :achievement)");
            $stmtIndicatory->bindParam(':indicator_id', $indicator_id);
            $stmtIndicatory->bindParam(':objective', $indicatory['objective']);
            $stmtIndicatory->bindParam(':achievement', $indicatory['achievement']);
            $stmtIndicatory->execute();
        }
    }
    foreach ($notes as $note) {
        $stmt = $pdo->prepare("INSERT INTO notes (observation_id, objective) VALUES (:observation_id, :description)");
        $stmt->bindParam(':observation_id', $observation_id);
        $stmt->bindParam(':description', $note['note']);
        $stmt->execute();
    }
}
