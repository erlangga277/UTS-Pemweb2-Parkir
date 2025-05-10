<?php
class Kendaraan {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  // Menampilkan semua kendaraan dengan nama jenis kendaraan
  public function indexWithJenis() {
    $stmt = $this->pdo->prepare("SELECT k.*, j.nama AS jenis_nama FROM kendaraan k LEFT JOIN jenis j ON k.jenis_kendaraan_id = j.id");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Mendapatkan satu kendaraan berdasarkan ID (digunakan untuk edit)
  public function getById($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM kendaraan WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Menambahkan kendaraan baru
  public function store($data) {
    $stmt = $this->pdo->prepare("INSERT INTO kendaraan (merk, pemilik, nopol, thn_beli, deskripsi, jenis_kendaraan_id) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([
      $data['merk'],
      $data['pemilik'],
      $data['nopol'],
      $data['thn_beli'],
      $data['deskripsi'],
      $data['jenis_kendaraan_id']
    ]);
  }

  // Mengupdate data kendaraan
  public function update($id, $data) {
    $stmt = $this->pdo->prepare("UPDATE kendaraan SET merk = ?, pemilik = ?, nopol = ?, thn_beli = ?, deskripsi = ?, jenis_kendaraan_id = ? WHERE id = ?");
    return $stmt->execute([
      $data['merk'],
      $data['pemilik'],
      $data['nopol'],
      $data['thn_beli'],
      $data['deskripsi'],
      $data['jenis_kendaraan_id'],
      $id
    ]);
  }

  // Menghapus kendaraan
  public function delete($id) {
    $stmt = $this->pdo->prepare("DELETE FROM kendaraan WHERE id = ?");
    return $stmt->execute([$id]);
  }

  // Mendapatkan semua jenis kendaraan (untuk dropdown input)
  public function getAllJenis() {
    $stmt = $this->pdo->prepare("SELECT * FROM jenis");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>