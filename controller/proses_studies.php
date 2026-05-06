<?php
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../models/Studies.php';

$obj = new Studies();

// HAPUS
if(isset($_GET['hapus'])){
    $obj->hapus($_GET['hapus']);
    header("Location: ../index.php?hal=mystudies");
    exit;
}

// SIMPAN & UPDATE
if(isset($_POST['proses'])){

    $foto = $_POST['foto_lama'] ?? ''; // Default ambil foto lama jika ada
    $mode_foto = $_POST['mode_foto'] ?? 'file';

    if ($mode_foto == 'url') {
        // Jika user memilih mode URL
        if (!empty($_POST['foto_sekolah_url'])) {
            $foto = $_POST['foto_sekolah_url'];
        }
    } else {
        // Jika user memilih upload File
        if (isset($_FILES['foto_sekolah_file']) && $_FILES['foto_sekolah_file']['error'] == 0) {
            $tmp_name = $_FILES['foto_sekolah_file']['tmp_name'];
            $file_name = time() . '_' . $_FILES['foto_sekolah_file']['name'];
            $upload_path = __DIR__ . '/../images/' . $file_name;
            
            // Cek apabila belum ada folder images dibuat secara otomatis (opsional)
            if (!is_dir(__DIR__ . '/../images/')) {
                mkdir(__DIR__ . '/../images/', 0777, true);
            }

            if (move_uploaded_file($tmp_name, $upload_path)) {
                $foto = $file_name;
            }
        }
    }

    $data = [
        $_POST['nama'],
        $_POST['idlevel'],
        $_POST['keterangan'],
        $_POST['tahun_lulus'],
        $foto
    ];

    if($_POST['proses'] == 'simpan'){
        $obj->simpan($data);
    } else {
        $data[] = $_POST['id'];
        $obj->ubah($data);
    }

    header("Location: ../index.php?hal=mystudies");
    exit;
}
?>