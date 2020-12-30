        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <div class="flash-data" data-flashdataubahpass="<?= $this->session->flashdata("flashPesanUbahPassword"); ?>"></div>
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-key mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdataubahpassgagal="<?= $this->session->flashdata("flashPesanUbahPasswordGagal"); ?>"></div>
                <div class="row">
                    <div class="col-lg-8 text-gray-900">
                        <form action="<?= base_url('user/ubahPassword'); ?>" method="post">
                            <div class="form-group row input-group">
                                <label for="password_saatini" class="col-sm-4 col-form-label"><strong>Password Saat Ini</strong></label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-prepend">
                                        <input type="password" class="input-group form-control kolompasswordnow" id="password_saatini" name="password_saatini" placeholder="Masukkan password saat ini...">
                                        <div class="input-group-text" id="icon-klik">
                                            <a href="#" class="text-danger" id="icon-click1">
                                                <i class="fas fa-eye-slash" id="icon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <?= form_error('password_saatini', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row input-group">
                                <label for="password_baru1" class="col-sm-4 col-form-label"><strong>Password Baru</strong></label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-prepend">
                                        <input type="password" class="form-control kolompasswordnew1" id="password_baru1" name="password_baru1" placeholder="Masukkan password baru...">
                                        <div class="input-group-text" id="icon-klik">
                                            <a href="#" class="text-danger" id="icon-click2">
                                                <i class="fas fa-eye-slash" id="icon2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <?= form_error('password_baru1', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row input-group">
                                <label for="password_baru2" class="col-sm-4 col-form-label"><strong>Konfirmasi Password Baru</strong></label>
                                <div class="col-sm-8">
                                    <div class="input-group-user input-group-prepend">
                                        <input type="password" class="form-control kolompasswordnew2" id="password_baru2" name="password_baru2" placeholder="Ketik ulang password baru...">
                                        <div class="input-group-text" id="icon-klik3">
                                            <a href="#" class="text-danger" id="icon-click3">
                                                <i class="fas fa-eye-slash" id="icon3"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <?= form_error('password_baru2', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary"><strong>Perbaharui Password!</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <br><br><br><br><br><br><br><br><br><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->