<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Localhost için ayarlar
$host = 'localhost';
$dbname = 'su_takip';        // veritabanı adı
$username = 'root';          // kullanıcı adı
$password = '';              // Şifre genelde boştur

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>
