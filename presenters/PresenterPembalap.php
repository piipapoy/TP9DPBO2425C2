<?php
include_once (__DIR__ . "/KontrakPresenter.php");
include_once (__DIR__ . "/../models/TabelPembalap.php");
include_once (__DIR__ . "/../models/Pembalap.php");
include_once (__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter {
    // Model PembalapQuery untuk operasi database
    private $tabelPembalap; // Instance dari TabelPembalap (Model)
    private $viewPembalap; // Instance dari ViewPembalap (View)

    // Data list pembalap
    private $listPembalap = []; // Menyimpan array objek Pembalap

    public function __construct($tabelPembalap, $viewPembalap) {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        $this->initListPembalap();
    }

    // Method untuk inisialisasi list pembalap dari database
    public function initListPembalap() {
        // Dapatkan data pembalap dari database
        $data = $this->tabelPembalap->getAllPembalap();
        
        // Kosongkan list pembalap sebelum mengisi
        $this->listPembalap = [];

        // Buat objek Pembalap dan simpan di listPembalap
        foreach ($data as $item) {
            // Pastikan array key cocok dengan field di DB/Model
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'], // Asumsi DB field bernama 'nama'
                $item['tim'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang']
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    // Method untuk menampilkan daftar pembalap menggunakan View
    public function tampilkanPembalap(): string {
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    // Method untuk menampilkan form
    public function tampilkanFormPembalap($id = null): string
    {
        $data = null;
        if ($id != null) {
            $data = $this->tabelPembalap->getPembalapByID($id);
        }
        return $this->viewPembalap->tampilFormPembalap($data);
    }

    // [C]reate: Implementasi method tambahPembalap
    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        // Panggil method di Model untuk INSERT data
        $this->tabelPembalap->addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
        
        // Refresh list pembalap
        $this->initListPembalap();
    }

    // [U]pdate: Implementasi method ubahPembalap
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        // Panggil method di Model untuk UPDATE data
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        
        // Refresh list pembalap
        $this->initListPembalap();
    }

    // [D]elete: Implementasi method hapusPembalap
    public function hapusPembalap($id): void
    {
        // Panggil method di Model untuk DELETE data
        $this->tabelPembalap->deletePembalap($id);
        
        // Refresh list pembalap
        $this->initListPembalap();
    }
}
?>