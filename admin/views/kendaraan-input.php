<?php
require_once 'config/DB.php';
require_once 'Controllers/Kendaraan.php';
require_once 'Helpers/helper.php'; // fungsi getSafeFormValue()

$kendaraanController = new Kendaraan($pdo);
$kendaraan_id = $_GET['id'] ?? null;

// Ambil data kendaraan jika edit
$show_kendaraan = $kendaraan_id ? $kendaraanController->getById($kendaraan_id) : [];

// Ambil daftar jenis kendaraan
$jenis_list = $kendaraanController->getAllJenis();

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $data = [
        'merk' => getSafeFormValue($_POST, 'merk'),
        'pemilik' => getSafeFormValue($_POST, 'pemilik'),
        'nopol' => getSafeFormValue($_POST, 'nopol'),
        'thn_beli' => getSafeFormValue($_POST, 'thn_beli'),
        'deskripsi' => getSafeFormValue($_POST, 'deskripsi'),
        'jenis_kendaraan_id' => getSafeFormValue($_POST, 'jenis_kendaraan_id')
    ];

    if ($kendaraan_id) {
        $kendaraanController->update($kendaraan_id, $data);
        echo "<script>alert('Data berhasil diupdate'); window.location='?url=kendaraan';</script>";
    } else {
        $kendaraanController->store($data);
        echo "<script>alert('Data berhasil ditambahkan'); window.location='?url=kendaraan';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $kendaraan_id ? 'Edit' : 'Tambah' ?> Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <form method="post">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?= $kendaraan_id ? 'Edit' : 'Tambah' ?> Kendaraan</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" class="form-control" id="merk" name="merk"
                           value="<?= htmlspecialchars(getSafeFormValue($show_kendaraan, 'merk')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="pemilik">Pemilik</label>
                    <input type="text" class="form-control" id="pemilik" name="pemilik"
                           value="<?= htmlspecialchars(getSafeFormValue($show_kendaraan, 'pemilik')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="nopol">Nomor Polisi</label>
                    <input type="text" class="form-control" id="nopol" name="nopol"
                           value="<?= htmlspecialchars(getSafeFormValue($show_kendaraan, 'nopol')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="thn_beli">Tahun Beli</label>
                    <input type="number" class="form-control" id="thn_beli" name="thn_beli"
                           min="1900" max="<?= date('Y') ?>"
                           value="<?= htmlspecialchars(getSafeFormValue($show_kendaraan, 'thn_beli')) ?>">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= htmlspecialchars(getSafeFormValue($show_kendaraan, 'deskripsi')) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="jenis_kendaraan_id">Jenis Kendaraan</label>
                    <select class="form-control" id="jenis_kendaraan_id" name="jenis_kendaraan_id" required>
                        <option value="">-- Pilih Jenis --</option>
                        <?php foreach ($jenis_list as $jenis): ?>
                            <option value="<?= $jenis['id'] ?>" <?= getSafeFormValue($show_kendaraan, 'jenis_kendaraan_id') == $jenis['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($jenis['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="hidden" name="id" value="<?= htmlspecialchars($kendaraan_id) ?>">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="?url=kendaraan" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
