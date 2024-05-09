      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Siswa</h4>
                  <p class="card-description">
                    <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah Siswa
                  </button>
                  <button type="button" class="badge badge-danger text-danger" style="float: right; margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdropimpor">
                  Impor Data
                  </button>
                    <button type="button" class="badge badge-success text-success" style="float: right;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Ekspor Data
                    </button>
                    <?= $this->session->flashdata('pesan'); ?>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 60px;">No</th>
                          <th>NIS</th>
                          <th>Nama Siswa</th>
                          <th>Kelas</th>
                          <th>Jenis Kelamin</th>
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
                          <td><?= $siswa->kelas ?></td>
                          <td><?= $siswa->jenis_kelamin ?></td>
                          <td><label class="badge badge-info" style="margin-right: 3px;"><a class="text-info" style="text-decoration: none;" href="<?= base_url('edit_siswa/' . $siswa->nis) ?>">Edit</a></label><label class="badge badge-danger" style="margin-left: 3px;"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('admin/data/C_Siswa/fungsi_hapus/' . $siswa->nis) ?>">Hapus</a></label></td>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('admin/data/C_Siswa/fungsi_tambah') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="inputAddress" name="nisn" placeholder="12345" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nis" placeholder="12345">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Kompetensi Keahlian</label>
                        <select class="form-control" name="id_kelas" id="cars">
                          <option value="">Pilih Salah Satu</option>
                          <?php
                          foreach($kelas as $kelas){
                          ?>
                          <option value="<?= $kelas->id_kelas ?>"><?= $kelas->kompetensi_keahlian ?></option>
                          <?php
                          }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="alamat" placeholder="Jl. No. RT/RW. Kel. Kec. Kab. Prov">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="no_telp" placeholder="08*********">
                    </div>
                    <!-- <div class="form-group">
                        <label for="inputAddress2" class="form-label">ID SPP</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="id_spp" placeholder="ID SPP">
                    </div> -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdropimpor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Impor Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('import_siswa') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                      <label for="inputAddress" class="form-label">Upload File</label>
                      <input type="file" class="form-control" id="inputAddress" name="file" accept=".xls, .xlsx" required>
                      <div class="mt-1">
                        <label for="inputAddress" class="form-label">File yang di upload harus berformat : .xls dan .xlsx</label>
                                                <!-- <span class="text-secondary">File yang harus diupload : .xls, xlsx</span> -->
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