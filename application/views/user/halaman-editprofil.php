        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-user-edit mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="row">
                    <div class="col-lg-8 text-gray-900">
                        <?= form_open_multipart('user/editProfil'); ?>
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-4 col-form-label"><strong>Nama</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user["nama_lengkap"]; ?>" placeholder="Masukkan nama lengkap...">
                                <?= form_error('nama_lengkap', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_gender" class="col-sm-4 col-form-label"><strong>Jenis Kelamin</strong></label>
                            <div class="col-sm-8">
                                <select name="id_gender" id="id_gender" class="form-control">
                                    <?php foreach ($gender as $g) : ?>
                                        <option value="<?= $g["id_gender"]; ?>" <?php $g["id_gender"] == $user["id_gender"] && $user["id_gender"] != 0  ? print "selected" : ""; ?>>
                                            <?php if ($g["id_gender"] == null) : ?>
                                                -- Pilih --
                                            <?php else : ?>
                                                <?= $g["gender"]; ?>
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_gender', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label"><strong>Email</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email anda..." value="<?= $user["email"]; ?>">
                                <?= form_error('email', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-4 col-form-label"><strong>Telepon</strong></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan no. telepon anda..." value="<?= $user["telepon"]; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-4 col-form-label"><strong>Alamat</strong></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan alamat lengkap anda..."><?= $user["alamat"]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="foto_profil" class="col-form-label"><strong>Foto Profil</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/profil/') . $user['foto_profil']; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_profil" name="foto_profil">
                                            <label class="custom-file-label" for="foto_profil">Pilih Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-8">
                                <a href="<?= base_url('user'); ?>" class="btn btn-danger"><strong>Batal!</strong></a>
                                <button type="submit" class="btn btn-primary"><strong>Simpan Perubahan!</strong></button>
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