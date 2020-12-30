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
                        <?= form_open_multipart('adminkantorcabang/ubahDataTindakanKC/' . $tindakanbyid["id_tindakan"]); ?>
                        <div class="form-group row">
                            <input type="hidden" id="id_tindakan" name="id_tindakan" value="<?= $tindakanbyid["id_tindakan"]; ?>">
                            <label for="kode_tindakan" class="col-sm-2 col-form-label"><strong>Kode Tindakan</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kode_tindakan" name="kode_tindakan" placeholder="Masukkan kode tindakan..." value="<?= $tindakanbyid["kode_tindakan"]; ?>" autocomplete="off" autofocus>
                                <?= form_error('kode_tindakan', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_tindakan" class="col-sm-2 col-form-label"><strong>Tanggal Tindakan</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" id="tgl_tindakan" name="tgl_tindakan" placeholder="Masukkan tanggal tindakan..." value="<?= $tindakanbyid["tgl_tindakan"]; ?>" autocomplete="off">
                                <?= form_error('tgl_tindakan', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user" class="col-sm-2 col-form-label"><strong>Teknisi</strong></label>
                            <div class="col-sm-8">
                                <select name="id_user" id="id_user" class="form-control">
                                    <?php foreach ($teknisi as $t) : ?> <option value="<?= $t["id_user"]; ?>" <?php $t["id_user"] == $tindakanbyid["id_user"] && $tindakanbyid["id_user"] != 0  ? print "selected" : ""; ?>>
                                            <?php if ($t["id_user"] == null) : ?>
                                                -- Pilih --
                                            <?php else : ?>
                                                <?= $t["nama_lengkap"]; ?>
                                            <?php endif; ?>
                                            </>
                                        <?php endforeach; ?>
                                </select>
                                <?= form_error('id_user', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_perangkat" class="col-sm-2 col-form-label"><strong>Perangkat</strong></label>
                            <div class="col-sm-8">
                                <select name="id_perangkat" id="id_perangkat" class="form-control">
                                    <?php foreach ($perangkat as $p) : ?> <option value="<?= $p["id_perangkat"]; ?>" <?php $t["id_user"] == $tindakanbyid["id_perangkat"] && $tindakanbyid["id_perangkat"] != 0  ? print "selected" : ""; ?>>
                                            <?php if ($p["id_perangkat"] == null) : ?>
                                                -- Pilih --
                                            <?php else : ?>
                                                <?= $p["nama_kategori"] . ' - ' . $p["serial_number"]; ?>
                                            <?php endif; ?>
                                            </>
                                        <?php endforeach; ?>
                                </select>
                                <?= form_error('id_perangkat', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="desk_masalah" class="col-sm-2 col-form-label"><strong>Desk. Masalah</strong></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="desk_masalah" name="desk_masalah" rows="2" placeholder="Masukkan deskripsi masalah..." autocomplete="off"><?= $tindakanbyid["desk_masalah"]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="desk_tindakan" class="col-sm-2 col-form-label"><strong>Desk. Tindakan</strong></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="desk_tindakan" name="desk_tindakan" rows="2" placeholder="Masukkan deskripsi tindakan..." autocomplete="off"><?= $tindakanbyid["desk_tindakan"]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="bukti_tindakan" class="col-form-label"><strong>Bukti</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/bukti/') . $tindakanbyid["bukti_tindakan"]; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="bukti_tindakan" name="bukti_tindakan">
                                            <label class="custom-file-label" for="foto_profil">Pilih Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a href="<?= base_url('adminkantorcabang/tindakan'); ?>" class="btn btn-danger"><strong>Batal!</strong></a>
                                <button type="submit" class="btn btn-primary"><strong>Perbaharui Data!</strong></button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

                <br><br><br><br><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->