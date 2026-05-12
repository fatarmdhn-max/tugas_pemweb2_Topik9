<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">

    <!-- LOGO -->
    <a class="navbar-brand" href="index.php">
      Web Gw
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarScroll">

      <!-- MENU KIRI -->
      <ul class="navbar-nav me-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php?hal=home">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?hal=about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?hal=contact">Contact</a>
        </li>

        <!-- DROPDOWN STUDIES - HANYA TAMPIL JIKA SUDAH LOGIN -->
        <?php if (isset($_SESSION['user'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            My Studies
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?hal=level">Level</a></li>
            <li><a class="dropdown-item" href="index.php?hal=mystudies">Studies</a></li>
          </ul>
        </li>
        <?php endif; ?>

      </ul>

      <!-- MENU KANAN -->
      <ul class="navbar-nav">

        <?php if (!isset($_SESSION['user'])): ?>

          <!-- BELUM LOGIN -->
          <li class="nav-item">
            <a class="nav-link" href="index.php?hal=login">
              <button class="btn btn-outline-light">Login</button>
            </a>
          </li>

        <?php else: ?>

          <!-- SUDAH LOGIN -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-warning" href="#" data-bs-toggle="dropdown">
              <button class="btn btn-outline-light">👤<?= $_SESSION['user']; ?></button>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">

              <li>
                <a class="dropdown-item" href="#">
                  Profile
                </a>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>
                <a class="dropdown-item text-danger" href="logout.php">
                  Logout
                </a>
              </li>

            </ul>
          </li>

        <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>