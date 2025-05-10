<?php
require_once 'config/DB.php';
require_once 'Controllers/Areaparkir.php';
require_once 'Helpers/helper.php';

$areaParkir = new AreaParkir($pdo); // <-- ini yang kurang sebelumnya

$list_area = $areaParkir->index();

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'delete') {
    $row = $areaParkir->delete($_POST['id']);
    echo "<script>alert('Data area parkir $row[nama] berhasil dihapus')</script>";
    echo "<script>window.location='?url=area_parkir'</script>";
  }
}
?>


<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=area-parkir-input">
          Tambah Area Parkir
        </a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Area</th>
            <th>Kapasitas</th>
            <th>Keterangan</th>
            <th>Nama Kampus</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($list_area as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['kapasitas'] ?></td>
              <td><?= $row['keterangan'] ?></td>
              <td><?= $row['nama_kampus'] ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=area-parkir-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
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
            <th>Nama Area</th>
            <th>Kapasitas</th>
            <th>Keterangan</th>
            <th>Nama Kampus</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
