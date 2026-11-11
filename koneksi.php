<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
