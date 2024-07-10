      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                      <h4 class="card-title">Data Petugas</h4>
                  <p class="card-description">
                    <div class="row">
                    <div class="col-lg-9">
                        <!-- <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> -->
                        <!-- Tambah Kelas
                        </button> -->
                        <label class="badge badge-success" style=""><a class="text-success" style="text-decoration: none;" href="<?= base_url('export_petugas') ?>">Ekspor Excel</a></label>
                        <!-- <button type="button" class="badge badge-danger text-danger" style="margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdropimpor">
                        Impor Excel
                        </button> -->
                      </div>
                      <div class="col-lg-3">
                      <input class="form-control" type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari...">
                      </div>
                    </div>
                    <!-- <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah Petugas
                  </button> -->
                  <?= $this->session->flashdata('pesan'); ?>
                  </p>
                  <div class="table-responsive" style="overflow-y: auto; max-height: 360px;">
                    <table id="searchTable" class="table table-hover">
                      <thead>
                        <tr class="header">
                          <th class="text-center" style="width: 60px;">No</th>
                          <th>Nama Lengkap</th>
                          <th>Email</th>
                          <th>Posisi</th>
                          <th>Status</th>
                          <th>Waktu Dibuat</th>
                          <th class="text-center" style="width: 90px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($petugas as $petugas){
                          ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td><?= $petugas->nama_lengkap ?></td>
                          <td><?= $petugas->email ?></td>
                          <td>
                            <?php
                            $posisi = $petugas->level;
                            if($posisi == "Admin"){
                            ?>
                              <label class="badge badge-success"><a class="text-success" style="text-decoration: none;" href="<?= base_url('level_admin/' . $petugas->id_petugas) ?>"><?= $petugas->level ?></a></label>
                            <?php
                            }else{
                            ?>
                              <label class="badge badge-success"><a class="text-success" style="text-decoration: none;" href="<?= base_url('level_petugas/' . $petugas->id_petugas) ?>"><?= $petugas->level ?></a></label>
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            $check = $petugas->status;
                            if($check == "Sudah Aktif"){
                            ?>
                              <label class="badge badge-success"><a class="text-success" style="text-decoration: none;" href="<?= base_url('active_status/' . $petugas->id_petugas) ?>"><?= $petugas->status ?></a></label>
                            <?php
                            }else{
                            ?>
                              <label class="badge badge-danger"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('deactive_status/' . $petugas->id_petugas) ?>"><?= $petugas->status ?></a></label>
                            <?php
                            }
                            ?>
                          </td>
                          <td><?= $petugas->waktu_dibuat ?></td>
                          <td class="text-center"><label class="badge badge-danger"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('fungsi_hapus_petugas/' . $petugas->id_petugas) ?>">Hapus</a></label></td>
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
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Petugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('admin/data/C_Petugas/fungsi_tambah') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">Username</label>
                        <input type="text" class="form-control" id="inputAddress" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Password</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nama_petugas" placeholder="Nama Petugas">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Level</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="level" placeholder="'Admin', 'Petugas'">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
          </div>
        </div>