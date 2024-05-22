      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mutasi <?= $siswa->nama_siswa ?></h4>
                  <div class="row">
                    <div class="col-lg-9">
                      <p class="card-description">Saldo saat ini : <?= $saldo_saat_ini['saldo_harian'] ?>
                    </div>
                    <div class="col-lg-3">
                      <input class="form-control" type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari...">
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
                  <div class="table-responsive" style="overflow-y: auto; height: 400px;">
                    <table id="searchTable" class="table">
                      <thead>
                        <tr class="header">
                          <th>Tanggal</th>
                          <th>No. Transaksi</th>
                          <th>Keterangan</th>
                          <th>Debit</th>
                          <th>Kredit</th>
                          <th>Saldo</th>
                          <th>Nama Petugas</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($transaksi as $transaksi){
                          ?>
                        <?php
                        $check_debit = $transaksi->debit;
                        $check_kredit = $transaksi->kredit;
                        if($check_debit != 0){
                        ?>
                        <tr class="bg-success text-light">
                          <?php
                        }else if($check_kredit != 0){
                          ?>
                          <tr class="bg-danger text-light">
                            <?php
                        }
                        ?>
                            <td><?= $transaksi->tanggal ?></td>
                            <td><?= $transaksi->id_transaksi ?></td>
                            <td><?= $transaksi->keterangan ?></td>
                            <td><?= $transaksi->debit ?></td>
                            <td><?= $transaksi->kredit ?></td>
                            <td><?= $transaksi->saldo_harian ?></td>
                            <td><?= $transaksi->nama_lengkap ?></td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                      <!-- <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>No. Transaksi</th>
                          <th>Keterangan</th>
                          <th>Debit</th>
                          <th>Kredit</th>
                          <th>Saldo</th>
                          <th>Saldo Sekarang :</th>
                        </tr>
                      </thead> -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->