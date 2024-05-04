      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Histori</h4>
                  <p class="card-description">
                    <!-- <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah Histori
                  </button> -->
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th style="width: 60px;">ID</th>
                          <th>ID Petugas</th>
                          <th>NISN</th>
                          <th>Tanggal Bayar</th>
                          <th>Bulan Dibayar</th>
                          <th>Tahun Dibayar</th>
                          <th>Jumlah Bayar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($pembayaran as $pembayaran){
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $pembayaran->id_petugas ?></td>
                          <td><?= $pembayaran->nisn ?></td>
                          <td><?= $pembayaran->tgl_bayar ?></td>
                          <td><?= $pembayaran->bulan_dibayar ?></td>
                          <td><?= $pembayaran->tahun_dibayar ?></td>
                          <td><?= $pembayaran->jumlah_bayar ?></td>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('admin/data/C_Kelas/fungsi_tambah') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="inputAddress" name="nama_kelas" placeholder="Nama Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Kompetensi Keahlian</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="kompetensi_keahlian" placeholder="Kompetensi Keahlian">
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