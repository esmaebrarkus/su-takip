<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kullanici_adi = trim($_POST['kullanici_adi']);
    $eposta = trim($_POST['eposta']);
    $sifre = $_POST['sifre'];
    $sifre_tekrar = $_POST['sifre_tekrar'];

    if ($sifre !== $sifre_tekrar) {
        $hata = "Şifreler uyuşmuyor.";
    } else {
        // Eposta zaten var mı kontrol ediyorum
        $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE eposta = ?");
        $stmt->execute([$eposta]);
        if ($stmt->fetch()) {
            $hata = "Bu eposta zaten kayıtlı.";
        } else {
            // Yeni kullanıcıyı ekle
            $sifre_hash = password_hash($sifre, PASSWORD_DEFAULT);
            $ekle = $pdo->prepare("INSERT INTO kullanicilar (kullanici_adi, eposta, sifre) VALUES (?, ?, ?)");
            $ekle->execute([$kullanici_adi, $eposta, $sifre_hash]);
            header("Location: index.php?kayit=basarili");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Kayıt Ol</h2>
    <?php if (!empty($hata)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>
    <form method="post" action="register.php">
        <div class="mb-3">
            <label>Kullanıcı Adı</label>
            <input type="text" name="kullanici_adi" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Eposta</label>
            <input type="email" name="eposta" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Şifre</label>
            <input type="password" name="sifre" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Şifre Tekrar</label>
            <input type="password" name="sifre_tekrar" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Kayıt Ol</button>
    </form>
</div>
</body>
</html>
