        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->

            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-user-tie mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdataprofil="<?= $this->session->flashdata("flashPesanProfil"); ?>">
                </div>
            </div>
            <div class="row ml-5">
                <div class="col-sm-4">
                    <div class="card mb-3">
                        <img class="card-img-top" src="<?= base_url('assets/img/profil/') . $user["foto_profil"]; ?>" alt="Card image cap">
                        <div class="card-body">
                            <a href="<?= base_url('user/editprofil'); ?>" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-edit fa-sm"></i>
                                <strong> Edit Profil</strong></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <table class="table table-borderless text-gray-900">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>: <?= $user["nama_lengkap"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin </strong></td>
                                <td>: <?= $user["gender"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email </strong></td>
                                <td>: <?= $user["email"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Kantor Cabang</strong></td>
                                <td>: <?= $user["nama_kantorcabang"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Role</strong></td>
                                <td>: <?= $user["role"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td>: <?= $user["telepon"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: <?= $user["alamat"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Terdaftar sejak </strong></td>
                                <td>: <?= date('d F Y', $user["date_created"]); ?> </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
            <br><br>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->