        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900"><strong><?= $judulHalaman; ?></strong></h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdataaksesrole="<?= $this->session->flashdata("flashPesanAksesRole"); ?>">
                </div>
                <div class="row text-gray-900">
                    <div class="col-lg-8">
                        <h5><i class="fas fa-user-shield mr-1"></i><strong>Role : </strong><?= $role["role"]; ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-hover text-gray-900">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">
                                        <center>Akses</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $m["nama_menu"]; ?></td>
                                        <td>
                                            <center>
                                                <div class="form-check">
                                                    <input class="form-check-input ceklisHakAkses" type="checkbox" <?= cek_hak_akses($role["id_user_role"], $m["id_user_menu"]); ?> data-role="<?= $role["id_user_role"]; ?>" data-menu="<?= $m["id_user_menu"]; ?>">
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="<?= base_url(); ?>admin/role" class="btn btn-success btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>
                            <strong>Kembali</strong>
                        </a>
                        <br><br><br><br><br>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->