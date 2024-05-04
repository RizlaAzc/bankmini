<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Edit SPP</h4>
                  <p class="card-description">
                  </p>
                  <form action="<?= base_url('admin/data/C_SPP/fungsi_edit') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">ID SPP</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="id_spp" value="<?= $spp->id_spp ?>" placeholder="12345" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tahun</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="tahun" value="<?= $spp->tahun ?>" placeholder="1234">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nominal</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nominal" value="<?= $spp->nominal ?>" placeholder="1000000">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?= base_url('spp') ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->