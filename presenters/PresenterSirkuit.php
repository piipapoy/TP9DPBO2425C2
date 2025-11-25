<?php
include_once (__DIR__ . "/KontrakPresenter.php");
include_once (__DIR__ . "/../models/TabelSirkuit.php");
include_once (__DIR__ . "/../models/Sirkuit.php");
include_once (__DIR__ . "/../views/ViewSirkuit.php");

class PresenterSirkuit implements KontrakPresenter {
    private $tabelSirkuit; 
    private $viewSirkuit; 
    private $listSirkuit = []; 

    public function __construct($tabelSirkuit, $viewSirkuit) {
        $this->tabelSirkuit = $tabelSirkuit;
        $this->viewSirkuit = $viewSirkuit;
    }

    public function initListSirkuit() {
        $data = $this->tabelSirkuit->getAllSirkuit();
        $this->listSirkuit = [];
        foreach ($data as $item) {
            $this->listSirkuit[] = new Sirkuit($item['id'], $item['nama'], $item['negara'], $item['panjang_km']);
        }
    }

    public function tampilkanSirkuit(): string {
        $this->initListSirkuit();
        return $this->viewSirkuit->tampilSirkuit($this->listSirkuit);
    }

    public function tampilkanFormSirkuit($id = null): string {
        $data = null;
        if ($id != null) {
            $data = $this->tabelSirkuit->getSirkuitByID($id);
        }
        return $this->viewSirkuit->tampilFormSirkuit($data);
    }

    public function tambahSirkuit($nama, $negara, $panjang_km): void {
        $this->tabelSirkuit->addSirkuit($nama, $negara, $panjang_km);
    }

    public function ubahSirkuit($id, $nama, $negara, $panjang_km): void {
        $this->tabelSirkuit->updateSirkuit($id, $nama, $negara, $panjang_km);
    }

    public function hapusSirkuit($id): void {
        $this->tabelSirkuit->deleteSirkuit($id);
    }
    
    // Dummy Pembalap
    public function tampilkanPembalap(): string { return ""; }
    public function tampilkanFormPembalap($id = null): string { return ""; }
    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void { }
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void { }
    public function hapusPembalap($id): void { }
}
?>