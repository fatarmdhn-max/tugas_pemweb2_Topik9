<?php
require_once 'models/Studies.php';
require_once 'models/Level.php';

$obj_level = new Level();
$rs = $obj_level->index();

$id = $_GET['id'] ?? null;
$obj = new Studies();

$row = $id ? $obj->getStudies($id) : [];

function val($row, $key){
    return $row[$key] ?? '';
}
?>

<div class="container mt-3">
    <div class="card p-4 shadow-sm">

        <h3 class="mb-4">Form Studies</h3>

        <form method="POST" action="controller/proses_studies.php" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id ?>">

            <!-- 1. NAMA -->
            <div class="form-floating mb-3">
                <input type="text" name="nama" class="form-control"
                       value="<?= val($row,'nama') ?>"
                       placeholder="Nama Sekolah" required>
                <label>Nama Sekolah</label>
            </div>

            <!-- 2. LEVEL -->
            <div class="form-floating mb-3">
                <select name="idlevel" class="form-select" required>
                    <option value="">-- Pilih Level --</option>
                    <?php foreach($rs as $lvl):
                        $selected = (val($row,'idlevel') == $lvl['id']) ? 'selected' : '';
                    ?>
                        <option value="<?= $lvl['id'] ?>" <?= $selected ?>>
                            <?= $lvl['nama'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Level Pendidikan</label>
            </div>

            <!-- 3. KETERANGAN -->
            <div class="form-floating mb-3">
                <input type="text" name="keterangan" class="form-control"
                       value="<?= val($row,'keterangan') ?>"
                       placeholder="Keterangan">
                <label>Keterangan</label>
            </div>

            <!-- 4. TAHUN -->
            <div class="form-floating mb-3">
                <input type="number" name="tahun_lulus" class="form-control"
                       value="<?= val($row,'tahun_lulus') ?>"
                       placeholder="Tahun Lulus" required>
                <label>Tahun Lulus</label>
            </div>

            <!-- 5. FOTO -->
            <div class="mb-3">
                <label class="form-label fw-bold">Foto Sekolah</label>

                <!-- Pilihan Mode: File atau URL -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mode_foto" id="modeFile" value="file" checked onchange="togglePhotoMode()">
                    <label class="form-check-label" for="modeFile">
                        Upload File Murni (Upload)
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="mode_foto" id="modeUrl" value="url" onchange="togglePhotoMode()">
                    <label class="form-check-label" for="modeUrl">
                        Gunakan URL Gambar (Link Internet)
                    </label>
                </div>

                <!-- Input File -->
                <div id="inputFileContainer" class="form-floating mb-3">
                    <input type="file" name="foto_sekolah_file" id="fotoFile" class="form-control" accept="image/*">
                    <label>Pilih File Foto</label>
                </div>

                <!-- Input URL -->
                <div id="inputUrlContainer" class="form-floating mb-3" style="display: none;">
                    <input type="text" name="foto_sekolah_url" id="fotoUrl" class="form-control"
                           value="<?= val($row,'foto_sekolah') ?>"
                           placeholder="https://example.com/image.jpg">
                    <label>URL Gambar Sekolah</label>
                </div>

                <?php if(!empty(val($row,'foto_sekolah'))): ?>
                    <div class="mt-2">
                        <small class="text-muted">Foto saat ini:</small><br>
                        <?php 
                            $foto_current = val($row,'foto_sekolah');
                            $isUrl = filter_var($foto_current, FILTER_VALIDATE_URL);
                            $src = $isUrl ? $foto_current : "images/" . $foto_current;
                        ?>
                        <img src="<?= $src ?>" width="100" class="img-thumbnail mt-1">
                        <input type="hidden" name="foto_lama" value="<?= $foto_current ?>">
                    </div>
                <?php endif; ?>
            </div>

            <!-- BUTTON -->
            <div class="text-center mt-3">
                <?php if(empty($id)){ ?>
                    <button class="btn btn-primary" name="proses" value="simpan">
                        Simpan
                    </button>
                <?php } else { ?>
                    <button class="btn btn-success" name="proses" value="ubah">
                        Ubah
                    </button>
                <?php } ?>

                <a href="index.php?hal=mystudies" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

<script>
function togglePhotoMode() {
    var modeFile = document.getElementById('modeFile').checked;
    var inputFile = document.getElementById('inputFileContainer');
    var inputUrl = document.getElementById('inputUrlContainer');

    if(modeFile) {
        inputFile.style.display = 'block';
        inputUrl.style.display = 'none';
        document.getElementById('fotoUrl').value = ''; // clear url if switching to file
    } else {
        inputFile.style.display = 'none';
        inputUrl.style.display = 'block';
        document.getElementById('fotoFile').value = ''; // clear file if switching to url
    }
}
</script>