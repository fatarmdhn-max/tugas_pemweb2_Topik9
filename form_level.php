<?php
require_once 'models/Level.php';

$obj = new Level();

$id = $_GET['id'] ?? null;
$data = $id ? $obj->getLevel($id) : [];

function val($data, $key){
    return $data[$key] ?? '';
}
?>

<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h3>Form Level</h3>

        <form method="POST" action="controller/proses_level.php">

            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="form-floating mb-3">
                <input type="text" name="nama" class="form-control"
                    value="<?= val($data,'nama') ?>" placeholder="Nama Level" required>
                <label>Nama Level</label>
            </div>

            <div class="text-center">
                <?php if(empty($id)){ ?>
                    <button class="btn btn-primary" name="proses" value="simpan">
                        Simpan
                    </button>
                <?php } else { ?>
                    <button class="btn btn-success" name="proses" value="ubah">
                        Ubah
                    </button>
                <?php } ?>

                <a href="index.php?hal=level" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>