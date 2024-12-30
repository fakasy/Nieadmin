<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = isset($_POST['jk']) ? 'l' : 'p';
    $kelas = $_POST['kelas'];

    // Lakukan operasi database untuk update data siswa
    try {
        $query = "UPDATE siswa SET nama = :nama, jk = :jk, kelas = :kelas WHERE id = :id";
        $statement = $koneksi->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':nama', $nama);
        $statement->bindParam(':jk', $jk);
        $statement->bindParam(':kelas', $kelas);
        $statement->execute();

        // Setelah berhasil update, arahkan kembali ke halaman data.php
        header("Location: data.php");
        exit(); // Pastikan untuk keluar dari skrip setelah mengarahkan pengguna
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika halaman diakses tanpa data POST, ambil data siswa dari database
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM siswa WHERE id = :id";
        $statement = $koneksi->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $siswa = $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tambahkan bagian head sesuai kebutuhan -->
</head>
<body>

    <h2>Edit Siswa</h2>

    <form method="post" action="">
        <!-- Tambahkan formulir input untuk nama, jenis kelamin, dan kelas -->
        <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
        <div class="form-group">
            <label for="nama">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama']; ?>">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jk" id="l" value="l" <?= $siswa['jk'] === 'l' ? 'checked' : ''; ?>>
            <label class="form-check-label" for="l">Laki-laki</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jk" id="p" value="p" <?= $siswa['jk'] === 'p' ? 'checked' : ''; ?>>
            <label class="form-check-label" for="p">Perempuan</label>
        </div>
        <div class="form-group">
            <label for="kelas">Kelas Siswa</label>
            <select class="form-select" id="kelas" name="kelas">
                <option value="10" <?= $siswa['kelas'] === '10' ? 'selected' : ''; ?>>Kelas X</option>
                <option value="11" <?= $siswa['kelas'] === '11' ? 'selected' : ''; ?>>Kelas XI</option>
                <option value="12" <?= $siswa['kelas'] === '12' ? 'selected' : ''; ?>>Kelas XII</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>





</body>
</html>
