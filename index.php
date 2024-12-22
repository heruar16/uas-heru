<?php
// Mulai sesi untuk autentikasi pengguna
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Tangkap parameter halaman
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sistem Apotek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'home' ? 'active' : ''; ?>" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'register' ? 'active' : ''; ?>" href="register.php?page=register">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'crud' ? 'active' : ''; ?>" href="index.php?page=crud">Kelola Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'laporan' ? 'active' : ''; ?>" href="apotek_project/laporan.php?page=laporan">Laporan</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <?php
        // Load halaman berdasarkan parameter 'page'
        switch ($page) {
            case 'register':
                include 'register.php';
                break;
            case 'crud':
                include 'crud.php';
                break;
            case 'laporan':
                include 'laporan.php';
                break;
            default:
                include 'home.php';
                break;
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>