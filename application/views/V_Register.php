<div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light px-4 px-sm-5 text-center" style="padding-top : 30px; padding-bottom: 1px;">
              <div class="brand-logo mb-3">
                <img src="<?= base_url('assets/images/smk.png') ?>" alt="logo">
              </div>
              <h4>Bank Mini</h4>
              <h6 class="fw-light mb-0">Buat sebuah Akun !</h6>
              <form action="<?= base_url('registrasi') ?>" method="post" class="pt-3">
                <div class="form-group">
                  <input type="text" name="nama_lengkap" class="form-control form-control-lg" id="exampleInputEmail1" onfocus="this.value=''" placeholder="Nama Lengkap" required>
                  <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" onfocus="this.value=''" placeholder="Username" required>
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" onfocus="this.value=''" placeholder="Email" required>
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <input type="password" name="password1" class="form-control form-control-lg" id="password" onfocus="this.value=''" placeholder="Password" required>
                  </div>
                  <div class="col-lg-6">
                    <input type="password" name="password2" class="form-control form-control-lg" id="password" onfocus="this.value=''" placeholder="Konfirmasi Password" required>
                  </div>
                  <div class="text-center">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="text-center">
                    <i class="fa fa-eye-slash mt-2 mb-2" style="margin: auto;" id="togglePassword"></i>
                  </div>
              </form>
              <div>
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mb-4" >Registrasi</button>
              </div>
              <br>
              <h6>Sudah memiliki Akun ?<a href="<?= base_url('') ?>"> Klik di sini</a></h6>
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

  <script>
    const icon = document.getElementById('togglePassword');
    let password = document.getElementById('password');

    /* Event fired when <i> is clicked */
    icon.addEventListener('click', function() {
      if(password.type === "password") {
        password.type = "text";
        icon.classList.add("fa-eye");
        icon.classList.remove("fa-eye-slash");
      }
      else {
        password.type = "password";
          icon.classList.add("fa-eye-slash");
          icon.classList.remove("fa-eye");
      }
    });
  </script>
</body>

</html>
