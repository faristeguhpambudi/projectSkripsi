<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar fixed-top navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <div class="ml-5"></div>
            <div class="ml-5"></div>
            <div class="ml-4"></div>

            <span class="navbar-brand ml-5" href="#">
                <img src="<?= base_url('assets/'); ?>img/logotaspen.png" height="40" class="d-inline-block align-top ml-5" alt="">
            </span>
            <span class="navbar-brand text-gray-900" href="#">
                <strong>Sistem Informasi Inventaris Perangkat Jaringan</strong>
            </span>




            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block text-gray-900"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profil/') . $user["foto_profil"]; ?>">
                        <span class="ml-2 d-none d-lg-inline text-gray-900 small"><strong><?= $user["nama_lengkap"]; ?></strong></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-900"></i>
                            <strong>Profil Saya</strong>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('user/ubahPassword'); ?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-900"></i>
                            <strong>Ubah Password</strong>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item tombolLogoutIni" href="<?= base_url('autentikasi/LogOut'); ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-900"></i>
                            <strong>Logout</strong>
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->