        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-users mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdatausers="<?= $this->session->flashdata("flashPesanDataUser"); ?>">
                </div>

                <div class="row">
                    <div class="col-lg">
                        <a href="tambahDataUser" class="btn btn-success mb-3">
                            <i class="fas fa-plus-circle fa-sm mr-1"></i>
                            <strong>Tambah Data User</strong>
                        </a>
                        <table class="table table-hover table-bordered text-gray-900" id="tabelUsers">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <center>
                                            #
                                        </center>
                                    </th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">
                                        <center>Kantor Cabang</center>
                                    </th>
                                    <th scope="col">
                                        <center>Role</center>
                                    </th>
                                    <th scope="col">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dataUser as $du) : ?>
                                    <tr>
                                        <th scope="row">
                                            <center>
                                                <?= $i++; ?>
                                            </center>
                                        </th>
                                        <td><?= $du["nama_lengkap"]; ?></td>
                                        <td>
                                            <center>
                                                <?= $du["nama_kantorcabang"]; ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <?= $du["role"]; ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url(); ?>admin/detailUser/<?= $du["id_user"]; ?>" class="btn badge-warning btn-sm mr-1 text-dark">
                                                    <i class="fas fa-info-circle fa-sm"></i>
                                                    <strong>Detail</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/ubahDataUser/<?= $du["id_user"]; ?>" class="btn btn-primary btn-sm tombolUbahKC">
                                                    <i class="fas fa-edit fa-sm mr-1"></i>
                                                    <strong>Edit</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/hapusUser/<?= $du["id_user"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusUsers">
                                                    <i class="fas fa-trash-alt fa-sm"></i>
                                                    <strong>Hapus</strong>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <br><br><br>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->