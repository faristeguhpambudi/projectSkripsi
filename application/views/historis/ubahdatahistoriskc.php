        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-edit mr-1"></i>
                <strong><?= $judulHalaman; ?> : KC <?= $user["nama_kantorcabang"]; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="row">
                    <div class="col-lg text-gray-900">
                    <form action="<?= base_url('adminkantorcabang/ubahDataHistorisKC/') . $historisid["id_historis"]; ?>" method="post">
                        <input type="hidden" id="id_historis" name="id_historis" value="<?= $historisid["id_historis"]; ?>">
                            <div class="form-group row">
                                <label for="tgl_historis" class="col-sm-2 col-form-label"><strong>Tanggal Historis</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control datepicker" id="tgl_historis" name="tgl_historis" placeholder="Masukkan tanggal historis..." value="<?= $historisid["tgl_historis"]; ?>" autocomplete="off">
                                    <?= form_error('tgl_historis', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_user" class="col-sm-2 col-form-label"><strong>Kode Tindakan</strong></label>
                                <div class="col-sm-8">
                                <select name="id_tindakan" id="id_tindakan" class="form-control">
                                        <?php foreach ($tindakan as $t) : ?> <option value="<?= $t["id_tindakan"]; ?>" <?php $t["id_tindakan"] == $historisid["id_tindakan"] && $historisid["id_tindakan"] != 0  ? print "selected" : ""; ?>>
                                                <?php if ($t["id_tindakan"] == null) : ?>
                                                    -- Pilih --
                                                <?php else : ?>
                                                    <?= $t["kode_tindakan"] . " - " . $t["nama_kategori"] . " - " . $t["serial_number"]; ?>
                                                <?php endif; ?>
                                                </>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status_perangkat" class="col-sm-2 col-form-label"><strong>Status Perangkat</strong></label>
                                <div class="col-sm-8">
                                    <input type="int" class="form-control" id="status_perangkat" name="status_perangkat" placeholder="Masukkan status perangkat..." autocomplete="off" value="<?= $historisid["status_perangkat"]; ?>">
                                    <?= form_error('status_perangkat', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-2 col-form-label"><strong>Deskripsi</strong></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2" placeholder="Masukkan deskripsi..." autocomplete="off"><?= $historisid["deskripsi"]; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="biaya" class="col-sm-2 col-form-label"><strong>Biaya</strong></label>
                                <div class="col-sm-8">
                                    <input type="int" class="form-control" id="biaya" name="biaya" placeholder="Masukkan biaya..." autocomplete="off" value="<?= $historisid["biaya"]; ?>">
                                    <?= form_error('biaya', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <a href="<?= base_url('adminkantorcabang/historis'); ?>" class="btn btn-danger"><strong>Batal!</strong></a>
                                    <button type="submit" class="btn btn-primary"><strong>Perbaharui Data!</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <br><br><br><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->