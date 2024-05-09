<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Edit Siswa</h4>
                  <p class="card-description">
                  </p>
                  <form action="<?= base_url('fungsi_edit_siswa') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputEmail1">NIS</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nis" value="<?= $siswa->nis ?>" placeholder="NIS" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Siswa</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nama_siswa" value="<?= $siswa->nama_siswa ?>" placeholder="Nama Siswa">
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
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?= base_url('siswa') ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->