<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('transaksi_debit') ?>">
        <i class="mdi mdi-book-arrow-down menu-icon"></i>
        <span class="menu-title">Transaksi Debit</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('transaksi_kredit') ?>">
        <i class="mdi mdi-book-arrow-up menu-icon"></i>
        <span class="menu-title">Transaksi Kredit</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('riwayat_transaksi') ?>">
        <i class="mdi mdi-book-open menu-icon"></i>
        <span class="menu-title">Riwayat Transaksi</span>
      </a>
    </li>
    <li class="nav-item nav-category">Buku Tabungan</li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('tabungan_harian') ?>">
        <i class="menu-icon mdi mdi-book-lock-open"></i>
        <span class="menu-title">Tabungan Harian</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('tabungan_tahunan') ?>">
        <i class="menu-icon mdi mdi-book-lock"></i>
        <span class="menu-title">Tabungan Tahunan</span>
      </a>
    </li>
    <?php
      if ($this->session->userdata('level') == 'Admin') {
    ?>
    <li class="nav-item nav-category">Data</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="menu-icon mdi mdi-database"></i>
        <span class="menu-title">Data</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('kelas') ?>">Data Kelas</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('siswa') ?>">Data Siswa</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('petugas') ?>">Data Petugas</a></li>
        </ul>
      </div>
    </li>
    <?php
      }
    ?>
  </ul>
</nav>