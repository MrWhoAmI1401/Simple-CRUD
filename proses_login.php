<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi dipanggil

if (isset($_POST['id_admin']) && isset($_POST['password'])) {
    $id_admin = mysqli_real_escape_string($kon, $_POST['id_admin']);
    $password = mysqli_real_escape_string($kon, $_POST['password']);
    
    // Query untuk mengecek ID Admin dan Password
    $sql = "SELECT * FROM admin_login WHERE id_admin = ? AND password = ?";
    $stmt = $kon->prepare($sql);
    $stmt->bind_param("ss", $id_admin, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika login berhasil, simpan session dan redirect
        $_SESSION['admin'] = $id_admin;
        header("Location: halaman1.php"); // Ganti dengan halaman yang sesuai setelah login
    } else {
        // Jika login gagal
        echo "<script>alert('Login gagal! ID Admin atau Password salah.'); window.location.href='login.php';</script>";
    }
}
?>
