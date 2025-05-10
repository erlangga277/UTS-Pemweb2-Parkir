<?php
class JenisKendaraan {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM jenis");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Gagal mengambil data jenis kendaraan: " . $e->getMessage());
        }
    }
}