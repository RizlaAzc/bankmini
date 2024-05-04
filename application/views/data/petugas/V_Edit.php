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
                  <form action="<?= base_url('admin/data/C_Petugas/fungsi_edit') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="hidden" class="form-control" id="exampleInputUsername1" name="id_petugas" value="<?= $petugas->id_petugas ?>" placeholder="Id Kelas" readonly>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="username" value="<?= $petugas->username ?>" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="password" value="<?= $petugas->password ?>" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Petugas</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nama_petugas" value="<?= $petugas->nama_petugas ?>" placeholder="Nama Petugas">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Level</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="level" value="<?= $petugas->level ?>" placeholder="'Admin', 'Petugas'">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?= base_url('petugas') ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->