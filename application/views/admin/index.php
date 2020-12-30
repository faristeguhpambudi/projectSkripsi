        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-3 text-gray-900">
                <i class="fas fa-tachometer-alt mr-2"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="col-lg-12">
                    <div class="jumbotron bg-primary text-white">
                        <h1 class="h1"><strong>Hai, selamat datang!</strong></h1>
                        <h4><strong>Selamat datang di sistem informasi inventaris perangkat jaringan <br> PT. TASPEN(Persero). Anda adalah admin kantor pusat.</strong></h4>
                        <hr class="my-4 border-white">
                        <p><strong>Dan ini adalah menu anda.</strong></p>
                        <a class="btn btn-primary btn-lg h5 text-white" href="<?= base_url('admin'); ?>" role="button"><i class="fas fa-tachometer-alt mr-2"></i><strong>Dashboard</strong></a>
                        <a class="btn btn-danger btn-lg ml-2 h5" href="<?= base_url('admin/role'); ?>" role="button"><i class="fas fa-user-shield mr-2"></i><strong>Role</strong></a>
                        <a class="btn btn-success btn-lg ml-2 h5" href="<?= base_url('admin/dataKantorCabang'); ?>" role="button"><i class="fas fa-table mr-2"></i><strong>Data Kantor Cabang</strong></a>
                        <a class="btn btn-warning btn-lg ml-2 h5" href="<?= base_url('admin/dataUser'); ?>" role="button"><i class="fas fa-users mr-2"></i><strong>Data User</strong></a>
                        <a class="btn btn-success btn-lg h5" href="<?= base_url('admin/dataPerangkat'); ?>" role="button"><i class="fas fa-table mr-2"></i><strong>Data Perangkat</strong></a>
                        <a class="btn btn-warning btn-lg mt-2 h5" href="<?= base_url('admin/kategoriPerangkat'); ?>" role="button"><i class="fas fa-project-diagram mr-2"></i><strong>Kategori Perangkat</strong></a>
                        <a class="btn btn-primary btn-lg mt-2 h5" href="<?= base_url('admin/historis'); ?>" role="button"><i class="fas fa-table mr-2"></i><strong>Data Historis</strong></a>
                        <a class="btn btn-danger btn-lg mt-2 h5" href="<?= base_url('admin/laporanHistoris'); ?>" role="button"><i class="fas fa-file-alt mr-2"></i><strong>Laporan Historis</strong></a>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->