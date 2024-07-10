<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                  <input class="form-control" type="text" id="searchInput" style="width: 225px; float: right;" onkeyup="searchFunction()" placeholder="Cari...">
                  <h4 class="card-title">Data Tabungan Tahunan</h4>
                  <p class="card-description">
                    <label class="badge badge-success" style="position: absolute;"><a class="text-success" style="text-decoration: none;" href="<?= base_url('export_tabungan_tahunan') ?>">Ekspor Excel</a></label>
                  <?php
                    if($saldo_tahunan_masuk_hari_ini['saldo_tahunan_masuk_hari_ini'] != null){
                  ?>
                  <span class="text-success" style="float: right;">Total saldo tahunan masuk hari ini : Rp<?= $saldo_tahunan_masuk_hari_ini['saldo_tahunan_masuk_hari_ini'] ?></span>
                  <?php
                    }else{
                  ?>
                      <span class="text-success" style="float: right;">Total saldo tahunan masuk hari ini : - </span>
                  <?php
                    }
                  ?>
                  <br>
                  <?php
                    if($saldo_tahunan_keluar_hari_ini['saldo_tahunan_keluar_hari_ini'] != null){
                  ?>
                  <span class="text-danger" style="float: right;">Total saldo tahunan keluar hari ini : Rp<?= $saldo_tahunan_keluar_hari_ini['saldo_tahunan_keluar_hari_ini'] ?></span>
                  <?php
                    }else{
                  ?>
                      <span class="text-danger" style="float: right;">Total saldo tahunan keluar hari ini : - </span>
                  <?php
                    }
                  ?>
                  <br>
                  <?php
                    if($saldo_saat_ini['saldo_tahunan'] != null){
                  ?>
                  <span class="" style="float: right;">Total saldo tabungan tahunan berjumlah : Rp<?= $saldo_saat_ini['saldo_tahunan'] ?></span>
                  <?php
                    }else{
                  ?>
                      <span class="" style="float: right;">Total saldo tabungan tahunan berjumlah : Rp0 </span>
                  <?php
                    }
                  ?>
                  <div class="row">
                    <div class="col-lg-9">
                    </div>
                    <div class="col-lg-3">
                    </div>
                  </div>
                    <!-- <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Lakukan Transaksi
                  </button> -->
                  <!-- <button type="button" class="badge badge-danger text-danger" style="float: right; margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdropimpor">
                  Impor Excel
                  </button> -->
                    <!-- <button type="button" class="badge badge-success text-success dropdown-toggle" style="float: right;" data-bs-toggle="dropdown" data-bs-target="#dropdown" aria-expanded="false">
                    Ekspor Excel
                    </button>
                    <ul class="dropdown-menu" id="dropdown">
                            <li><a class="dropdown-item" href="<?= base_url('portofolio/excel') ?>">Excel</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('portofolio/pdf') ?>">Pdf</a></li>
                        </ul> -->
                    <!-- <a class="badge badge-success text-success" style="float: right;" href="<?= base_url('export_siswa') ?>">Ekspor Excel</a> -->
                    <?= $this->session->flashdata('pesan'); ?>
                  </p>
                  <div class="table-responsive" style="overflow-y: auto; max-height: 360px;">
                    <table id="searchTable" class="table table-hover">
                      <thead>
                        <tr class="header">
                          <th class="text-center" style="width: 60px;">No</th>
                          <th>NIS</th>
                          <th>Nama Siswa</th>
                          <th>Kelas</th>
                          <th style="width: 130px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($transaksi as $transaksi){
                        ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td><?= $transaksi->nis ?></td>
                          <td><?= $transaksi->nama_siswa ?></td>
                          <td><?= $transaksi->kelas ?></td>
                          <td><label class="badge badge-primary" style="margin-right: 3px;"><a class="text-primary" style="text-decoration: none;" href="<?= base_url('mutasi_tahunan/' . $transaksi->nis) ?>">Lihat Mutasi</a></label></td>
                        </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->