
<?php
include 'koneksi.php';

// cek apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $penilaian = $_POST['penilaian'];

    if (isset($_POST['id']) && $_POST['id'] != "") {
        // update data
        $id = $_POST['id'];

        $sql = "UPDATE karyawan SET
                nama = '$nama',
                jabatan = '$jabatan',
                alamat = '$alamat',
                penilaian = '$penilaian'
                WHERE id = '$id'";
    } else {
        // tambah data baru
        $sql = "INSERT INTO karyawan
                (nama, jabatan, alamat, penilaian)
                VALUES ('$nama', '$jabatan', '$alamat', '$penilaian')";
    }

    if (mysqli_query($koneksi, $sql)) {
        header("Location: data.php");
        exit;
    } else {
        echo "ERROR: " . mysqli_error($koneksi);
    }
}

// ambil data yang akan diedit
$data = [
    'id' => '',
    'nama' => '',
    'jabatan' => '',
    'alamat' => '',
    'penilaian' => ''
];

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM karyawan WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        die("Data karyawan tidak ditemukan.");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Karyawan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>
    <?= $data['id'] ? 'Ubah Data Karyawan' : 'Form Input Data Karyawan'; ?>
</h2>

<form method="POST">

    <input type="hidden" name="id"
           value="<?= htmlspecialchars($data['id'] ?? '') ?>">

    <label>Nama Karyawan</label>
    <input type="text" name="nama"
           value="<?= htmlspecialchars($data['nama'] ?? '') ?>"
           required>

    <label>Jabatan</label>
    <input type="text" name="jabatan"
           value="<?= htmlspecialchars($data['jabatan'] ?? '') ?>"
           required>

    <label>Alamat</label>
    <input type="text" name="alamat"
           value="<?= htmlspecialchars($data['alamat'] ?? '') ?>"
           required>

    <label>Penilaian</label>
    <input type="number" name="penilaian"
           min="0" max="100"
           value="<?= htmlspecialchars($data['penilaian'] ?? '') ?>"
           required>

    <div class="tombol">
        <button type="submit" name="simpan">
            <?= $data['id'] ? 'Update' : 'Simpan'; ?>
        </button>

        <a href="data.php" class="link-tombol">Kembali</a>
    </div>

</form>

    <p class="petunjuk">
        <a href="data.php">Lihat Data Karyawan</a>
    </p>
</div>

</body>
</html>