<?php
require_once 'models/Studies.php';
$id = $_GET['id'] ?? null;
$obj = new Studies();
$row = $obj->getStudies($id);

if (!$row) {
    echo "<div class='alert alert-danger mt-3'>Data tidak ditemukan!</div>";
    exit;
}
?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Detail Studies</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">NAMA SEKOLAH</th>
                    <td><?= $row['nama'] ?></td>
                </tr>
                <tr>
                    <th>LEVEL</th>
                    <td><?= $row['nama_level'] ?></td>
                </tr>
                <tr>
                    <th>TAHUN LULUS</th>
                    <td><?= $row['tahun_lulus'] ?></td>
                </tr>
                <tr>
                    <th>KETERANGAN</th>
                    <td><?= $row['keterangan'] ?></td>
                </tr>
                <tr>
                    <th>FOTO SEKOLAH</th>
                    <td>
                        <?php 
                            $isUrl = filter_var($row['foto_sekolah'], FILTER_VALIDATE_URL) || strpos($row['foto_sekolah'], 'data:image') === 0;
                            $src = $isUrl ? $row['foto_sekolah'] : "images/" . $row['foto_sekolah'];
                            if(empty($row['foto_sekolah'])) $src = "https://via.placeholder.com/150";
                        ?>
                        <img src="<?= $src ?>" width="150" class="img-thumbnail" onerror="this.onerror=null; this.src='https://via.placeholder.com/150';">
                    </td>
                </tr>
            </table>
            <a href="index.php?hal=mystudies" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
