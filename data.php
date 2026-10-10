
<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM karyawan ORDER BY id DESC");

function hasilPenilaian($nilai) {
    if ($nilai <= 50) {
        return "Kurang";
    } elseif ($nilai <= 60) {
        return "Cukup";
    } elseif ($nilai <= 79) {
        return "Baik";
    } else {
        return "Sangat Baik";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="menu">
    <a href="index.php" class="link-tombol">Kembali</a>
</div>

    <div class="tabel-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Penilaian</th>
                    <th>Hasil</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;

                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['nama']); ?></td>
                    <td><?= htmlspecialchars($data['jabatan']); ?></td>
                    <td><?= htmlspecialchars($data['alamat']); ?></td>
                    <td><?= $data['penilaian']; ?></td>
                    <td><?= hasilPenilaian($data['penilaian']); ?></td>
                    <td class="aksi">
                        <a href="index.php?id=<?= $data['id']; ?>"class="btn-update">Update</a>

                        <a href="delete.php?id=<?= $data['id']; ?>"
                           class="btn-delete"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                           delete
                        </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="7">Belum ada data karyawan.</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>