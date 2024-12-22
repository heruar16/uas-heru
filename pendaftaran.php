<?php
include 'config.php'; // Memanggil koneksi database

// Proses penyimpanan data ketika form dikirim
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = $_POST['pekerjaan'];
    $foto = $_FILES['foto']['name'];

    // Upload Foto ke folder 'uploads'
    $target_dir = "uploads/"; // Folder penyimpanan foto
    $target_file = $target_dir . basename($foto);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    // SQL Insert untuk menyimpan data ke database
    $sql = "INSERT INTO patients (nama, email, alamat, telepon, tanggal_lahir, jenis_kelamin, pekerjaan, foto) 
            VALUES ('$nama', '$email', '$alamat', '$telepon', '$tanggal_lahir', '$jenis_kelamin', '$pekerjaan', '$foto')";
    
    // Eksekusi Query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location='pendaftaran.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasien</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Form Pendaftaran Pasien</h2>
    <form action="pendaftaran.php" method="POST" enctype="multipart/form-data">
        <!-- Input Nama -->
        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <!-- Input Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <!-- Input Alamat -->
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
        </div>
        <!-- Input Telepon -->
        <div class="form-group">
            <label for="telepon">No. Telepon:</label>
            <input type="text" class="form-control" name="telepon" id="telepon" required>
        </div>
        <!-- Input Tanggal Lahir -->
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
        </div>
        <!-- Input Jenis Kelamin -->
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <!-- Input Pekerjaan -->
        <div class="form-group">
            <label for="pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" required>
        </div>
        <!-- Input Foto -->
        <div class="form-group">
            <label for="foto">Unggah Foto:</label>
            <input type="file" class="form-control-file" name="foto" id="foto" required>
        </div>
        <!-- Tombol Submit -->
        <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
