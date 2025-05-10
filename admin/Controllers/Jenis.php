<?php
require_once 'Config/DB.php';

class Jenis
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua data
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM jenis ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    // Menampilkan satu data berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM jenis WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Menambahkan data baru
    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO jenis (nama) VALUES (?)");
        $stmt->execute([$data['nama']]);
        return $this->pdo->lastInsertId();
    }

    // Mengubah data berdasarkan ID
    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE jenis SET nama = :nama WHERE id = :id");
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->show($id);
    }

    // Menghapus data berdasarkan ID
    public function delete($id)
    {
        $row = $this->show($id);
        $stmt = $this->pdo->prepare("DELETE FROM jenis WHERE id = ?");
        $stmt->execute([$id]);
        return $row;
    }
}

$jenis = new Jenis($pdo);
