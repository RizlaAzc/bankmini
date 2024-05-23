      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Transaksi</h4>
                  <p class="card-description">
                    Total saldo keseluruhan berjumlah : <?= $saldo_saat_ini['saldo'] ?>
                    <div class="row mb-2">
                      <div class="col-lg-2">
                        <button type="button" class="badge badge-primary text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Lakukan Transaksi
                        </button>
                      </div>
                      <div class="col-lg-7">
                        <div class="row">
                          <div class="col-lg-3">
                            <label class="form-label" style="float: right; padding: 5px;" for=""><p>Pilih Tanggal :</p></label>
                          </div>
                          <div class="col-lg-9">
                            <input class="form-control mx-auto" style="width: 250px; float: left; cursor: pointer;" type="text" name="daterange" value="" readonly/>
                            <label class="badge badge-dark" style="margin-left: 10px; padding: 9px;"><a class="text-dark" style="text-decoration: none;" href="<?= base_url('transaksi') ?>">Reset</a></label>
                            <label class="badge badge-warning" style="padding: 9px;"><a class="text-warning" style="text-decoration: none;" target="_blank" href="<?= base_url('pdf_transaksi') ?>">PDF</a></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <input class="form-control" type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari...">
                      </div>
                    </div>
                  <!-- <button type="button" class="badge badge-danger text-danger" style="float: right; margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdropimpor">
                  Impor Excel
                  </button> -->
                    <!-- <button type="button" class="badge badge-success text-success dropdown-toggle" style="float: right;" data-bs-toggle="dropdown" data-bs-target="#dropdown" aria-expanded="false">
                    Ekspor Excel
                    </button>
                    <ul class="dropdown-menu" id="dropdown">
                            <li><a class="dropdown-item" href="<?= base_url('portofolio/excel') ?>">Excel</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('portofolio/pdf') ?>">Pdf</a></li>
                        </ul> -->
                    <!-- <a class="badge badge-success text-success" style="float: right;" href="<?= base_url('export_siswa') ?>">Ekspor Excel</a> -->
                    <?= $this->session->flashdata('pesan'); ?>
                  </p>
                  <div class="table-responsive" style="overflow-y: auto; height: 300px;">
                    <table id="searchTable" class="table">
                      <thead>
                        <tr class="header">
                          <!-- <th class="text-center" style="width: 60px;">No</th> -->
                          <th>Tanggal</th>
                          <th>No. Transaksi</th>
                          <th>Nama Siswa</th>
                          <th>Jenis Tabungan</th>
                          <th>Debit</th>
                          <th>Kredit</th>
                          <th>Saldo</th>
                          <!-- <th style="width: 140px;">Aksi</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach($transaksi as $transaksi){
                        ?>
                        <?php
                        $check_debit = $transaksi->debit;
                        $check_kredit = $transaksi->kredit;
                        if($check_debit != 0){
                        ?>
                        <tr class="bg-success text-light">
                        <?php
                        }else if($check_kredit != 0){
                        ?>
                          <tr class="bg-danger text-light">
                        <?php
                        }
                        ?>
                          <td><?= $transaksi->tanggal ?></td>
                          <td><?= $transaksi->id_transaksi ?></td>
                          <td><?= $transaksi->nama_siswa ?></td>
                          <td><?= $transaksi->jenis_tabungan ?></td>
                          <td><?= $transaksi->debit ?></td>
                          <td><?= $transaksi->kredit ?></td>
                          <td><?= $transaksi->saldo ?></td>
                          <!-- <td><label class="badge badge-info" style="margin-right: 3px;"><a class="text-info" style="text-decoration: none;" href="<?= base_url('edit_kelas/' . $transaksi->id_kelas) ?>">Edit</a></label><label class="badge badge-danger" style="margin-left: 3px;"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('fungsi_hapus_kelas/' . $transaksi->id_kelas) ?>">Hapus</a></label></td> -->
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
          <div class="modal-dialog" style="max-width: 700px; transform: translate(0, -50%); top: 50%; margin: 0 auto;">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <script src="<?php echo base_url(); ?>assets/ajax.js"></script>
              <form action="<?= base_url('lakukan_transaksi') ?>" method="post" autocomplete="off">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Nama Siswa</label>
                        <input class="form-control" list="data_siswa" type="text" name="nama_siswa" id="nama_siswa" placeholder="Cari Nama" onchange="return autofill();" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Kelas</label>
                        <input class="form-control" type="text" name="kelas" id="kelas" placeholder="Kelas" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">NIS</label>
                        <input class="form-control" type="text" name="nis" id="nis" placeholder="NIS" readonly>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="form-group">
                      <label for="inputAddress2" class="form-label">Nominal (IDR)</label>
                      <input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal (IDR)" required>
                      <?php
                      if($check_saldo == null){
                      ?>
                      <input class="form-control" type="hidden" name="check_saldo" id="debit" value="0" placeholder="Nominal (IDR)">
                      <?php
                      }else{
                      ?>
                      <input class="form-control" type="hidden" name="check_saldo" id="debit" value="<?= $transaksi->saldo ?>" placeholder="Nominal (IDR)">
                      <?php
                      }
                      ?>
                    </div>
                    <div class="form-group">
                      <label for="inputAddress2" class="form-label">Keterangan</label>
                      <input class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required>
                    </div>
                    <div class="form-group text-center">
                      <label for="inputAddress2" class="form-label">Jenis Tabungan</label>
                      <div class="input-group justify-content-center mb-3">
                        <div class="input-group-text" style="margin-right: 5px;">
                          <input class="form-check-input mt-0" type="radio" name="jenis_tabungan" value="Tabungan Harian"> &nbsp; Tabungan Harian
                        </div>
                        <div class="input-group-text" style="margin-left: 5px;">
                          <input class="form-check-input mt-0" type="radio" name="jenis_tabungan" value="Tabungan Tahunan"> &nbsp; Tabungan Tahunan
                        </div>
                      </div>
                      <input class="form-control" type="hidden" name="id_petugas" id="id_petugas" value="<?= $profil['id_petugas'] ?>" placeholder="Nama Petugas" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="form-group">
                <label for="inputAddress2" class="form-label">Pilih Transaksi :</label>
                <select class="form-control" style="width: 200px; margin-right: 227px;" name="jenis_transaksi" id="jenis_transaksi">
                  <option class="form-control" selected="true" disabled="disabled">Belum dipilih</option>
                  <option class="form-control" value="debit">Debit</option>
                  <option class="form-control" value="kredit">Kredit</option>
                </select>
                </div>
                <div class="form-group" style="margin-top: 30px;">
                <button type="reset" class="btn btn-secondary" style="margin-right: 5px;">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>

        <datalist id="data_siswa">
          <?php
          foreach ($siswa as $b)
          {
              echo "<option class='form-control' value='$b->nama_siswa'>$b->nis</option>";
          }
          ?> 
        </datalist>   
        <script>
          function autofill(){
            var nama_siswa =document.getElementById('nama_siswa').value;
            $.ajax({
              url:"<?php echo base_url();?>C_Transaksi/cari",
              data:'&nama_siswa='+nama_siswa,
              success:function(data){
                var hasil = JSON.parse(data);  
                $.each(hasil, function(key,val){ 
                  document.getElementById('nama_siswa').value=val.nama_siswa;
                  document.getElementById('kelas').value=val.kelas;        
                  document.getElementById('nis').value=val.nis;
                });
              }
            });
          }
        </script>

        <script>
        $(function() {
          $('input[name="daterange"]').daterangepicker({
            opens: 'left'
          }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            GFG_Fun(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
          });
        });
        </script>

            <script>
                function GFG_Fun(start, end) {
                    var url = new URL("http://localhost/bankmini/transaksi");
                    let params = new URLSearchParams(url.search);
                    params.delete('dateStart');
                    url.searchParams.append('dateStart', start);
                    url.searchParams.append('dateEnd', end);
                    history.pushState({}, '', url);
                    location.reload();
                }
            </script>