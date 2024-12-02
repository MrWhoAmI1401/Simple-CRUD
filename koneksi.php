<?php

$host="localhost";
$username="root";
$password="";
$db_name="penyewa_kos";

$kon = mysqli_connect($host,$username,$password,$db_name);
if(!$kon){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>