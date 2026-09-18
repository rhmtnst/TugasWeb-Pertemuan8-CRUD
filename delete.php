<?php

require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$pdo = $db->getConnection();

$id = $_GET['id'] ?? '';

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die('ID produk tidak valid.');
}

// Ambil data produk
$stmt = $pdo->prepare("
    SELECT
        products.id,
        products.name,
        categories.name AS category_name,
        suppliers.name AS supplier_name
    FROM products
    INNER JOIN categories
        ON products.category_id = categories.id
    INNER JOIN suppliers
        ON products.supplier_id = suppliers.id
    WHERE products.id = :id
");

$stmt->execute([
    ':id' => $id
]);

$product = $stmt->fetch();

if (!$product) {
    die('Produk tidak ditemukan.');
}

// Proses DELETE setelah konfirmasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $deleteStmt = $pdo->prepare("
            DELETE FROM products
            WHERE id = :id
        ");

        $deleteStmt->execute([
            ':id' => $id
        ]);

        header('Location: index.php?success=Produk berhasil dihapus');
        exit;

    } catch (PDOException $e) {

        die('Gagal menghapus produk.');
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hapus Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="container">

    <h1>Hapus Produk</h1>

    <form method="POST">

        <p>Apakah kamu yakin ingin menghapus produk berikut?</p>

        <h2><?= htmlspecialchars($product['name']) ?></h2>

        <p>Kategori: <?= htmlspecialchars($product['category_name']) ?></p>

        <p>Supplier: <?= htmlspecialchars($product['supplier_name']) ?></p>

        <br>

        <button type="submit">Ya, Hapus Produk</button>
        <a href="index.php">Batal</a>

    </form>

</div>

</body>

</html>