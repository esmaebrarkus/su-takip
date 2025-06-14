<?php
require 'config.php';

if (isset($_SESSION['kullanici_id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eposta = trim($_POST['eposta']);
    $sifre = $_POST['sifre'];

    $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE eposta = ?");
    $stmt->execute([$eposta]);
    $kullanici = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
        $_SESSION['kullanici_id'] = $kullanici['id'];
        $_SESSION['kullanici_adi'] = $kullanici['kullanici_adi'];
        header("Location: dashboard.php");
        exit();
    } else {
        $hata = "Geçersiz eposta veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Kullanıcı Girişi</h2>
    <?php if (!empty($hata)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
    <?php elseif (isset($_GET['kayit']) && $_GET['kayit'] === 'basarili'): ?>
        <div class="alert alert-success">Kayıt başarılı, lütfen giriş yapınız.</div>
    <?php endif; ?>
    <form method="post" action="index.php">
        <div class="mb-3">
            <label>Eposta</label>
            <input type="email" name="eposta" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Şifre</label>
            <input type="password" name="sifre" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Giriş Yap</button>
        <a href="register.php" class="btn btn-link">Kayıt Ol</a>
    </form>
</div>
</body>
</html>
