<?php

require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$pdo = $db->getConnection();
$success = $_GET['success'] ?? '';

$sql = "
    SELECT
        products.id,
        products.name,
        categories.name AS category_name,
        suppliers.name AS supplier_name,
        products.price,
        products.stock
    FROM products
    INNER JOIN categories
        ON products.category_id = categories.id
    INNER JOIN suppliers
        ON products.supplier_id = suppliers.id
    ORDER BY products.id ASC
";

$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Daftar Produk Inventaris</h1>
    <a href="create.php" class="btn">+ Tambah Produk</a>
    <?php if ($success !== ''): ?>
    <div style="
        padding: 12px;
        margin: 15px 0;
        background: #d1fae5;
        color: #065f46;
        border-radius: 8px;
    ">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
<tr>
    <th>ID</th>
    <th>Produk</th>
    <th>Kategori</th>
    <th>Supplier</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>
</thead>

        <tbody>

            <?php foreach ($products as $product): ?>

                <tr>
                    <td><?= htmlspecialchars($product['id']) ?></td>

                    <td>
                        <?= htmlspecialchars($product['name']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['category_name']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['supplier_name']) ?>
                    </td>

                    <td>
                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                    </td>

                  <td><?= htmlspecialchars($product['stock']) ?></td>
<td>
   <a href="edit.php?id=<?= $product['id'] ?>" class="action-edit">Edit</a>
|
<a href="delete.php?id=<?= $product['id'] ?>" class="action-delete">Hapus</a>
</td>
</tr>

            <?php endforeach; ?>

        </tbody>
    </table>
 </div>
</body>
</html>