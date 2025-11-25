# TP9DPBO2425C2

Saya M. Raffa Mizanul Insan dengan NIM 2409119 mengerjakan TP 9 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan Aamiin.

-----

## Dokumentasi

* Link Repository: https://github.com/piipapoy/TP9DPBO2425C2
* Demo Program (Screen Record): [https://youtu.be/dHfC4t_q5w0]

-----

## Desain dan Alur Program

Tema program ini adalah **Racing Management System** (Sistem Manajemen Data Balapan), yang menerapkan arsitektur **MVP (Model-View-Presenter)**. Program ini dirancang untuk memisahkan logika bisnis (Model), tampilan antarmuka (View), dan penghubung alur data (Presenter) guna mencapai **Separation of Concerns**.

Aplikasi dibangun menggunakan **PHP Native** dan **MySQL** dengan driver **PDO**.

### Struktur Proyek (Arsitektur MVP)

Program ini dibagi menjadi folder-folder yang merepresentasikan komponen MVP:

| Folder/File | Kategori MVP | Fungsi Utama |
| :--- | :--- | :--- |
| **models/** | **Model** | Menangani akses data dan query database (`TabelPembalap.php`, `TabelSirkuit.php`, `DB.php`). Mengimplementasikan `KontrakModel`. |
| **views/** | **View** | Menangani tampilan HTML dan output ke user (`ViewPembalap.php`, `ViewSirkuit.php`). Mengimplementasikan `KontrakView`. |
| **presenters/** | **Presenter** | Menjadi jembatan antara Model dan View. Menerima input, memproses logika, dan memperbarui View (`PresenterPembalap.php`, `PresenterSirkuit.php`). Mengimplementasikan `KontrakPresenter`. |
| **template/** | **Assets** | Berisi file template HTML dasar (`skin.html`, `form.html`) yang akan di-inject data oleh View. |
| **index.php** | **Routing** | Titik masuk (entry point). Mengatur routing berdasarkan entitas (`pembalap` atau `sirkuit`) dan menginisialisasi Presenter yang sesuai. |

### Struktur Entitas Database

Program ini menggunakan 2 tabel utama untuk menyimpan data balapan:

* **`pembalap`**: Menyimpan data driver (ID, Nama, Tim, Negara, Poin Musim, Jumlah Menang).
* **`sirkuit`**: Menyimpan data lintasan balap (ID, Nama Sirkuit, Negara, Panjang Lintasan).

-----

## Implementasi Spesifikasi (MVP & CRUD)

Seluruh fungsionalitas CRUD diimplementasikan dengan mematuhi kontrak antarmuka (Interface) untuk menjaga konsistensi dan modularitas kode.

### 1. Kepatuhan Arsitektur MVP

* **Kontrak/Interface**: Terdapat file `KontrakModel.php`, `KontrakView.php`, dan `KontrakPresenter.php` yang mendefinisikan metode wajib yang harus ada. Hal ini memastikan setiap komponen bekerja sesuai standar yang ditetapkan.
* **Pemisahan Tugas**: 
    * **View** tidak pernah mengakses Database secara langsung. View hanya menerima data matang dari Presenter.
    * **Presenter** mengambil data dari Model, lalu memberikannya ke View untuk ditampilkan.
    * **Model** fokus hanya pada operasi SQL (Query) dan mengembalikan data mentah (Array/Object).

### 2. Implementasi Fitur CRUD

Fitur **Create, Read, Update, dan Delete** tersedia untuk kedua entitas:

#### 1. Pembalap (`Pembalap`)
* **List**: Menampilkan klasemen/daftar pembalap beserta poin dan tim.
* **Add/Edit**: Form untuk menambah atau mengubah data statistik pembalap.
* **Delete**: Menghapus data pembalap dari sistem.

#### 2. Sirkuit (`Sirkuit`) - *Fitur Baru*
* **List**: Menampilkan daftar sirkuit balapan beserta lokasi dan panjang lintasan.
* **Add/Edit**: Form input untuk mendaftarkan sirkuit baru atau memperbarui info sirkuit.
* **Delete**: Menghapus sirkuit dari kalender balapan.
