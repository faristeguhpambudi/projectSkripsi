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
                                    <h1 class="h4 text-gray-900"><strong>Halaman Login</strong></h1>
                                    <h2 class="h5 text-gray-900 mb-2"><strong>Sistem Informasi Inventaris Perangkat Jaringan</strong></h2>
                                </div>
                                <div class="text-center">
                                    <img src="<?= base_url('assets/'); ?>img/logotaspen.jpg" class="rounded">
                                </div>
                                <div class="text-center">
                                    <?= $this->session->flashdata("pesanAutentikasi"); ?>
                                </div>

                                <hr>
                                <form class="user" action="<?= base_url('Autentikasi'); ?>" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user text-gray-900" id="email" name="email" placeholder="Masukkan email anda..." autocomplete="off" value="<?= set_value("email"); ?>" autofocus>
                                        <?= form_error('email', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control form-control-user text-gray-900 kolompassword" id="password" name="password" placeholder="Masukkan password anda..." autocomplete="off">
                                        <div class="input-group-user input-group-prepend">
                                            <div class="input-group-text form-control form-control-user nyoba" id="icon-klik">
                                                <a href="#" class="text-danger" id="icon-click">
                                                    <i class="fas fa-eye-slash" id="icon"></i>
                                                </a>
                                            </div>
                                            &nbsp;
                                        </div>
                                        <?= form_error('password', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <h6 class="h6 mt-1"><strong>Login!</strong></h6>
                                    </button>
                                </form>
                                <div class="mt-2 ml-3">
                                    <a class="small text-purple" href="<?= base_url('autentikasi/lupaPassword'); ?>"><i class="fas fa-question-circle text-danger mr-1"></i><strong><i>Lupa password anda?</i></strong></a>
                                </div>
                                <!-- <div class="text-center">
                                    <a class="small" href="<?= base_url('autentikasi/buatAkun'); ?>"><strong>Buat akun?</strong></a>
                                </div> -->
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