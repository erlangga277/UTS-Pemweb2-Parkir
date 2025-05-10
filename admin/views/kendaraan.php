<?php
require_once 'config/DB.php';              // koneksi database
require_once 'Controllers/Kendaraan.php';        // controller
require_once 'Helpers/helper.php';               // (jika ada helper yang Anda gunakan)

$kendaraanController = new Kendaraan($pdo);
$list_kendaraan = $kendaraanController->indexWithJenis();

if (isset($_POST['type']) && $_POST['type'] === 'delete') {
  $kendaraanController->delete($_POST['id']);
  echo "<script>alert('Data kendaraan berhasil dihapus')</script>";
  echo "<script>window.location='?url=kendaraan'</script>";
}
?>


<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=kendaraan-input">Tambah Kendaraan</a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Pemilik</th>
            <th>Plat Nomor</th>
            <th>Tahun Beli</th>
            <th>Deskripsi</th>
            <th>Jenis Kendaraan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($list_kendaraan as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['merk']) ?></td>
              <td><?= htmlspecialchars($row['pemilik']) ?></td>
              <td><?= htmlspecialchars($row['nopol']) ?></td>
              <td><?= htmlspecialchars($row['thn_beli']) ?></td>
              <td><?= htmlspecialchars($row['deskripsi']) ?></td>
              <td><?= htmlspecialchars($row['jenis_nama'] ?? '-') ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=kendaraan-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                  <form action="" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="type" value="delete">
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Pemilik</th>
            <th>Plat Nomor</th>
            <th>Tahun Beli</th>
            <th>Deskripsi</th>
            <th>Jenis Kendaraan</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
