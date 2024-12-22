<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem Informasi Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0, 123, 255, 0.7), rgba(0, 123, 255, 0.7)), url('assets/images/apotek.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .feature-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .feature-box:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Apotek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="pendaftaran.php"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crud.php?page=crud">Kelola Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=laporan">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <h1>Selamat Datang di Sistem Informasi Apotek</h1>
            <p>Solusi modern untuk pengelolaan data apotek Anda.</p>
            <a href="index.php?page=registration" class="btn btn-light btn-lg">Daftar Sekarang</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Fitur Unggulan</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <h3>Pendaftaran Mudah</h3>
                    <p>Daftarkan data pasien dan pengguna apotek dengan cepat dan aman.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <h3>Pengelolaan Data</h3>
                    <p>Atur data pasien dan obat dengan fitur CRUD yang praktis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <h3>Laporan Cepat</h3>
                    <p>Unduh dan cetak laporan data apotek dengan format yang rapi.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p>&copy; 2024 Sistem Informasi Apotek. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>