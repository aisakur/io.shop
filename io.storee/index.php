<?php
<<<<<<< HEAD
// Ambil konfigurasi koneksi database
require 'config.php';

// Inisialisasi variabel pencarian
$searchQuery = '';

// Query default
$query = "SELECT * FROM products";

// Periksa apakah ada parameter pencarian
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $query = "SELECT * FROM products WHERE name LIKE :searchQuery OR description LIKE :searchQuery";
}

// Siapkan dan jalankan query
$stmt = $pdo->prepare($query);

=======
require 'config.php';

// Ambil data produk dengan pencarian
$searchQuery = '';

// Cek jika ada pencarian
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $query = "SELECT * FROM products WHERE name LIKE :searchQuery OR description LIKE :searchQuery";
} else {
    // Jika tidak ada pencarian, tampilkan semua produk
    $query = "SELECT * FROM products";
}

$stmt = $pdo->prepare($query);
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
if ($searchQuery) {
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
} else {
    $stmt->execute();
}
<<<<<<< HEAD

// Ambil semua produk dari hasil query
=======
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>IO STORE</title>
=======
    <title>CERTAMEN STORE</title>
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
<<<<<<< HEAD
            background-color: bisque;
            color: #333333;
            position: relative;
        }
        .bg-image {
            background-color: bisque;
=======
            background-color: #FFFF00;
            color: #ffffff;
            position: relative;
        }
        .bg-image {
            background-color: #FFFF00;
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .navbar {
<<<<<<< HEAD
            background-color: #6b4226; /* Dark bisque tone */
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
=======
            background-color: #000000;
        }
        .navbar-brand, .nav-link {
            color: #FFFFFF !important;
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
        }
        .container {
            padding-top: 20px;
            z-index: 1;
            position: relative;
<<<<<<< HEAD
            background-color: #fffaf0; /* Light bisque */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #333333;
        }
        .card {
            background-color: #ffe4c4; /* Bisque */
            color: #333333;
            margin-bottom: 20px;
            border: 1px solid #deb887; /* Bisque border */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #6b4226; /* Darker bisque tone */
            border-color: #6b4226;
        }
        .btn-primary:hover {
            background-color: #8c5632; /* Slightly lighter tone for hover */
            border-color: #8c5632;
=======
            background-color: #000000;
            border-radius: 10px;
            padding: 20px;
            color: #FFFFFF;
        }
        .card {
            background-color: #000000;
            color: #FFFFFF;
            margin-bottom: 20px;
            border: 2px solid #CCCCCC;
        }
        .btn-primary {
            background-color: #007bff;
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
        }
        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
<<<<<<< HEAD
            border-bottom: 2px solid #deb887; /* Subtle border */
        }
        h1, .form-inline input {
            color: #6b4226;
        }
        .form-inline .form-control {
            border: 1px solid #deb887;
=======
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
        }
    </style>
</head>
<body>
<div class="bg-image"></div>

<nav class="navbar navbar-expand-lg navbar-light">
<<<<<<< HEAD
    <a class="navbar-brand" href="#">IO STORE</a>
=======
    <a class="navbar-brand" href="#">CERTAMEN STORE</a>
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="history.php"><i class="fas fa-history"></i> Riwayat Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Order/cart.php"><i class="fas fa-shopping-cart"></i></a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="Auth/logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="Auth/login.php"><i class="fas fa-sign-in-alt"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <!-- Form pencarian produk -->
    <form method="GET" class="form-inline mb-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search Products" value="<?= htmlspecialchars($searchQuery); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <h1 class="mb-4 text-center">Our Products</h1>
    <div class="row">
        <?php if (empty($products)): ?>
            <p class="text-center w-100">No products found.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?= 'admin/' . $product['image']; ?>" class="card-img-top product-img" alt="Product Image">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">RP <?= number_format($product['price'], 0, ',', '.'); ?></p>
                        <a href="Order/cart.php?action=add&id=<?= $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
