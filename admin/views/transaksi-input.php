<?php
require_once 'Controllers/Transaksi.php';
require_once 'config/DB.php';
require_once 'Controllers/Areaparkir.php';
require_once 'Controllers/Kampus.php';
require_once 'Controllers/Kendaraan.php';
require_once 'Helpers/helper.php';

$transaksi = new Transaksi($pdo);
$areaParkirController = new Areaparkir($pdo);
$kendaraanController = new Kendaraan($pdo);

$transaksi_id = $_GET['id'] ?? null;
$show_transaksi = $transaksi_id ? $transaksi->show($transaksi_id) : [];

$kendaraan = $kendaraanController->indexWithJenis();
$areas = $areaParkirController->index();

// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['type'] == 'create') {
    $transaksi->create($_POST);
  } elseif ($_POST['type'] == 'update') {
    $transaksi->update($_POST['id'], $_POST);
  }
  echo "<script>alert('Data transaksi berhasil disimpan'); window.location='?url=transaksi';</script>";
  exit;
}


?>

<div class="container mt-4">
  <form method="post">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title"><?= $transaksi1 ? 'Edit' : 'Tambah' ?> Transaksi</h5>
      </div>

      <div class="card-body">
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal"
            value="<?= getSafeFormValue($show_transaksi, 'tanggal') ?>" required>
        </div>

        <div class="form-group">
          <label for="mulai">Waktu Mulai</label>
          <input type="time" class="form-control" id="mulai" name="mulai"
            value="<?= getSafeFormValue($show_transaksi, 'mulai') ?>" required>
        </div>

        <div class="form-group">
          <label for="akhir">Waktu Akhir</label>
          <input type="time" class="form-control" id="akhir" name="akhir"
            value="<?= getSafeFormValue($show_transaksi, 'akhir') ?>" required>
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan" rows="3">
            <?= getSafeFormValue($show_transaksi, 'keterangan') ?>
          </textarea>
        </div>

        <div class="form-group">
          <label for="biaya">Biaya (Rp)</label>
          <input type="number" class="form-control" id="biaya" name="biaya"
            value="<?= getSafeFormValue($show_transaksi, 'biaya') ?>" required>
        </div>

        <div class="form-group">
        <div class="form-group">
  <label for="kendaraan_id">Kendaraan</label>
  <select class="form-control" id="kendaraan_id" name="kendaraan_id" required>
    <option value="">Pilih Kendaraan</option>
    <?php foreach ($kendaraan as $k): ?>
      <option value="<?= htmlspecialchars($k['id']) ?>" 
              <?= getSafeFormValue($show_transaksi, 'kendaraan_id') == $k['id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($k['nopol']) ?> - <?= htmlspecialchars($k['merk']) ?> (<?= htmlspecialchars($k['deskripsi']) ?>)
      </option>
    <?php endforeach; ?>
  </select>
</div>

        </div>

        <div class="form-group">
          <label for="area_parkir_id">Area Parkir</label>
          <select class="form-control" id="area_parkir_id" name="area_parkir_id" required>
            <option value="">Pilih Area Parkir</option>
            <?php foreach ($areas as $a): ?>
              <option value="<?= htmlspecialchars($a['id']) ?>" 
                      <?= getSafeFormValue($show_transaksi, 'area_parkir_id') == $a['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($a['nama']) ?> (<?= htmlspecialchars($a['kapasitas']) ?> slot)
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $transaksi_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $transaksi_id ?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="?url=transaksi" class="btn btn-secondary">Batal</a>
      </div>
    </div>
  </form>
</div>