<?php
require_once 'config/DB.php';
require_once 'Controllers/Areaparkir.php';
require_once 'Controllers/Kampus.php';
require_once 'Helpers/helper.php';

$areaParkir = new AreaParkir($pdo);
$kampusController = new Kampus($pdo);
$kampus_list = $kampusController->index();

$area_parkir_id = $_GET['id'] ?? null;
$show_area = $area_parkir_id ? $areaParkir->getById($area_parkir_id) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($area_parkir_id) {
    $areaParkir->update($area_parkir_id, $_POST);
    echo "<script>alert('Data berhasil diperbarui'); window.location='?url=area-parkir';</script>";
  } else {
    $areaParkir->store($_POST);
    echo "<script>alert('Data berhasil ditambahkan'); window.location='?url=area_parkir';</script>";
  }
}
?>

<div class="container">
  <form method="post">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="nama">Nama Area</label>
          <input type="text" class="form-control" id="nama" name="nama"
                 value="<?= getSafeFormValue($show_area, 'nama') ?>" required>
        </div>

        <div class="form-group">
          <label for="kapasitas">Kapasitas</label>
          <input type="number" class="form-control" id="kapasitas" name="kapasitas"
                 value="<?= getSafeFormValue($show_area, 'kapasitas') ?>" required>
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= getSafeFormValue($show_area, 'keterangan') ?></textarea>
        </div>

        <div class="form-group">
          <label for="kampus_id">Kampus</label>
          <select class="form-control" id="kampus_id" name="kampus_id" required>
            <option value="">Pilih Kampus</option>
            <?php foreach ($kampus_list as $item): ?>
              <option value="<?= $item['id'] ?>" <?= getSafeFormValue($show_area, 'kampus_id') == $item['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($item['nama']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="id" value="<?= $area_parkir_id ?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </form>
</div>
