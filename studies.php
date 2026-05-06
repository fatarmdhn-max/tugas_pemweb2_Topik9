<?php
require_once 'models/Studies.php';

$obj = new Studies();
$data_studies = $obj->index();
?>

<div class="container mt-3">
    <h3>data Studies</h3>

    <!-- tombol tambah -->
    <a href="form_studies.php" class="btn btn-primary mb-3">Tambah</a>

    <table class="table table-striped table-hover" id="studiesTable">
        <thead class="table-dark" style="cursor: pointer;">
            <tr>
                <th onclick="sortTable(0)">No ↕</th>
                <th onclick="sortTable(1)">Nama Sekolah ↕</th>
                <th onclick="sortTable(2)">Level ↕</th>
                <th onclick="sortTable(3)">Tahun Lulus ↕</th>
                <th>Foto</th>
                <th>Action</th>
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
                    <?php if(!empty($row['foto_sekolah'])): 
                        $isUrl = filter_var($row['foto_sekolah'], FILTER_VALIDATE_URL) || strpos($row['foto_sekolah'], 'data:image') === 0;
                        $src = $isUrl ? $row['foto_sekolah'] : "images/" . $row['foto_sekolah'];
                    ?>
                        <img src="<?= $src ?>" width="60" onerror="this.onerror=null; this.src='https://via.placeholder.com/60';">
                    <?php endif; ?>
                </td>

                <td>
                    <!-- 🔍 LIHAT -->
                    <a href="detail_studies.php?id=<?= $row['id'] ?>" 
                       class="btn btn-info btn-sm">
                       👁
                    </a>

                    <a href="index.php?hal=form_studies&id=<?= $row['id'] ?>" 
                        class="btn btn-warning btn-sm">
                        ✏️
                    </a>

                    <!-- ❌ HAPUS -->
                    <a href="controller/proses_studies.php?hapus=<?= $row['id'] ?>" 
                       onclick="return confirm('Yakin hapus?')" 
                       class="btn btn-danger btn-sm">
                       🗑
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>