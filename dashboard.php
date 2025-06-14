<?php
require 'config.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit();
}

// Su tüketimi kayıtlarını al 
$stmt = $pdo->prepare("SELECT * FROM su_tuketimi WHERE kullanici_id = ? ORDER BY tarih DESC");
$stmt->execute([$_SESSION['kullanici_id']]);
$kayitlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Yeni kayıt ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarih = $_POST['tarih'];
    $miktar = $_POST['miktar'];

    if (!empty($tarih) && !empty($miktar) && is_numeric($miktar)) {
        $ekle = $pdo->prepare("INSERT INTO su_tuketimi (kullanici_id, tarih, miktar) VALUES (?, ?, ?)");
        $ekle->execute([$_SESSION['kullanici_id'], $tarih, $miktar]);
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
    <title>Dashboard - Su Takip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>Hoşgeldiniz, <?= htmlspecialchars($_SESSION['kullanici_adi']) ?></h2>
    <a href="logout.php" class="btn btn-danger mb-3">Çıkış Yap</a>

    <?php if (!empty($hata)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>

    <h4>Yeni Su Tüketimi Kaydı Ekle</h4>
    <form method="post" action="dashboard.php" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Tarih</label>
            <input type="date" name="tarih" class="form-control" required />
        </div>
        <div class="col-md-4">
            <label>Miktar (litre)</label>
            <input type="number" step="0.01" name="miktar" class="form-control" required />
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Ekle</button>
        </div>
    </form>

    <h4>Su Tüketimi Kayıtlarınız</h4>
    <?php if ($kayitlar): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tarih</th>
                    <th>Miktar (litre)</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kayitlar as $kayit): ?>
                    <tr>
                        <td><?= htmlspecialchars($kayit['tarih']) ?></td>
                        <td><?= htmlspecialchars($kayit['miktar']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $kayit['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                            <a href="delete.php?id=<?= $kayit['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Kayıt bulunamadı.</p>
    <?php endif; ?>
</div>
</body>
</html>
