<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Web</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<?php
include_once 'koneksi.php';
?>

<div class="container-fluid">

  <!-- HEADER -->
  <div class="row">
    <div class="col-md-12">
      <?php include_once 'header.php'; ?>
    </div>
  </div>

  <!-- MENU -->
  <div class="row">
    <div class="col-md-12">
      <?php include_once 'menu.php'; ?>
    </div>
  </div>

  <br>

  <!-- CONTENT -->
  <div class="row">
    <div class="col-md-3">
      <?php include_once 'sidebar.php'; ?>
    </div>

    <div class="col-md-9">
      <?php
      if (isset($_GET['hal'])) {
        $req = $_GET['hal'];

        // 🔥 cegah include logout (biar ga error header)
        if ($req == 'logout') {
          header("Location: logout.php");
          exit;
        }

        // cek file ada atau tidak
        if (file_exists($req . '.php')) {
          include_once $req . '.php';
        } else {
          echo "<h5>Halaman tidak ditemukan</h5>";
        } 

      } else {
        include_once 'main.php';
      }
      ?>
    </div>
  </div>

  <br>

  <!-- FOOTER -->
  <div class="row">
    <div class="col-md-12">
      <?php include_once 'footer.php'; ?>
    </div>
  </div>

</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>