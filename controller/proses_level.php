<?php
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../models/Level.php';

$obj = new Level();

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    // 🔥 CEK DULU
    if($obj->cekDipakai($id) > 0){
        header("Location: ../index.php?hal=level&error=relasi");
        exit;
    }

    $obj->hapus($id);
    header("Location: ../index.php?hal=level");
    exit;
}

// SIMPAN / UPDATE
if(isset($_POST['proses'])){
    
    if($_POST['proses'] == 'simpan'){
        $obj->simpan([$_POST['nama']]);
    } else {
        $obj->ubah([$_POST['nama'], $_POST['id']]);
    }

    header("Location: ../index.php?hal=level");
    exit;
}
?>