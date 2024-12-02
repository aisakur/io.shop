<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: bisque; /* Warna dasar latar belakang */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #6b4226; /* Navbar warna bisque gelap */
            color: #ffffff;
        }

        .navbar a {
            color: #ffffff;
            margin-right: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            background-color: #fffaf0; /* Warna kartu bisque terang */
        }

        .card-header {
            background-color: #deb887; /* Header kartu bisque gelap */
            color: #ffffff;
            text-align: center;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #6b4226; /* Tombol utama warna bisque gelap */
            border: none;
        }

        .btn-primary:hover {
            background-color: #8c5632; /* Hover tombol utama */
        }

        .btn-success {
            background-color: #deb887; /* Tombol tambah produk warna bisque */
            border: none;
            color: #ffffff;
        }

        .btn-success:hover {
            background-color: #c6a16e; /* Hover tombol tambah produk */
        }

        .btn-danger {
            background-color: #b22222; /* Tombol hapus */
            border: none;
        }

        .btn-danger:hover {
            background-color: #d62727;
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            text-align: center;
        }

        .form-inline {
            margin-bottom: 20px;
        }

        input.form-control {
            border: 1px solid #deb887;
        }

        p.card-text {
            color: #6b4226;
        }

        .text-center {
            color: #6b4226; /* Warna teks jika tidak ada produk */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Manage Products</a>
        <div class="ml-auto">
            <a href="dashboard.php" class="btn btn-primary btn-sm">Dashboard</a>
            <a href="add_product.php" class="btn btn-success btn-sm">Add Product</a>
            <a href="../Auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        <!-- Form pencarian produk -->
        <form method="GET" class="form-inline mb-4">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Products" value="<?= htmlspecialchars($searchQuery); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (count($products) > 0): ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?= $product['image']; ?>" class="card-img-top product-img" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #6b4226;"><?= $product['name']; ?></h5>
                                <p class="card-text"><?= $product['description']; ?></p>
                                <p class="card-text"><strong>Price: </strong>Rp <?= number_format($product['price'], 0, ',', '.'); ?></p>
                                <a href="edit_product.php?id=<?= $product['id']; ?>" class="btn btn-primary btn-block">Edit</a>
                                <a href="delete_product.php?id=<?= $product['id']; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No products found for your search query.</p>
        <?php endif; ?>
    </div>
</body>

</html>
=======
<?php
// edit_product.php

require '../config.php';  // Menyertakan koneksi database PDO

// Cek apakah user sudah login dan memiliki role admin
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../dashboard.php');
    exit();
}

// Ambil ID produk dari URL
$product_id = $_GET['id'];

// Ambil data produk yang akan diedit
$query = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Fungsi untuk format harga ke rupiah
function format_rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Proses pembaruan produk jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description']; // Ambil deskripsi dari form

    // Hapus simbol Rp dan titik pemisah ribuan dari input harga
    $price = str_replace(['Rp', '.', ' '], '', $_POST['price']); // Menghapus "Rp", titik dan spasi

    // Pastikan harga berupa angka
    if (!is_numeric($price)) {
        echo "Harga tidak valid!";
        exit;
    }

    $image = $_FILES['image']['name'];
    $target = "../Image/" . basename($image);

    // Jika gambar baru diupload
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Update produk ke database
        $update_query = "UPDATE products SET name = :name, price = :price, image = :image, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($update_query);
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':image' => $image,
            ':description' => $description, // Menambahkan deskripsi ke query
            ':id' => $product_id
        ]);
        header('Location: products.php');
    } else {
        // Jika tidak ada gambar baru, hanya update nama, harga, dan deskripsi
        $update_query = "UPDATE products SET name = :name, price = :price, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($update_query);
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':description' => $description, // Menambahkan deskripsi ke query
            ':id' => $product_id
        ]);
        header('Location: products.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #800000;
        }

        .navbar a {
            color: white;
            margin-right: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #800000;
            color: white;
            text-align: center;
            font-size: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #800000;
            border: none;
        }

        .btn-primary:hover {
            background-color: #9b1b1b;
        }

        .image-preview {
            max-width: 150px;
            border-radius: 10px;
        }

        .mb-3 small {
            display: block;
            margin-top: 10px;
            font-size: 0.875rem;
            color: #555;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Edit Product
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= format_rupiah($product['price']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?= $product['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <small>Current image: <img src="../Image/<?= $product['image']; ?>" class="image-preview" alt="Current Product Image"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
