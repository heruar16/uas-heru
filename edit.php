<?php
// Menghubungkan dengan file config untuk koneksi database
include('config.php');

// Mengecek apakah id pasien ada pada URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pasien berdasarkan id
    $query = "SELECT * FROM patients WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek jika data pasien ditemukan
    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        echo "Pasien tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Proses pembaruan data ketika form disubmit
if (isset($_POST['update'])) {
    // Menangkap data form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = $_POST['pekerjaan'];
    $foto = $_FILES['foto']['name'];

    // Menangani file foto
    if ($foto != '') {
        // Mengupload gambar
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    } else {
        // Jika tidak mengubah foto, tetap gunakan foto lama
        $foto = $patient['foto'];
    }

    // Query untuk memperbarui data pasien
    $update_query = "UPDATE patients SET nama = ?, email = ?, alamat = ?, telepon = ?, tanggal_lahir = ?, jenis_kelamin = ?, pekerjaan = ?, foto = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('ssssssssi', $nama, $email, $alamat, $telepon, $tanggal_lahir, $jenis_kelamin, $pekerjaan, $foto, $id);

    // Mengeksekusi query dan memberikan notifikasi
    if ($stmt->execute()) {
        echo "<script>alert('Data pasien berhasil diperbarui!'); window.location.href='patients.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data pasien!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h2>Edit Data Pasien</h2>
        </header>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Pasien</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $patient['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $patient['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $patient['telepon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $patient['tanggal_lahir']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php echo ($patient['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo ($patient['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo $patient['pekerjaan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto Pasien</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
            </div>
            <button type="submit" class="btn btn-success" name="update">Update</button>
            <a href="patients.php" class="btn btn-danger">Batal</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>