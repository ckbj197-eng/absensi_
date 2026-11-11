<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT absen.*, siswa.nama, siswa.kelas, siswa.nis
    FROM absen
    JOIN siswa ON absen.id_siswa = siswa.id
    ORDER BY absen.id_absen DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi Siswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcbefc;
            margin: 0;
            padding: 30px;
            color: #4b4b4b;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 20px;
        }

        .btn-tambah {
            display: inline-block;
            background-color: #ae276a;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .btn-tambah:hover {
            background-color: #b32975;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(255, 0, 200, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 15px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #ae276a;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f2f6;
        }

        td {
            border-bottom: 1px solid #e0e0e0;
        }

        .action-links a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .action-links a.edit {
            background-color: #f39c12;
            color: white;
        }

        .action-links a.edit:hover {
            background-color: #d68910;
        }

        .action-links a.hapus {
            background-color: #e74c3c;
            color: white;
        }

        .action-links a.hapus:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<h2>DATA ABSENSI SISWA</h2>

<a href="create.php" class="btn-tambah">+ Tambah Absensi</a>

<br>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>NIS</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($data['nama']); ?></td>
    <td><?= htmlspecialchars($data['kelas']); ?></td>
    <td><?= htmlspecialchars($data['nis']); ?></td>
    <td><?= $data['tanggal']; ?></td>
    <td><?= htmlspecialchars($data['status']); ?></td>
    <td class="action-links">
        <a href="edit.php?id=<?= $data['id_absen']; ?>" class="edit">Edit</a>
        <a href="hapus.php?id=<?= $data['id_absen']; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>