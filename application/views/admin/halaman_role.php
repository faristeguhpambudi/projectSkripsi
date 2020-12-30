        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-user-shield mr-1"></i>
                <strong><?= $judulHalaman; ?></strong></h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdatadatarole="<?= $this->session->flashdata("flashPesanDataRole"); ?>">
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <?= form_error('role', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <a href="" class="btn btn-success mb-3 tombolTambahDataRole" data-toggle="modal" data-target="#formModalRoleBaru">
                            <i class="fas fa-plus-circle fa-sm mr-1"></i>
                            <strong>Tambah Role Baru</strong>
                        </a>
                        <table class="table table-hover text-gray-900">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($role as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $r["role"]; ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url(); ?>admin/aksesRole/<?= $r["id_user_role"]; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    <strong>Hak Akses</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/ubahRole/<?= $r["id_user_role"]; ?>" class="btn btn-primary btn-sm tampilModalUbahRole" data-id="<?= $r['id_user_role']; ?>" data-toggle="modal" data-target="#formModalRoleBaru">
                                                    <i class="fas fa-edit fa-sm mr-1"></i>
                                                    <strong>Edit</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/hapusRole/<?= $r["id_user_role"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusDataRole">
                                                    <i class="fas fa-trash-alt fa-sm"></i>
                                                    <strong>Hapus</strong>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Modal -->
        <div class="modal fade" id="formModalRoleBaru" tabindex="-1" role="dialog" aria-labelledby="formModalRoleBaruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="formModalRoleBaruLabel"><strong>Tambah Role Baru</strong></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/role'); ?>" method="post" class="aksiModalRole">
                        <input type="hidden" id="id_user_role" name="id_user_role">
                        <div class="modal-body">
                            <div class="form-group text-gray-900">
                                <label for="role"><strong>Role</strong></label>
                                <input type="text" class="form-control" id="role" name="role" placeholder="masukkan nama role..." autocomplete="off" autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary buttonModal"><strong>Tambah Data!</strong></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><strong>Batal</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>