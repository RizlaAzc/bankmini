<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Edit Kelas</h4>
                  <p class="card-description">
                  </p>
                  <form action="<?= base_url('fungsi_edit_kelas') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Kelas</label>
                      <input type="hidden" class="form-control" id="exampleInputUsername1" name="id_kelas" value="<?= $kelas->id_kelas ?>" placeholder="Id Kelas" readonly>
                      <div class="input-group mb-3">
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
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kompetensi Keahlian</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="kompetensi_keahlian" value="<?= $kelas->kompetensi_keahlian ?>" placeholder="Kompetensi Keahlian">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?= base_url('kelas') ?>" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->