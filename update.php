
<?php
// koneksi ke database
include 'koneksi.php';

// ambil id karyawan
$id = $_GET['id'];

// perintah update
if (isset($_POST['ubah'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $penilaian = $_POST['penilaian'];

    $sql = "UPDATE karyawan SET
            nama = '$nama',
            jabatan = '$jabatan',
            alamat = '$alamat',
            penilaian = '$penilaian'
            WHERE id = '$id'";

    // eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "Data berhasil diupdate";
        echo "<br><a href='data.php'>Kembali</a>";
    } else {
        echo "ERROR: " . mysqli_error($koneksi);
    }
    exit;
}

// ambil data lama
$sql = "SELECT * FROM karyawan WHERE id = '$id'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);
?>

<h2>Ubah Data Karyawan</h2>

<form method="POST">
    Nama Karyawan:
    <input type="text" name="nama"
    value="<?= $data['nama'] ?>" required>
    <br><br>

    Jabatan:
    <input type="text" name="jabatan"
    value="<?= $data['jabatan'] ?>" required>
    <br><br>

    Alamat:
    <input type="text" name="alamat"
    value="<?= $data['alamat'] ?>" required>
    <br><br>

    Penilaian:
    <input type="number" name="penilaian"
    value="<?= $data['penilaian'] ?>"
    min="0" max="100" required>
    <br><br>

    <button type="submit" name="ubah">Update</button>
    <a href="data.php">Kembali</a>
</form>