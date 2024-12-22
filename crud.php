<?php
include 'config.php'; // Memanggil file koneksi database

// Proses Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM patients WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='crud.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses Insert Data
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = $_POST['pekerjaan'];
    $foto = $_FILES['foto']['name'];

    // Upload foto ke folder uploads/
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    $sql = "INSERT INTO patients (nama, email, alamat, telepon, tanggal_lahir, jenis_kelamin, pekerjaan, foto) 
            VALUES ('$nama', '$email', '$alamat', '$telepon', '$tanggal_lahir', '$jenis_kelamin', '$pekerjaan', '$foto')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='crud.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = $_POST['pekerjaan'];

    $sql = "UPDATE patients SET nama='$nama', email='$email', alamat='$alamat', telepon='$telepon', 
            tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', pekerjaan='$pekerjaan' 
            WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='crud.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pasien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">CRUD Data Pasien</h2>

    <!-- Form Tambah Data -->
    <form action="crud.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" name="telepon" class="form-control" placeholder="Telepon" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="file" name="foto" class="form-control-file" required>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
    </form>

    <hr>

    <!-- Tabel Data Pasien -->
    <h4>Data Pasien</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Menampilkan data dari database
            $sql = "SELECT * FROM patients";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['telepon']}</td>
                            <td>{$row['tanggal_lahir']}</td>
                            <td>{$row['jenis_kelamin']}</td>
                            <td>{$row['pekerjaan']}</td>
                            <td><img src='uploads/{$row['foto']}' width='50'></td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='crud.php?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='text-center'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
