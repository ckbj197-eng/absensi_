<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "
    DELETE FROM absen WHERE id_absen='$id'
");

if ($query) {
    echo "<script>
    alert('Data berhasil dihapus');
    window.location='index.php';
    </script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>