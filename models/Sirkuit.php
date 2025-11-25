<?php
class Sirkuit{
    private $id;
    private $nama;
    private $negara;
    private $panjang_km;

    public function __construct($id, $nama, $negara, $panjang_km){
        $this->id = $id;
        $this->nama = $nama;
        $this->negara = $negara;
        $this->panjang_km = $panjang_km;
    }

    public function getId(){ return $this->id; }
    public function getNama(){ return $this->nama; }
    public function getNegara(){ return $this->negara; }
    public function getPanjangKm(){ return $this->panjang_km; }

    public function setNama($nama){ $this->nama = $nama; }
    public function setNegara($negara){ $this->negara = $negara; }
    public function setPanjangKm($panjang_km){ $this->panjang_km = $panjang_km; }
}
?>