      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel SPP</h4>
                  <p class="card-description">
                    <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah SPP
                  </button>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th style="width: 60px;">ID</th>
                          <th>ID SPP</th>
                          <th>Tahun</th>
                          <th>Nominal</th>
                          <th style="width: 140px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($spp as $spp){
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $spp->id_spp ?></td>
                          <td><?= $spp->tahun ?></td>
                          <td><?= $spp->nominal ?></td>
                          <td><label class="badge badge-info" style="margin-right: 3px;"><a class="text-info" style="text-decoration: none;" href="<?= base_url('edit_spp/' . $spp->id_spp) ?>">Edit</a></label><label class="badge badge-danger" style="margin-left: 3px;"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('admin/data/C_SPP/fungsi_hapus/' . $spp->id_spp) ?>">Hapus</a></label></td>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah SPP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('admin/data/C_SPP/fungsi_tambah') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">ID SPP</label>
                        <input type="text" class="form-control" id="inputAddress" name="id_spp" placeholder="12345" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="inputAddress" name="tahun" placeholder="1234" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Nominal</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="nominal" placeholder="1000000">
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