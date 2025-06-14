<?php
session_start();
require_once 'config.php';

// Kullanıcı giriş kontrolü
if (!isset($_SESSION['kullanici_id'])) {
    header('Location: index.php');
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$hata = '';
$basari = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen veriyi alıyorum
    $miktar = filter_input(INPUT_POST, 'miktar', FILTER_VALIDATE_INT);
    $tarih = filter_input(INPUT_POST, 'tarih', FILTER_SANITIZE_STRING);

    if (!$miktar || $miktar <= 0) {
        $hata = "Lütfen geçerli bir su miktarı girin.";
    } elseif (!$tarih) {
        $hata = "Lütfen geçerli bir tarih seçin.";
    } else {
        // Veriyi veritabanına kaydediyorum
        $sql = "INSERT INTO su_tuketimi (kullanici_id, miktar, tarih) VALUES (:kullanici_id, :miktar, :tarih)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':kullanici_id' => $kullanici_id,
            ':miktar' => $miktar,
            ':tarih' => $tarih
        ]);
        $basari = "Su tüketimi başarıyla kaydedildi.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Su Tüketimi Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-5">
    <h1>Günlük Su Tüketimi Ekle</h1>

    <?php if ($hata): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
    <?php endif; ?>
    
    <?php if ($basari): ?>
        <div class="alert alert-success"><?= htmlspecialchars($basari) ?></div>
    <?php endif; ?>

    <form method="POST" action="su_ekle.php">
        <div class="mb-3">
            <label for="miktar" class="form-label">Su Miktarı (ml)</label>
            <input type="number" class="form-control" id="miktar" name="miktar" required min="1" />
        </div>
        <div class="mb-3">
            <label for="tarih" class="form-label">Tarih</label>
            <input type="date" class="form-control" id="tarih" name="tarih" required value="<?= date('Y-m-d') ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Ekle</button>
        <a href="dashboard.php" class="btn btn-secondary">Geri</a>
    </form>
</body>
</html>
