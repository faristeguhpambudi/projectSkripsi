<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/'); ?>img/logotaspen.jpg" class="rounded">
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 MB-2"><strong>Reset Password Anda</strong></h1>
                                </div>
                                <div class="text-center">
                                    <?= $this->session->flashdata("pesanAutentikasi"); ?>
                                </div>

                                <hr>
                                <form class="user" action="<?= base_url('Autentikasi/ubahPassword'); ?>" method="post">
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control form-control-user text-gray-900 kolompassword1" id="password1" name="password1" placeholder="Masukkan password baru anda..." autocomplete="off">
                                        <div class="input-group-user input-group-prepend">
                                            <div class="input-group-text form-control form-control-user nyoba" id="icon-klik">
                                                <a href="#" class="text-danger" id="warna1">
                                                    <i class="fas fa-eye-slash" id="mata1"></i>
                                                </a>
                                            </div>
                                            &nbsp;
                                        </div>
                                        <?= form_error('password1', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control form-control-user text-gray-900 kolompassword2" id="password2" name="password2" placeholder="Konfirmasi Password. Ketik ulang password baru anda..." autocomplete="off">
                                        <div class="input-group-user input-group-prepend">
                                            <div class="input-group-text form-control form-control-user nyoba">
                                                <a href="#" class="text-danger" id="warna2">
                                                    <i class="fas fa-eye-slash" id="mata2"></i>
                                                </a>
                                            </div>
                                            &nbsp;
                                        </div>
                                        <?= form_error('password2', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <h6 class="h6 mt-1"><strong>Ubah Password Anda!</strong></h6>
                                    </button>
                                </form>
                                <hr class="mb-2">
                                <div class="float-right small text-gray-900 mb-0">
                                    <strong> <i>Created by faristeguhpambudi@gmail.com &copy; 2020</i></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>