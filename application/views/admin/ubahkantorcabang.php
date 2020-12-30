        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-edit mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="row">
                    <div class="col-lg text-gray-900">
                        <form action="<?= base_url('admin/ubahKC/') . $kantorCabang["id_kantorcabang"]; ?>" method="post">
                            <div class="form-group row">
                                <input type="hidden" id="id_kantorcabang" name="id_kantorcabang" value="<?= $kantorCabang["id_kantorcabang"]; ?>">
                                <label for="kode_cabang" class="col-sm-2 col-form-label"><strong>Kode Cabang</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kode_cabang" name="kode_cabang" placeholder="Masukkan nama kantor cabang..." value="<?= $kantorCabang["kode_cabang"]; ?>">
                                    <?= form_error('kode_cabang', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_kantorcabang" class="col-sm-2 col-form-label"><strong>Cabang</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_kantorcabang" name="nama_kantorcabang" placeholder="Masukkan nama kantor cabang..." value="<?= $kantorCabang["nama_kantorcabang"]; ?>">
                                    <?= form_error('nama_kantorcabang', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <a href="<?= base_url('admin/dataKantorCabang'); ?>" class="btn btn-danger"><strong>Batal!</strong></a>
                                    <button type="submit" class="btn btn-primary"><strong>Perbaharui Data!</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->