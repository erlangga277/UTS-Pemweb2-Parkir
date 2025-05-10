<?php
require_once 'config/DB.php';

class AreaParkir
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT area_parkir.*, kampus.nama AS nama_kampus
                                   FROM area_parkir 
                                   JOIN kampus ON kampus.id = area_parkir.kampus_id");
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM area_parkir WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function store($data)
    {
        $sql = "INSERT INTO area_parkir (nama, kapasitas, keterangan, kampus_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nama'],
            $data['kapasitas'],
            $data['keterangan'],
            $data['kampus_id']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE area_parkir SET nama = ?, kapasitas = ?, keterangan = ?, kampus_id = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nama'],
            $data['kapasitas'],
            $data['keterangan'],
            $data['kampus_id'],
            $id
        ]);
    }

    public function delete($id)
    {
        $row = $this->getById($id);
        $stmt = $this->pdo->prepare("DELETE FROM area_parkir WHERE id = ?");
        $stmt->execute([$id]);
        return $row;
    }
}
$areaParkir =  new AreaParkir($pdo);
