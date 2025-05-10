<?php
require_once 'config/DB.php';
require_once 'Controllers/Kampus.php';
require_once 'Helpers/helper.php'; // Jika ada fungsi getSafeFormValue()

$kampusController = new Kampus($pdo);
$kampus_id = $_GET['id'] ?? null;

// Ambil data kampus jika sedang edit
$show_kampus = $kampus_id ? $kampusController->getById($kampus_id) : [];

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($kampus_id) {
    $kampusController->update($kampus_id, $_POST);
    echo "<script>alert('Data berhasil diperbarui'); window.location='?url=kampus';</script>";
  } else {
    $kampusController->store($_POST);
    echo "<script>alert('Data berhasil ditambahkan'); window.location='?url=kampus';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $kampus_id ? 'Edit' : 'Tambah' ?> Kampus</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <form method="post">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"><?= $kampus_id ? 'Edit' : 'Tambah' ?> Kampus</h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="nama">Nama Kampus</label>
          <input type="text" class="form-control" id="nama" name="nama"
                 value="<?= getSafeFormValue($show_kampus, 'nama') ?>" required>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= getSafeFormValue($show_kampus, 'alamat') ?></textarea>
        </div>
        <div class="form-group">
          <label for="latitude">Latitude</label>
          <input type="text" class="form-control" id="latitude" name="latitude"
                 value="<?= getSafeFormValue($show_kampus, 'latitude') ?>" required>
        </div>
        <div class="form-group">
          <label for="longitude">Longitude</label>
          <input type="text" class="form-control" id="longitude" name="longitude"
                 value="<?= getSafeFormValue($show_kampus, 'longitude') ?>" required>
        </div>
      </div>
      <div class="card-footer text-right">
        <input type="hidden" name="id" value="<?= $kampus_id ?>">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="?url=kampus" class="btn btn-secondary">Batal</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>
