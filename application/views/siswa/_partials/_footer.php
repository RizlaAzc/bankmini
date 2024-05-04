<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © <?= $year ?>. All rights reserved.</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- Modal -->
<!-- <div class="modal fade" id="pembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('admin/payment/C_Transaksi/fungsi_tambah') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">ID SPP</label>
                        <input type="text" class="form-control" id="inputAddress" name="id_spp" placeholder="ID SPP" >
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="inputAddress" name="nisn" placeholder="NISN" >
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Tahun Dibayar</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="tahun_dibayar" placeholder="Tahun Dibayar">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Nominal</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="jumlah_bayar" placeholder="Nominal">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
          </div>
        </div> -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('C_Login/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

<!-- plugins:js -->
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/progressbar.js/progressbar.min.js') ?>"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?= base_url('assets/js/template.js') ?>"></script>
<script src="<?= base_url('assets/js/settings.js') ?>"></script>
<script src="<?= base_url('assets/js/todolist.js') ?>"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url('assets/js/jquery.cookie.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/js/Chart.roundedBarCharts.js') ?>"></script>
<!-- End custom js for this page-->
</body>

</html>