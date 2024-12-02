<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

$sql = "SELECT * FROM pendataan_penyewa_kos";
$result = $kon->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Penyewa</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="Logo Unmul Universitas Mulawarman.png" alt="Logo" width="60" height="48" class="d-inline-block align-text-center">
          Daftar Penyewa
        </a>
      </div>
    </nav>


    <div class="container mt-5">
      <h2 class="text-center mb-4">Daftar Penyewa Kos</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
          <a class='btn btn-success' href='create.php'>+ Tambah</a>
            <th>ID Penyewa</th>
            <th>Nama Penyewa</th>
            <th>Nomor HP</th>
            <th>Nomor Kamar</th>
            <th>Pembayaran</th>
            <th>Harga Air</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['id_penyewa']; ?></td>
              <td><?php echo $row['nama_penyewa']; ?></td>
              <td><?php echo $row['nomor_hp']; ?></td>
              <td><?php echo $row['nomor_kamar']; ?></td>
              <td><?php echo $row['pembayaran']; ?></td>
              <td><?php echo $row['harga_air']; ?></td>
              <td><?php echo $row['total']; ?></td>
              <td>
                  <a class='btn btn-success' href='update.php?id=<?php echo $row['id_penyewa']; ?>'>Edit</a>
                  <a class='btn btn-danger' href='delete.php?id=<?php echo $row['id_penyewa']; ?>' onclick='return confirm("Hapus data ini?");'>Delete</a>
              </td>   
          </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
