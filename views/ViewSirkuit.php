<?php

include_once ("KontrakView.php");
include_once ("models/Sirkuit.php");

class ViewSirkuit implements KontrakView{

    public function __construct(){
    }
    
    public function tampilSirkuit($listSirkuit): string {
        // 1. Buat Baris Tabel dengan class yang sesuai
        $tbody = '';
        $no = 1;
        foreach($listSirkuit as $sirkuit){
            $tbody .= "<tr>
                <td class='col-id'>{$no}</td>
                <td>".htmlspecialchars($sirkuit->getNama())."</td>
                <td>".htmlspecialchars($sirkuit->getNegara())."</td>
                <td>".htmlspecialchars($sirkuit->getPanjangKm())." km</td>
                <td class='col-actions'>
                    <a href='index.php?entity=sirkuit&screen=edit&id=".$sirkuit->getId()."' class='btn btn-edit'>Edit</a>
                    <button onclick=\"hapus('".$sirkuit->getId()."')\" class='btn btn-delete'>Hapus</button>
                </td>
            </tr>";
            $no++;
        }
        
        $total = count($listSirkuit);

        // 2. RETURN HTML LENGKAP DENGAN STYLE ASLI
        return "
        <!doctype html>
        <html lang='id'>
        <head>
          <meta charset='utf-8' />
          <meta name='viewport' content='width=device-width,initial-scale=1' />
          <title>Sirkuit — Daftar</title>
          <style>
            /* CSS ASLI DARI TEMPLATE */
            :root{
              --bg: #f7f8fb; --card: #ffffff; --muted: #6b7280; --accent: #2563eb; --danger: #ef4444;
              --border: #e6e9ef; --radius: 8px; --pad: 14px;
              font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
              color-scheme: light;
            }
            html,body{height:100%;margin:0;background:var(--bg);}
            .container{max-width:980px;margin:36px auto;padding:18px;}
            .card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:12px;box-shadow: 0 1px 2px rgba(16,24,40,0.03);}
            h1{margin:0 0 12px 0;font-size:18px}
            table{width:100%;border-collapse:collapse;font-size:14px}
            thead th{ text-align:left;padding:12px 10px;background:transparent;color:var(--muted);font-weight:600;border-bottom:1px solid var(--border)}
            tbody td{padding:12px 10px;border-bottom:1px solid var(--bg);vertical-align:middle}
            tbody tr:last-child td{border-bottom:0}
            .col-id{width:48px;color:var(--muted);}
            .col-actions{width:170px;text-align:right}
            .btn{display:inline-block;padding:8px 10px;border-radius:6px;border:1px solid transparent;font-size:13px;cursor:pointer;text-decoration:none;}
            .btn-edit{background:transparent;color:var(--accent);border-color:transparent}
            .btn-delete{background:transparent;color:var(--danger);border-color:transparent;margin-left:8px}
            .btn-add{background:var(--accent);color:#fff;border:none;padding:10px 14px;border-radius:8px;display:inline-flex;align-items:center;gap:8px}
            .btn-primary{background:var(--accent);color:#fff}
            .btn-muted{background:transparent;border:1px solid var(--border);color:var(--muted)}
            @media (max-width:640px){ thead th:nth-child(4), tbody td:nth-child(4) {display:none} .col-actions{width:130px} .container{padding:10px;margin:18px} }
            tbody tr:hover td{background:linear-gradient(90deg, rgba(37,99,235,0.02), transparent)}
          </style>
        </head>
        <body>
          <div class='container'>
            <div style='margin-bottom: 12px; text-align: right;'>
                <a href='index.php' class='btn btn-muted'>Kelola Pembalap</a>
                <a href='index.php?entity=sirkuit' class='btn btn-primary'>Kelola Sirkuit</a>
            </div>

            <div class='card'>
              <h1>Daftar Sirkuit</h1>
              <div style='overflow:auto;'>
                <table role='table'>
                  <thead>
                    <tr>
                      <th class='col-id'>No</th>
                      <th>Nama</th>
                      <th>Negara</th>
                      <th>Panjang (km)</th>
                      <th class='col-actions'>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    $tbody
                  </tbody>
                </table>
              </div>
              <div style='margin-top:14px;display:flex;justify-content:space-between;align-items:center'>
                <div style='color:var(--muted);font-size:13px'>Total: $total</div>
                <div>
                  <a href='index.php?entity=sirkuit&screen=add' class='btn btn-add'>+ Tambah Sirkuit</a>
                </div>
              </div>
            </div>
          </div>

          <script>
            function hapus(id){
                if(confirm('Yakin ingin menghapus entri #' + id + '?')){
                    var form = document.createElement('form'); form.method = 'POST'; form.action = 'index.php';
                    form.innerHTML = '<input type=hidden name=entity value=sirkuit><input type=hidden name=action value=delete><input type=hidden name=id value='+id+'>';
                    document.body.appendChild(form); form.submit();
                }
            }
          </script>
        </body>
        </html>";
    }

    public function tampilFormSirkuit($data = null): string {
        $templatePath = __DIR__ . '/../template/form_sirkuit.html';
        if (!file_exists($templatePath)) return "Template form tidak ditemukan. Pastikan file 'template/form_sirkuit.html' ada.";
        
        $template = file_get_contents($templatePath);
        if ($data) {
            $template = str_replace('value="add" id="sirkuit-action"', 'value="edit" id="sirkuit-action"', $template);
            $template = str_replace('value="" id="sirkuit-id"', 'value="' . htmlspecialchars($data['id']) . '" id="sirkuit-id"', $template);
            $template = str_replace('id="nama" name="nama" type="text" placeholder="Nama Sirkuit"', 'id="nama" name="nama" type="text" placeholder="Nama Sirkuit" value="' . htmlspecialchars($data['nama']) . '"', $template);
            $template = str_replace('id="negara" name="negara" type="text" placeholder="Negara (mis. United Kingdom)"', 'id="negara" name="negara" type="text" placeholder="Negara (mis. United Kingdom)" value="' . htmlspecialchars($data['negara']) . '"', $template);
            $template = str_replace('id="panjang_km" name="panjang_km" type="number" min="0" step="0.01" placeholder="0.00"', 'id="panjang_km" name="panjang_km" type="number" min="0" step="0.01" placeholder="0.00" value="' . htmlspecialchars($data['panjang_km']) . '"', $template);
        }
        return $template;
    }
    
    public function tampilPembalap($listPembalap): string { return ""; }
    public function tampilFormPembalap($data = null): string { return ""; }
}
?>