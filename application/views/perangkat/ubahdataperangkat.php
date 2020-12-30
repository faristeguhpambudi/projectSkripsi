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
                        <?= form_open_multipart('admin/ubahPerangkat/' . $perangkatbyid["id_perangkat"]); ?>
                        <div class="form-group row">
                            <input type="hidden" id="id_perangkat" name="id_perangkat" value="<?= $perangkatbyid["id_perangkat"]; ?>">
                            <label for="serial_number" class="col-sm-2 col-form-label"><strong>Serial Number</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Masukkan serial number..." value="<?= $perangkatbyid["serial_number"]; ?>">
                                <?= form_error('serial_number', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kategori" class="col-sm-2 col-form-label"><strong>Kategori Perangkat</strong></label>
                            <div class="col-sm-8">
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    <<?php foreach ($kategori as $k) : ?> <option value="<?= $k["id_kategori"]; ?>" <?php $k["id_kategori"] == $perangkatbyid["id_kategori"] && $perangkatbyid["id_kategori"] != 0  ? print "selected" : ""; ?>>
                                        <?php if ($k["id_kategori"] == null) : ?>
                                            -- Pilih --
                                        <?php else : ?>
                                            <?= $k["nama_kategori"]; ?>
                                        <?php endif; ?>
                                        </>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_kategori', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kantorcabang" class="col-sm-2 col-form-label"><strong>Kantor Cabang</strong></label>
                            <div class="col-sm-8">
                                <select name="id_kantorcabang" id="id_kantorcabang" class="form-control">
                                    <?php foreach ($kantorCabang as $kc) : ?>
                                        <option value="<?= $kc["id_kantorcabang"]; ?>" <?php $kc["id_kantorcabang"] == $perangkatbyid["id_kantorcabang"] && $perangkatbyid["id_kantorcabang"] != 0  ? print "selected" : ""; ?>>
                                            <?php if ($kc["id_kantorcabang"] == null) : ?>
                                                -- Pilih --
                                            <?php else : ?>
                                                <?= $kc["kode_cabang"] . " " . $kc["nama_kantorcabang"]; ?>
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_kantorcabang', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_of_life" class="col-sm-2 col-form-label"><strong>End of Life</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" id="end_of_life" name="end_of_life" placeholder="Masukkan end of life..." value="<?= $perangkatbyid["end_of_life"]; ?>">
                                <?= form_error('end_of_life', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_of_sale" class="col-sm-2 col-form-label"><strong>End of Sale</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" id="end_of_sale" name="end_of_sale" placeholder="Masukkan end of sale..." value="<?= $perangkatbyid["end_of_sale"]; ?>">
                                <?= form_error('end_of_sale', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_date_support" class="col-sm-2 col-form-label"><strong>Last date support</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" id="last_date_support" name="last_date_support" placeholder="Masukkan last date support..." value="<?= $perangkatbyid["last_date_support"]; ?>">
                                <?= form_error('last_date_support', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="foto" class="col-form-label"><strong>Foto</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/perangkat/') . $perangkatbyid['foto']; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto">
                                            <label class="custom-file-label" for="foto_profil">Pilih Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a href="<?= base_url('admin/dataPerangkat'); ?>" class="btn btn-danger"><strong>Batal!</strong></a>
                                <button type="submit" class="btn btn-primary"><strong>Update Data!</strong></button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

                <br><br><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->