<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Edit Petugas</h4>
                  <p class="card-description">
                  </p>
                  <form action="<?= base_url('fungsi_edit_petugas') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Nama Lengkap</label>
                      <input type="hidden" class="form-control" id="exampleInputUsername1" name="id_petugas" value="<?= $petugas->id_petugas ?>" placeholder="Id Kelas" readonly>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nama_lengkap" value="<?= $petugas->nama_lengkap ?>" placeholder="Nama Lengkap" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="email" value="<?= $petugas->email ?>" placeholder="Email" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Level</label>
                      <div class="input-group mb-3">
                          <div class="input-group-text" style="margin-right: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="level" value="Admin"> &nbsp; Admin
                          </div>
                          <div class="input-group-text" style="margin-left: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="level" value="Petugas"> &nbsp; Petugas
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <div class="input-group mb-3">
                          <div class="input-group-text" style="margin-right: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="status" value="Belum Aktif"> &nbsp; Belum Aktif
                          </div>
                          <div class="input-group-text" style="margin-left: 5px;">
                            <input class="form-check-input mt-0" type="radio" name="status" value="Sudah Aktif"> &nbsp; Sudah Aktif
                          </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?= base_url('petugas') ?>" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->