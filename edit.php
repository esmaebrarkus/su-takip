<?php
require 'config.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int)$_GET['id'];

// Kayıt kullanıcının mı kontrol ediliyor
$stmt = $pdo->prepare("SELECT * FROM su_tuketimi WHERE id = ? AND kullanici_id = ?");
$stmt->execute([$id, $_SESSION['kullanici_id']]);
$kayit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$kayit) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarih = $_POST['tarih'];
    $miktar = $_POST['miktar'];

    if (!empty($tarih) && !empty($miktar) && is_numeric($miktar)) {
        $guncelle = $pdo->prepare("UPDATE su_tuketimi SET tarih = ?, miktar = ? WHERE id = ? AND kullanici_id = ?");
        $guncelle->execute([$tarih, $miktar, $id, $_SESSION['kullanici_id']]);
        header("Location: dashboard.php");
        exit();
    } else {
        $hata = "Lütfen geçerli tarih ve miktar giriniz.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Kayıt Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Kayıt Düzenle</h2>
    <?php if (!empty($hata)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label>Tarih</label>
            <input type="date" name="tarih" class="form-control" required value="<?= htmlspecialchars($kayit['tarih']) ?>" />
        </div>
        <div class="mb-3">
            <label>Miktar (litre)</label>
            <input type="number" step="0.01" name="miktar" class="form-control" required value="<?= htmlspecialchars($kayit['miktar']) ?>" />
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="dashboard.php" class="btn btn-secondary">İptal</a>
    </form>
</div>
</body>
</html>
