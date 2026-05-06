<?php
require_once 'models/Studies.php';

$obj = new Studies();
$data_studies = $obj->index();
?>

<div class="container mt-3">
    <h3>Data Studies</h3><hr>

    <a href="index.php?hal=form_studies" class="btn btn-primary mb-3">Tambah</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA SEKOLAH</th>
                <th>LEVEL</th>
                <th>TAHUN</th>
                <th>FOTO</th>
                <th>ACTION</th>
            </tr>
        </thead>

        <tbody>
            <?php $no=1; foreach($data_studies as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['nama_level'] ?></td>
                <td><?= $row['tahun_lulus'] ?></td>

                <td>
                    <?php 
                        $isUrl = filter_var($row['foto_sekolah'], FILTER_VALIDATE_URL) || strpos($row['foto_sekolah'], 'data:image') === 0;
                        $src = $isUrl ? $row['foto_sekolah'] : "images/" . $row['foto_sekolah'];
                        // Fallback jika tidak ada gambar
                        if(empty($row['foto_sekolah'])) $src = "https://via.placeholder.com/70";
                    ?>
                    <img src="<?= $src ?>" width="70" onerror="this.onerror=null; this.src='https://via.placeholder.com/70';">
                </td>

                <td>
                    <!-- 👁 lihat -->
                    <a href="index.php?hal=detail_studies&id=<?= $row['id'] ?>" 
                       class="btn btn-info btn-sm">
                       <i class="bi bi-eye"></i>
                    </a>

                    <!-- ✏️ edit -->
                    <a href="index.php?hal=form_studies&id=<?= $row['id'] ?>" 
                       class="btn btn-warning btn-sm">
                       <i class="bi bi-pencil"></i>
                    </a>

                    <!-- 🗑 hapus -->
                    <a href="controller/proses_studies.php?hapus=<?= $row['id'] ?>" 
                       onclick="return confirm('Yakin hapus data?')" 
                       class="btn btn-danger btn-sm">
                       <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>