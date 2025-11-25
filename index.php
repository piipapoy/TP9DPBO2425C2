<?php

// Konfigurasi Database
$host = 'localhost';
$dbname = 'mvp_db';
$user = 'root';
$pass = '';

// Include files
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelSirkuit.php"); // BARU
include_once("views/ViewPembalap.php");
include_once("views/ViewSirkuit.php"); // BARU
include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterSirkuit.php"); // BARU

// Inisialisasi Objek Model dan View
$tabelPembalap = new TabelPembalap($host, $dbname, $user, $pass);
$tabelSirkuit = new TabelSirkuit($host, $dbname, $user, $pass); // BARU
$viewPembalap = new ViewPembalap();
$viewSirkuit = new ViewSirkuit(); // BARU

// Tentukan entitas yang sedang diakses (default: pembalap)
$entity = $_REQUEST['entity'] ?? 'pembalap';

// Inisialisasi Presenter berdasarkan entitas
$presenter = null;
if ($entity === 'sirkuit') {
    // Gunakan Presenter dan View untuk Sirkuit
    $presenter = new PresenterSirkuit($tabelSirkuit, $viewSirkuit);
    $redirect_url = "index.php?entity=sirkuit";
} else {
    // Default: Gunakan Presenter dan View untuk Pembalap
    $presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);
    $redirect_url = "index.php";
}

// --- LOGIKA CONTROLLER (PENANGANAN POST) ---
if (isset($_POST['action'])) {
    
    $action = $_POST['action'];

    if ($entity === 'pembalap') {
        if ($action === 'add') {
            $presenter->tambahPembalap(
                $_POST['nama'],
                $_POST['tim'],
                $_POST['negara'],
                $_POST['poinMusim'],
                $_POST['jumlahMenang']
            );
        } elseif ($action === 'edit') {
            $presenter->ubahPembalap(
                $_POST['id'],
                $_POST['nama'],
                $_POST['tim'],
                $_POST['negara'],
                $_POST['poinMusim'],
                $_POST['jumlahMenang']
            );
        } elseif ($action === 'delete') {
            $presenter->hapusPembalap($_POST['id']);
        }
    } elseif ($entity === 'sirkuit') {
        // Logika CRUD Sirkuit
        $nama = $_POST['nama'] ?? '';
        $negara = $_POST['negara'] ?? '';
        $panjang_km = $_POST['panjang_km'] ?? 0.00;
        $id = $_POST['id'] ?? null;

        if ($action === 'add') {
            $presenter->tambahSirkuit($nama, $negara, $panjang_km);
        } elseif ($action === 'edit') {
            $presenter->ubahSirkuit($id, $nama, $negara, $panjang_km);
        } elseif ($action === 'delete') {
            $presenter->hapusSirkuit($_POST['id']);
        }
    }

    // Redirect kembali ke halaman utama entitas terkait setelah aksi (CRUD) selesai
    header("Location: " . $redirect_url);
    exit();

} 
// --- LOGIKA TAMPILAN (PENANGANAN GET) ---
else if (isset($_GET['screen'])) {
    
    $screen = $_GET['screen'];
    $formHtml = '';

    if ($entity === 'pembalap') {
        if ($screen == 'add') {
            $formHtml = $presenter->tampilkanFormPembalap();
        }
        else if ($screen == 'edit' && isset($_GET['id'])) {
            $formHtml = $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } elseif ($entity === 'sirkuit') {
        if ($screen == 'add') {
            $formHtml = $presenter->tampilkanFormSirkuit();
        }
        else if ($screen == 'edit' && isset($_GET['id'])) {
            $formHtml = $presenter->tampilkanFormSirkuit($_GET['id']);
        }
    }

    echo $formHtml;
} 
// --- TAMPILAN DEFAULT (LIST) ---
else {
    // Tampilkan daftar entitas
    if ($entity === 'sirkuit') {
        $html = $presenter->tampilkanSirkuit();
    } else {
        $html = $presenter->tampilkanPembalap();
    }
    echo $html;
}

// Tutup koneksi database saat program selesai
$tabelPembalap->close();
$tabelSirkuit->close(); // BARU
?>