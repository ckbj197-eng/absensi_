<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "
    SELECT * FROM absen WHERE id_absen='$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan");
}

if (isset($_POST['update'])) {

    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $update = mysqli_query($koneksi, "
        UPDATE absen SET
        id_siswa='$id_siswa',
        tanggal='$tanggal',
        status='$status'
        WHERE id_absen='$id'
    ");

    if ($update) {
        echo "<script>
        alert('Data berhasil diubah');
        window.location='index.php';
        </script>";
    }
}

$tanggal = date('Y-m-d\TH:i', strtotime($data['tanggal']));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Absensi</title>
</head>
<body>

<h2>Edit Data Absensi</h2>

<form method="POST">

    Nama Siswa:
    <select name="id_siswa" required>

        <?php
        $siswa = mysqli_query($koneksi, "SELECT * FROM siswa");

        while ($s = mysqli_fetch_assoc($siswa)) {
        ?>
        <option value="<?= $s['id']; ?>"
        <?= ($s['id'] == $data['id_siswa']) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($s['nama']); ?>
        </option>
        <?php } ?>

    </select>

    <br><br>

    Tanggal:
    <input type="datetime-local" name="tanggal"
    value="<?= $tanggal; ?>" required>

    <br><br>

    Status:
    <select name="status" required>
        <option value="Hadir" <?= $data['status']=='Hadir'?'selected':''; ?>>Hadir</option>
        <option value="Izin" <?= $data['status']=='Izin'?'selected':''; ?>>Izin</option>
        <option value="Sakit" <?= $data['status']=='Sakit'?'selected':''; ?>>Sakit</option>
        <option value="Alpa" <?= $data['status']=='Alpa'?'selected':''; ?>>Alpa</option>
    </select>

    <br><br>

    <button type="submit" name="update">Update</button>

</form>

<br>
<a href="index.php">Kembali</a>

</body>
</html>

