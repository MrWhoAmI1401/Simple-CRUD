<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_penyewa = mysqli_real_escape_string($kon, $_POST['id_penyewa']);
    $nama_penyewa = mysqli_real_escape_string($kon, $_POST['nama_penyewa']);
    $nomor_hp = mysqli_real_escape_string($kon, $_POST['nomor_hp']);
    $nomor_kamar = mysqli_real_escape_string($kon, $_POST['nomor_kamar']);
    $pembayaran = mysqli_real_escape_string($kon, $_POST['pembayaran']);
    $harga_air = mysqli_real_escape_string($kon, $_POST['harga_air']);
    $total = mysqli_real_escape_string($kon, $_POST['total']);

    // Periksa apakah id_penyewa sudah ada
    $check_sql = "SELECT id_penyewa FROM pendataan_penyewa_kos WHERE id_penyewa = ?";
    $stmt = $kon->prepare($check_sql);
    $stmt->bind_param("s", $id_penyewa);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('ID Penyewa sudah ada!');</script>";
    } else {
        // Insert data baru
        $sql_query = "INSERT INTO pendataan_penyewa_kos (id_penyewa, nama_penyewa, nomor_hp, nomor_kamar, pembayaran, harga_air, total) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $kon->prepare($sql_query);
        $stmt->bind_param("sssssss", $id_penyewa, $nama_penyewa, $nomor_hp, $nomor_kamar, $pembayaran, $harga_air, $total);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='halaman1.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data: " . $stmt->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penyewa</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Data Penyewa</h2>
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="id_penyewa" class="form-label">ID Penyewa</label>
                <input type="text" class="form-control" id="id_penyewa" name="id_penyewa" required>
            </div>
            <div class="mb-3">
                <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" required>
            </div>
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
            </div>
            <div class="mb-3">
                <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor_kamar" name="nomor_kamar" required>
            </div>
            <div class="mb-3">
                <label for="pembayaran" class="form-label">Biaya Sewa Bulanan</label>
                <input type="number" class="form-control" id="pembayaran" name="pembayaran" required>
            </div>
            <div class="mb-3">
                <label for="harga_air" class="form-label">Harga Air</label>
                <input type="number" class="form-control" id="harga_air" name="harga_air" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" id="total" name="total" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="halaman1.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
