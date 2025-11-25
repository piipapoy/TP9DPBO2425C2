<?php
include_once ("models/DB.php");
include_once ("KontrakModel.php");
include_once ("Sirkuit.php");

class TabelSirkuit extends DB implements KontrakModel {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }
    
    // --- Dummy Implementasi untuk Kontrak Pembalap ---
    public function getAllPembalap(): array { return []; }
    public function getPembalapByID($id): ?array { return null; }
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void { }
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void { }
    public function deletePembalap($id): void { }

    // --- Sirkuit CRUD ---

    public function getAllSirkuit(): array {
        $query = "SELECT * FROM sirkuit";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getSirkuitByID($id): ?array {
        $this->executeQuery("SELECT * FROM sirkuit WHERE id = :id", ['id' => $id]);
        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    public function addSirkuit($nama, $negara, $panjang_km): void {
        $query = "INSERT INTO sirkuit (nama, negara, panjang_km) 
                  VALUES (:nama, :negara, :panjang_km)";
                  
        $params = [
            'nama' => $nama,
            'negara' => $negara,
            'panjang_km' => $panjang_km
        ];
        
        $this->executeQuery($query, $params);
    }

    public function updateSirkuit($id, $nama, $negara, $panjang_km): void {
        $query = "UPDATE sirkuit SET 
                    nama = :nama, 
                    negara = :negara, 
                    panjang_km = :panjang_km 
                  WHERE id = :id";
                  
        $params = [
            'id' => $id,
            'nama' => $nama,
            'negara' => $negara,
            'panjang_km' => $panjang_km
        ];
        
        $this->executeQuery($query, $params);
    }

    public function deleteSirkuit($id): void {
        $query = "DELETE FROM sirkuit WHERE id = :id";
        $params = ['id' => $id];
        
        $this->executeQuery($query, $params);
    }
}
?>