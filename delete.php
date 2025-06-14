<?php
require 'config.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Sadece kendi kaydını silebilir
    $stmt = $pdo->prepare("DELETE FROM su_tuketimi WHERE id = ? AND kullanici_id = ?");
    $stmt->execute([$id, $_SESSION['kullanici_id']]);
}

header("Location: dashboard.php");
exit();
?>
