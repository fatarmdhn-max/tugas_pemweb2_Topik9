<?php
require_once 'models/Level.php';

$obj = new Level();
$data_level = $obj->index();
?>

<div class="container mt-3">
    <h3>Data Level</h3>

    <!-- tombol tambah -->
    <a href="index.php?hal=form_level" class="btn btn-primary">Tambah</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Level</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($data_level as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td>

                   <!-- EDIT -->
                    <a href="index.php?hal=form_level&id=<?= $row['id'] ?>" 
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <!-- HAPUS -->
                    <a href="controller/proses_level.php?hapus=<?= $row['id'] ?>" 
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