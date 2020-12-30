        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-project-diagram mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdatakategori="<?= $this->session->flashdata("flashPesanKategori"); ?>">
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <?= form_error('nama_kategori', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <a href="" class="btn btn-success mb-3 tombolTambahDataKategori" data-toggle="modal" data-target="#formModalKategoriBaru">
                            <i class="fas fa-plus-circle fa-sm mr-1"></i>
                            <strong>Tambah Kategori Baru</strong>
                        </a>
                        <table class="table table-bordered table-hover text-gray-900">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kategori as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k["nama_kategori"]; ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url(); ?>admin/ubahKategori/<?= $k["id_kategori"]; ?>" class="btn btn-primary btn-sm tampilModalUbahKategori" data-id="<?= $k['id_kategori']; ?>" data-toggle="modal" data-target="#formModalKategoriBaru">
                                                    <i class="fas fa-edit fa-sm mr-1"></i>
                                                    <strong>Edit</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/hapusKategori/<?= $k["id_kategori"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusKategori">
                                                    <i class="fas fa-trash-alt fa-sm"></i>
                                                    <strong>Hapus</strong>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Modal -->
        <div class="modal fade" id="formModalKategoriBaru" tabindex="-1" role="dialog" aria-labelledby="formModalKategoriBaruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="formModalKategoriBaruLabel"><strong>Tambah Kategori Baru</strong></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/kategoriPerangkat'); ?>" method="post" class="aksiModalKategori">
                        <input type="hidden" id="id_kategori" name="id_kategori">
                        <div class="modal-body">
                            <div class="form-group text-gray-900">
                                <label for="nama_kategori"><strong>Nama Kategori</strong></label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="masukkan nama kategori..." autocomplete="off" autofocus>
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