      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Siswa</h4>
                  <p class="card-description">
                    <div class="row mb-2">
                      <div class="col-lg-9">
                      <div class="row">
                      <div style="flex: 0 0 auto; width: 13.22222%;">
                        <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah Siswa
                        </button>
                      </div>
                      <div style="flex: 0 0 auto; width: 11.88888%;">
                      <button type="button" class="badge badge-danger text-danger" style="margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdropimpor">
                        Impor Excel
                      </button>
                    </div>
                    <!-- <label class="badge badge-success" style="margin-left: 5px;"><a class="text-success" style="text-decoration: none;" href="<?= base_url('export_siswa') ?>">Ekspor Excel</a></label> -->
                    <div style="flex: 0 0 auto; width: 11.88888%;">
                    <div class="dropdown">
                              <label class="badge badge-success dropdown-toggle" style="margin-left: 5px; cursor: pointer;" id="dropdownEksporSiswa" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><a class="text-success" style="text-decoration: none; cursor: pointer;">Ekspor</a></label>
                              <div class="dropdown-menu" aria-labelledby="dropdownEksporSiswa">
                                <a class="dropdown-item" href="<?= base_url('export_siswa') ?>">Excel</a>
                                <a class="dropdown-item" target="_blank" href="<?= base_url('print_siswa') ?>">Print</a>
                              </div>
                            </div>
                    </div>
                    </div>
                      </div>
                      <!-- <div class="col-lg-6 text-center">
                        <label class="badge badge-warning"><a class="text-warning" style="text-decoration: none;" target="_blank" href="<?= base_url('pdf_siswa') ?>">Ekspor PDF</a></label>
                      </div> -->
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
                  <div class="table-responsive" style="overflow-y: auto; max-height: 360px;">
                    <table id="searchTable" class="table table-hover">
                      <thead>
                        <tr class="header">
                          <th class="text-center" style="width: 60px;">No</th>
                          <th>NIS</th>
                          <th>Nama Siswa</th>
                          <th>Jenis Kelamin</th>
                          <th>Kelas</th>
                          <th style="width: 140px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($siswa as $siswa){
                        ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td><?= $siswa->nis ?></td>
                          <td><?= $siswa->nama_siswa ?></td>
                          <td><?= $siswa->jenis_kelamin ?></td>
                          <td><?= $siswa->kelas ?></td>
                          <td><label class="badge badge-info" style="margin-right: 3px;"><a class="text-info" style="text-decoration: none;" href="<?= base_url('edit_siswa/' . $siswa->nis) ?>">Edit</a></label><label class="badge badge-danger" style="margin-left: 3px;"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('fungsi_hapus_siswa/' . $siswa->nis) ?>">Hapus</a></label></td>
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

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" style="transform: translate(0, -53%); top: 50%; margin: 0 auto;">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('tambah_siswa') ?>" method="post">
              <div class="modal-body" style="height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="inputAddress" name="nis" placeholder="NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nama_siswa" placeholder="Nama Siswa">
                    </div>
                    <div class="form-group text-center">
                        <label for="inputAddress2" class="form-label">Jenis Kelamin</label>
                        <div class="input-group justify-content-center mb-3">
                          <div class="input-group-text" style="margin-right: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="jenis_kelamin" value="L"> &nbsp; Laki-Laki
                          </div>
                          <div class="input-group-text" style="margin-left: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="jenis_kelamin" value="P"> &nbsp; Perempuan
                          </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="inputAddress2" class="form-label">Kelas</label>
                        <div class="input-group justify-content-center mb-3">
                          <?php
                          foreach($kelas as $kelas){
                          ?>
                          <div class="input-group-text" style="margin: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="kelas" value="<?= $kelas->kelas ?> <?= $kelas->kompetensi_keahlian ?>"> &nbsp; <?= $kelas->kelas ?> <?= $kelas->kompetensi_keahlian ?>
                          </div>
                          <?php
                          }
                          ?>
                        </div>
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

        <!-- Modal -->
        <div class="modal fade" id="staticBackdropimpor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" style="transform: translate(0, -53%); top: 50%; margin: 0 auto;">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Impor Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('import_siswa') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="height: 400px; overflow-y: auto;">
                  <div class="form-group">
                      <label for="inputAddress" class="form-label">Upload File</label>
                      <input type="file" class="form-control" id="inputAddress" name="file" accept=".xls, .xlsx" required>
                      <div class="mt-1">
                        <label for="inputAddress" class="form-label">File yang di upload harus berformat : .xls dan .xlsx
                          <br>
                          <br>
                          Download template Excel di sini : <a href="<?= base_url('download_template_siswa') ?>">Download Template</a>
                          <br>
                          <br>
                          <b>Catatan Penting !</b>
                          <br>
                          Untuk pengisian :
                          <br>
                          - Kolom <b>Jenis Kelamin</b>, harap diisi dengan huruf L/P saja.
                          <br>
                          - Kolom <b>Kelas</b>, harap diisi dengan Angka Romawi(X) dan singkatan Kejuruannya(PPLG).
                          <br>
                          <br>
                          Seperti gambar berikut.
                          <br>
                          <img style="width: 350px;" src="<?= base_url('assets/images/Contoh Template.png') ?>" alt="Contoh Template.png">
                        </label>
                        </div>
                        <?= form_error('file','<div class="text-danger">','</div>') ?>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                  <button type="submit" name="import" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>