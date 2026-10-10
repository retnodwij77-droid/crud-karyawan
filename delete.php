
<?php
// koneksi ke database
include 'koneksi.php';

// ambil id karyawan
$id = $_GET['id'];

// perintah delete
$sql = "DELETE FROM karyawan WHERE id = '$id'";

// eksekusi query
if (mysqli_query($koneksi, $sql)) {
   $pesan = "Data berhasil dihapus";
} else {
    $pesan = "ERROR: " . mysqli_error($koneksi);
}

// tutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
    
<head>
    <meta charset="UTF-8">
    <title>Hapus Data Karyawan</title>
    <link rel="stylesheet" href="/karyawan/style.css?v=2">
</head>
<body>

    <div class="pesan-hapus">
        <h2><?= htmlspecialchars($pesan); ?></h2>
        <a href="data.php" class="tombol-kembali">Kembali</a>
    </div>

</body>
</html>