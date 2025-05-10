<?php
require_once 'Config/DB.php';
require_once 'Controllers/Kampus.php';

$kampusController = new Kampus($pdo);
$list_kampus = $kampusController->index();

if (isset($_POST['type']) && $_POST['type'] == 'delete') {
  $deleted = $kampusController->delete($_POST['id']);
  echo "<script>alert('Data Kampus berhasil dihapus')</script>";
  echo "<script>window.location='?url=kampus'</script>";
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=kampus-input">
          Tambah Nama Kampus
        </a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kampus</th>
            <th>Alamat</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($list_kampus as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td><?= htmlspecialchars($row['alamat']) ?></td>
              <td><?= htmlspecialchars($row['latitude']) ?></td>
              <td><?= htmlspecialchars($row['longitude']) ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=kampus-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
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
      </table>
    </div>
  </div>
</div>
