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
                  <form action="<?= base_url('admin/data/C_Siswa/fungsi_edit') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">NISN</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nisn" value="<?= $siswa->nisn ?>" placeholder="12345" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">NIS</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nis" value="<?= $siswa->nis ?>" placeholder="12345" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="nama" value="<?= $siswa->nama ?>" placeholder="Nama">
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
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="alamat" value="<?= $siswa->alamat ?>" placeholder="Jl. No. RT/RW. Kel. Kec. Kab. Prov">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">No. Telepon</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="no_telp" value="<?= $siswa->no_telp ?>" placeholder="08**********">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID SPP</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="id_spp" value="<?= $siswa->id_spp ?>" placeholder="12345" readonly>
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