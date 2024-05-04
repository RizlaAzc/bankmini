<div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-5" style="margin-left: 120px">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 text-center">
              <div class="brand-logo">
                <img src="<?= base_url('assets/images/smk.png') ?>" alt="logo">
              </div>
              <h4>Bank Mini</h4>
              <h6 class="fw-light">Buat sebuah Akun !</h6>
              
              <form action="<?= base_url('registrasi') ?>" method="post" class="pt-3">
                <div class="form-group">
                  <label for="" class="form-label">Sebagai :</label>
                  <div class="input-group justify-content-center mb-3">
                    <div class="input-group-text" style="margin-right: 5px;">
                      <input class="form-check-input mt-0" type="checkbox" name="level" value="Admin"> &nbsp; Admin
                    </div>
                    <div class="input-group-text" style="margin-left: 5px;">
                      <input class="form-check-input mt-0" type="checkbox" name="level" value="Petugas"> &nbsp; Petugas
                    </div>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Registrasi</button>
                </div>
                <br>
                <h6>Sudah memiliki Akun ?<a href="<?= base_url('') ?>"> Klik disini</a></h6>
              </div>
            </div>
            <div class="col-lg-5" style="margin-right: 100px">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5 text-center">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input type="text" name="nama_lengkap" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                    </div>
                <div class="form-group">
                  <input type="password" name="password1" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password2" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Konfirmasi Password" required>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
  <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
  <script src="<?= base_url('assets/js/template.js') ?>"></script>
  <script src="<?= base_url('assets/js/settings.js') ?>"></script>
  <script src="<?= base_url('assets/js/todolist.js') ?>"></script>
  <!-- endinject -->
</body>

</html>
