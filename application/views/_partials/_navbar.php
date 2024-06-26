    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="<?= base_url('') ?>">
            <img src="<?= base_url('assets/images/logo.svg') ?>" style="width: 100%; height: auto;" alt="logo.svg" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Welcome, <span class="text-black fw-bold"><?= $profil['username'] ?></span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <!-- <li class="nav-item d-none d-lg-block">
            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon" style="background-color: #e8ecef;"></span>
              </span>
              <input type="text" class="form-control" disabled>
            </div>
          </li> -->
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <button class="btn btn-danger text-white" style="padding-top: 9px; padding-bottom: 9px;" data-bs-toggle="modal" data-bs-target="#logout">Keluar dari halaman</button>
              
            <!-- <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> -->
              <!-- <img class="img-xs rounded-circle" src="<?= base_url('assets/images/profil.png') ?>" alt="profil.png"> </a> -->
            <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown"> -->
              <!-- <a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>My Profile</a> -->
              <!-- <a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Logout</a> -->
            <!-- </div> -->
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">