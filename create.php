<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $query = mysqli_query($koneksi, "
        INSERT INTO absen (id_siswa, tanggal, status)
        VALUES ('$id_siswa', '$tanggal', '$status')
    ");

    if ($query) {
        echo "<script>
        alert('Data berhasil ditambahkan');
        window.location='index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ff9cf2;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        .container {
            max-width: 500px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.99);
            margin: auto;
        }

        h2 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid #f1f2f6;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #f596ed;
        }

        select, input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #fff;
        }

        select:focus, input[type="datetime-local"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .btn-simpan {
            background-color: #ae2797;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
        }

        .btn-simpan:hover {
            background-color: #d418d4;
        }

        .btn-kembali {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #7f8c8d;
            font-size: 14px;
        }

        .btn-kembali:hover {
            color: #2c3e50;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Data Absensi</h2>

    <form method="POST">
        <div class="form-group">
            <label>Nama Siswa:</label>
            <select name="id_siswa" required>
                <option value="">-- Pilih Siswa --</option>
                <?php
                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
                while ($data = mysqli_fetch_assoc($siswa)) {
                ?>
                <option value="<?= $data['id']; ?>">
                    <?= htmlspecialchars($data['nama']); ?> (<?= htmlspecialchars($data['kelas']); ?>)
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal & Waktu:</label>
            <input type="datetime-local" name="tanggal" required>
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alpa">Alpa</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn-simpan">Simpan Data</button>
    </form>

    <a href="index.php" class="btn-kembali">&larr; Kembali ke Beranda</a>
</div>

</body>
</html>