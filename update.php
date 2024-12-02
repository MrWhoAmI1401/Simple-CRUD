<?php
session_start();
include "koneksi.php";

$row = [
    'id_penyewa' => '',
    'nama_penyewa' => '',
    'nomor_hp' => '',
    'nomor_kamar' => '',
    'pembayaran' => '',
    'harga_air' => '',
    'total' => ''
];

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($kon, $_GET['id']);

    $sql = "SELECT * FROM pendataan_penyewa_kos WHERE id_penyewa = ?";
    $stmt = $kon->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $page_title = "Edit Data Penyewa";
        $form_action = "update.php?id=" . $row['id_penyewa'];
        $submit_button = "Update";
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='halaman1.php';</script>";
        exit();
    }
} else {
    $page_title = "Tambah Data Penyewa";
    $form_action = "create.php";
    $submit_button = "Tambah";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_penyewa = isset($_POST['id_penyewa']) ? mysqli_real_escape_string($kon, $_POST['id_penyewa']) : '';
    $nama_penyewa = mysqli_real_escape_string($kon, $_POST['nama_penyewa']);
    $nomor_hp = mysqli_real_escape_string($kon, $_POST['nomor_hp']);
    $nomor_kamar = mysqli_real_escape_string($kon, $_POST['nomor_kamar']);
    $pembayaran = mysqli_real_escape_string($kon, $_POST['pembayaran']);
    $harga_air = mysqli_real_escape_string($kon, $_POST['harga_air']);
    $total = mysqli_real_escape_string($kon, $_POST['total']);

    if (!empty($id_penyewa)) {
        $sql_query = "UPDATE pendataan_penyewa_kos 
                      SET nama_penyewa = ?, 
                          nomor_hp = ?, 
                          nomor_kamar = ?, 
                          pembayaran = ?, 
                          harga_air = ?, 
                          total = ? 
                      WHERE id_penyewa = ?";
        $stmt = $kon->prepare($sql_query);
        $stmt->bind_param("sssssss", $nama_penyewa, $nomor_hp, $nomor_kamar, $pembayaran, $harga_air, $total, $id_penyewa);
        $success_message = "Data berhasil diupdate!";
    }

    if ($stmt->execute()) {
        echo "<script>
                alert('$success_message'); 
                window.location.href='halaman1.php'; // Redirect langsung ke halaman1.php
              </script>";
        exit();
    } else {
        echo "<script>alert('Gagal menyimpan data: " . $stmt->error . "');</script>";
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
