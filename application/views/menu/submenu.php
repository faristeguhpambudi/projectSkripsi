        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-folder-open mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdatasub="<?= $this->session->flashdata("flashPesanSubMenu"); ?>">
                    <?php if ($this->session->flashdata("flashPesanSubMenu")) : ?>
                        <!-- <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Data Karyawan <strong>berhasil</strong> <?= $this->session->flashdata("flashPesanSubMenu"); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div> -->
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <?= form_error('judul', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                    <div class="col-lg-8">
                        <?= form_error('id_user_menu', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                    <div class="col-lg-8">
                        <?= form_error('url', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                    <div class="col-lg-8">
                        <?= form_error('icon', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg">
                        <a href="" class="btn btn-success mb-3 tombolTambahDataSubMenu" data-toggle="modal" data-target="#formModalSubMenuBaru">
                            <i class="fas fa-plus-circle fa-sm mr-1"></i>
                            <strong>Tambah Data Sub Menu Baru</strong>
                        </a>
                        <table class="table table-bordered table-hover text-gray-900">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Submenu</th>
                                    <th scope="col">Ada Dalam Menu</th>
                                    <th scope="col">
                                        <center>URL</center>
                                    </th>
                                    <th scope="col">
                                        <center>Status</center>
                                    </th>
                                    <th scope="col">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($subMenu as $sm) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $sm["judul"]; ?></td>
                                        <td><?= $sm["nama_menu"]; ?></td>
                                        <td><?= $sm["url"]; ?></td>
                                        <td>
                                            <center>
                                                <?= $sm["status"]; ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url(); ?>menu/ubahSubMenu/<?= $sm["id_user_sub_menu"]; ?>" class="btn btn-primary btn-sm tampilModalUbahSubMenu" data-id="<?= $sm['id_user_sub_menu']; ?>" data-toggle="modal" data-target="#formModalSubMenuBaru">
                                                    <i class="fas fa-edit fa-sm mr-1"></i>
                                                    <strong>Edit</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>menu/hapusSubMenu/<?= $sm["id_user_sub_menu"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusSubMenu">
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
        <div class="modal fade" id="formModalSubMenuBaru" tabindex="-1" role="dialog" aria-labelledby="formModalSubMenuBaruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="formModalSubMenuBaruLabel"><strong>Tambah Sub Menu Baru</strong></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/submenu'); ?>" method="post" class="aksiModalSubMenu">
                        <input type="hidden" id="id_user_sub_menu" name="id_user_sub_menu">
                        <div class="modal-body">
                            <div class="form-group text-gray-900">
                                <label for="judul"><strong>Nama Sub Menu</strong></label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="masukkan nama sub menu..." autocomplete="off" autofocus>
                            </div>
                            <div class="form-group text-gray-900">
                                <label for="id_user_menu"><strong>Ada Dalam Menu</strong></label>
                                <select name="id_user_menu" id="id_user_menu" class="form-control">
                                    <option value="">-- Pilih Menu --</option>
                                    <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m["id_user_menu"]; ?>"><?= $m["nama_menu"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group text-gray-900">
                                <label for="url"><strong>URL Sub Menu</strong></label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="masukkan URL sub menu..." autocomplete="off">
                            </div>
                            <div class="form-group text-gray-900">
                                <label for="icon"><strong>Kode Icon Sub Menu</strong></label>
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="masukkan kode icon..." autocomplete="off">
                            </div>
                            <div class="form-group text-gray-900">
                                <label for="is_active"><strong>Status Sub Menu</strong></label>
                                <div class="form-check ml-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                    <label class="form-check-label" for="defaultCheck1">
                                        Aktif
                                    </label>
                                </div>
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