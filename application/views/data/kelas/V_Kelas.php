      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Kelas</h4>
                  <p class="card-description">
                    <div class="row mb-2">
                      <div class="col-lg-9">
                        <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah Kelas
                        </button>
                        <button type="button" class="badge badge-danger text-danger" style="margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdropimpor">
                        Impor Excel
                        </button>
                      </div>
                      <div class="col-lg-3">
                        <input class="form-control" type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari...">
                      </div>
                    </div>
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
                  <div class="table-responsive" style="overflow-y: auto; height: 360px;">
                    <table id="searchTable" class="table table-hover">
                      <thead>
                        <tr class="header">
                          <th class="text-center" style="width: 60px;">No</th>
                          <th>Kelas</th>
                          <th>Kompetensi Keahlian</th>
                          <th style="width: 140px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($kelas as $kelas){
                        ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td><?= $kelas->kelas ?></td>
                          <td><?= $kelas->kompetensi_keahlian ?></td>
                          <td><label class="badge badge-info" style="margin-right: 3px;"><a class="text-info" style="text-decoration: none;" href="<?= base_url('edit_kelas/' . $kelas->id_kelas) ?>">Edit</a></label><label class="badge badge-danger" style="margin-left: 3px;"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('fungsi_hapus_kelas/' . $kelas->id_kelas) ?>">Hapus</a></label></td>
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

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('tambah_kelas') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group text-center">
                        <label for="inputAddress" class="form-label">Kelas</label>
                        <div class="input-group justify-content-center mb-3">
                          <div class="input-group-text" style="margin-right: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="kelas" value="X"> &nbsp; X
                          </div>
                          <div class="input-group-text" style="margin-right: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="kelas" value="XI"> &nbsp; XI
                          </div>
                          <div class="input-group-text" style="margin-right: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="kelas" value="XII"> &nbsp; XII
                          </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="inputAddress2" class="form-label">Kompetensi Keahlian</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="kompetensi_keahlian" placeholder="Kompetensi Keahlian">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
          </div>
        </div>