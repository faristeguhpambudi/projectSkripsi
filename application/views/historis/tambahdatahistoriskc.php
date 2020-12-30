        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-plus-circle mr-1"></i>
                <strong><?= $judulHalaman; ?> : KC <?= $user["nama_kantorcabang"]; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="row">
                    <div class="col-lg text-gray-900">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="tgl_historis" class="col-sm-2 col-form-label"><strong>Tanggal Historis</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control datepicker" id="tgl_historis" name="tgl_historis" placeholder="Masukkan tanggal historis..." autocomplete="off">
                                    <?= form_error('tgl_historis', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_user" class="col-sm-2 col-form-label"><strong>Kode Tindakan</strong></label>
                                <div class="col-sm-8">
                                    <select name="id_tindakan" id="id_tindakan" class="form-control">
                                        <option value="">-- Pilih Kode Tindakan Jika Ada --</option>
                                        <?php foreach ($tindakan as $t) : ?>
                                            <option value="<?= $t["id_tindakan"]; ?>"><?= $t["kode_tindakan"] . " - " . $t["nama_kategori"] . " - " . $t["serial_number"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status_perangkat" class="col-sm-2 col-form-label"><strong>Status Perangkat</strong></label>
                                <div class="col-sm-8">
                                    <select name="status_perangkat" id="status_perangkat" class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        <?php foreach ($status as $s) : ?>
                                            <option value="<?= $s["status_perangkat"]; ?>"><?= $s["keterangan_status"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-2 col-form-label"><strong>Deskripsi</strong></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2" placeholder="Masukkan deskripsi..." autocomplete="off"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="biaya" class="col-sm-2 col-form-label"><strong>Biaya</strong></label>
                                <div class="col-sm-8">
                                    <input type="int" class="form-control" id="biaya" name="biaya" placeholder="Masukkan biaya..." autocomplete="off">
                                    <?= form_error('biaya', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <a href="<?= base_url('adminkantorcabang/tindakan'); ?>" class="btn btn-danger"><strong>Batal!</strong></a>
                                    <button type="submit" class="btn btn-primary"><strong>Tambah Data!</strong></button>
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