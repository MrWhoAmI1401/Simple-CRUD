<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan ID
    $sql = "DELETE FROM pendataan_penyewa_kos WHERE id_penyewa = '$id'";

    if ($kon->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='halaman1.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . $kon->error . "');</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='halaman1.php';</script>";
}
?>
