<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data penyewa berdasarkan ID
    $sql = "SELECT * FROM pendataan_penyewa_kos WHERE id_penyewa = '$id'";
    $result = $kon->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='halaman1.php';</script>";
    }
}

// Proses update data
if (isset($_POST['update'])) {
    $id_penyewa = $_POST['id_penyewa'];
    $nama_penyewa = $_POST['nama_penyewa'];
    $nomor_hp = $_POST['nomor_hp'];
    $nomor_kamar = $_POST['nomor_kamar'];
    $pembayaran = $_POST['pembayaran'];
    $harga_air = $_POST['harga_air'];
    $total = $_POST['total'];

    $sql_update = "UPDATE pendataan_penyewa_kos 
                   SET nama_penyewa = '$nama_penyewa', nomor_hp = '$nomor_hp', 
                       nomor_kamar = '$nomor_kamar', pembayaran = '$pembayaran', 
                       harga_air = '$harga_air', total = '$total' 
                   WHERE id_penyewa = '$id_penyewa'";

    if ($kon->query($sql_update) === TRUE) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='halaman1.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data: " . $kon->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penyewa</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Penyewa</h2>
        <form action="update.php?id=<?php echo $row['id_penyewa']; ?>" method="POST">
            <div class="mb-3">
                <label for="id_penyewa" class="form-label">ID Penyewa</label>
                <input type="text" class="form-control" id="id_penyewa" name="id_penyewa" value="<?php echo $row['id_penyewa']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="<?php echo $row['nama_penyewa']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo $row['nomor_hp']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor_kamar" name="nomor_kamar" value="<?php echo $row['nomor_kamar']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pembayaran" class="form-label">Biaya Sewa Bulanan</label>
                <input type="number" class="form-control" id="pembayaran" name="pembayaran" value="<?php echo $row['pembayaran']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_air" class="form-label">Harga Air</label>
                <input type="number" class="form-control" id="harga_air" name="harga_air" value="<?php echo $row['harga_air']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="halaman1.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
