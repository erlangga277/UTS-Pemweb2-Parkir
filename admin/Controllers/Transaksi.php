<?php
require_once 'Config/DB.php';

class Transaksi
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            t.id, t.tanggal, t.mulai, t.akhir, t.keterangan, t.biaya,
            k.merk AS merk_kendaraan, a.nama AS nama_area, c.nama AS nama_kampus
            FROM transaksi t
            LEFT JOIN kendaraan k ON k.id = t.kendaraan_id
            LEFT JOIN area_parkir a ON a.id = t.area_parkir_id
            LEFT JOIN kampus c ON c.id = a.kampus_id
        ");
        return $stmt->fetchAll();
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            t.id, t.tanggal, t.mulai, t.akhir, t.keterangan, t.biaya, t.kendaraan_id, t.area_parkir_id,
            k.merk AS merk_kendaraan, a.nama AS nama_area, c.nama AS nama_kampus
            FROM transaksi t
            LEFT JOIN kendaraan k ON k.id = t.kendaraan_id
            LEFT JOIN area_parkir a ON a.id = t.area_parkir_id
            LEFT JOIN kampus c ON c.id = a.kampus_id
            WHERE t.id = $id
        ");
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO transaksi (tanggal, mulai, akhir, keterangan, biaya, kendaraan_id, area_parkir_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tanggal'],
            $data['mulai'],
            $data['akhir'],
            $data['keterangan'],
            $data['biaya'],
            $data['kendaraan_id'],
            $data['area_parkir_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE transaksi SET tanggal=:tanggal, mulai=:mulai, akhir=:akhir, keterangan=:keterangan, biaya=:biaya, kendaraan_id=:kendaraan_id, area_parkir_id=:area_parkir_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':mulai', $data['mulai']);
        $stmt->bindParam(':akhir', $data['akhir']);
        $stmt->bindParam(':keterangan', $data['keterangan']);
        $stmt->bindParam(':biaya', $data['biaya']);
        $stmt->bindParam(':kendaraan_id', $data['kendaraan_id']);
        $stmt->bindParam(':area_parkir_id', $data['area_parkir_id']);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM transaksi WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$transaksi1 = new Transaksi($pdo);
