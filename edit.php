<?php

require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$pdo = $db->getConnection();

$error = '';

$id = $_GET['id'] ?? '';

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die('ID produk tidak valid.');
}

/*
 * Ambil data produk berdasarkan ID
 * Menggunakan prepared statement
 */
$stmt = $pdo->prepare("
    SELECT id, name, category_id, supplier_id, price, stock
    FROM products
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$product = $stmt->fetch();

if (!$product) {
    die('Produk tidak ditemukan.');
}

/*
 * Proses UPDATE ketika form dikirim
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $category_id = $_POST['category_id'] ?? '';
    $supplier_id = $_POST['supplier_id'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';

    if (
        $name === '' ||
        $category_id === '' ||
        $supplier_id === '' ||
        $price === '' ||
        $stock === ''
    ) {
        $error = 'Semua field wajib diisi.';
    } elseif (!is_numeric($price) || $price < 0) {
        $error = 'Harga tidak valid.';
    } elseif (!filter_var($stock, FILTER_VALIDATE_INT) && $stock !== '0') {
        $error = 'Stok harus berupa angka bulat.';
    } else {

        try {

            $updateStmt = $pdo->prepare("
                UPDATE products
                SET
                    name = :name,
                    category_id = :category_id,
                    supplier_id = :supplier_id,
                    price = :price,
                    stock = :stock
                WHERE id = :id
            ");

            $updateStmt->execute([
                ':name' => $name,
                ':category_id' => $category_id,
                ':supplier_id' => $supplier_id,
                ':price' => $price,
                ':stock' => $stock,
                ':id' => $id
            ]);

            header('Location: index.php?success=Produk berhasil diperbarui');
            exit;

        } catch (PDOException $e) {

            $error = 'Gagal memperbarui produk.';
        }
    }

    // Tampilkan kembali data yang baru dikirim
    $product['name'] = $name;
    $product['category_id'] = $category_id;
    $product['supplier_id'] = $supplier_id;
    $product['price'] = $price;
    $product['stock'] = $stock;
}

/*
 * Ambil kategori
 */
$categoryStmt = $pdo->query("
    SELECT id, name
    FROM categories
    ORDER BY name ASC
");

$categories = $categoryStmt->fetchAll();

/*
 * Ambil supplier
 */
$supplierStmt = $pdo->query("
    SELECT id, name
    FROM suppliers
    ORDER BY name ASC
");

$suppliers = $supplierStmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <h1>Edit Produk</h1>

    <?php if ($error !== ''): ?>

        <p>
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>


    <form method="POST">

        <div>
            <label for="name">
                Nama Produk
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?= htmlspecialchars($product['name']) ?>"
                required
            >
        </div>

        <br>


        <div>
            <label for="category_id">
                Kategori
            </label>

            <select
                id="category_id"
                name="category_id"
                required
            >

                <option value="">
                    -- Pilih Kategori --
                </option>

                <?php foreach ($categories as $category): ?>

                    <option
                        value="<?= htmlspecialchars($category['id']) ?>"
                        <?= ($product['category_id'] == $category['id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($category['name']) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <br>


        <div>
            <label for="supplier_id">
                Supplier
            </label>

            <select
                id="supplier_id"
                name="supplier_id"
                required
            >

                <option value="">
                    -- Pilih Supplier --
                </option>

                <?php foreach ($suppliers as $supplier): ?>

                    <option
                        value="<?= htmlspecialchars($supplier['id']) ?>"
                        <?= ($product['supplier_id'] == $supplier['id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($supplier['name']) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <br>


        <div>
            <label for="price">
                Harga
            </label>

            <input
                type="number"
                id="price"
                name="price"
                min="0"
                step="0.01"
                value="<?= htmlspecialchars($product['price']) ?>"
                required
            >
        </div>

        <br>


        <div>
            <label for="stock">
                Stok
            </label>

            <input
                type="number"
                id="stock"
                name="stock"
                min="0"
                value="<?= htmlspecialchars($product['stock']) ?>"
                required
            >
        </div>

        <br>


        <button type="submit">
            Simpan Perubahan
        </button>

    </form>

    <br>

    <a href="index.php">
        ← Kembali ke Daftar Produk
    </a>

</body>

</html>