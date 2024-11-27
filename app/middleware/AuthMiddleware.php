<?php
// class AuthMiddleware
// {
//     public static function handle()
//     {
//         session_start();
//         if (!isset($_SESSION['user_id'])) {
//             header("Location: login.php"); // redirect jika belum login
//             exit();
//         }
//         // Perbarui waktu aktivitas untuk setiap request
//         $_SESSION['last_activity'] = time();
//     }
// }
