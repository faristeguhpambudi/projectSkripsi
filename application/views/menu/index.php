        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-folder mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdatamenu="<?= $this->session->flashdata("flashPesanMenu"); ?>">
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <?= form_error('nama_menu', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <a href="" class="btn btn-success mb-3 tombolTambahDataMenu" data-toggle="modal" data-target="#formModalMenuBaru">
                            <i class="fas fa-plus-circle fa-sm mr-1"></i>
                            <strong>Tambah Data Menu Baru</strong>
                        </a>
                        <table class="table table-hover text-gray-900">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">
                                        <center>Aksi</center>
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
                                                <a href="<?= base_url(); ?>menu/ubahMenu/<?= $m["id_user_menu"]; ?>" class="btn btn-primary btn-sm tampilModalUbahMenu" data-id="<?= $m['id_user_menu']; ?>" data-toggle="modal" data-target="#formModalMenuBaru">
                                                    <i class="fas fa-edit fa-sm mr-1"></i>
                                                    <strong>Edit</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>menu/hapusMenu/<?= $m["id_user_menu"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusMenu">
                                                    <i class="fas fa-trash-alt fa-sm"></i>
                                                    <strong>Hapus</strong>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br><br><br><br><br>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Modal -->
        <div class="modal fade" id="formModalMenuBaru" tabindex="-1" role="dialog" aria-labelledby="formModalMenuBaruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="formModalMenuBaruLabel"><strong>Tambah Menu Baru</strong></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu'); ?>" method="post" class="aksiModalMenu">
                        <input type="hidden" id="id_user_menu" name="id_user_menu">
                        <div class="modal-body">
                            <div class="form-group text-gray-900">
                                <label for="nama_menu"><strong>Nama Menu</strong></label>
                                <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="masukkan nama menu..." autocomplete="off" autofocus>
                            </div>
                            <input type="hidden" id="controller" name="controller">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary buttonModal"><strong>Tambah Data!</strong></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><strong>Batal</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>