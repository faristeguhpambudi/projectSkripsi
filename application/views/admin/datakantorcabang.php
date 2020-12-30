        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <br><br><br>
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-900">
                <i class="fas fa-table mr-1"></i>
                <strong><?= $judulHalaman; ?></strong>
            </h1>
            <div class="ml-5">
                <div class="flash-data" data-flashdatakc="<?= $this->session->flashdata("flashPesanKC"); ?>">
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <?= form_error('kode_cabang', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                    <div class="col-lg-10">
                        <?= form_error('nama_kantorcabang', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong><i>', '</i></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <a href="" class="btn btn-success mb-3 tombolTambahDataKC" data-toggle="modal" data-target="#formModalKCBaru">
                            <i class="fas fa-plus-circle fa-sm mr-1"></i>
                            <strong>Tambah Data Kantor Cabang</strong>
                        </a>
                        <table class="table table-hover table-bordered text-gray-900" id="tabelUsers">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <center>
                                            #
                                        </center>
                                    </th>
                                    <th scope="col">Kode Cabang</th>
                                    <th scope="col">
                                        <center>Kantor Cabang</center>
                                    </th>
                                    <th scope="col">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kantorCabang as $kc) : ?>
                                    <tr>
                                        <th scope="row">
                                            <center>
                                                <?= $i++; ?>
                                            </center>
                                        </th>
                                        <td><?= $kc["kode_cabang"]; ?></td>
                                        <td>
                                            <center>
                                                <?= $kc["nama_kantorcabang"]; ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url(); ?>admin/ubahKC/<?= $kc["id_kantorcabang"]; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit fa-sm mr-1"></i>
                                                    <strong>Edit</strong>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/hapusKC/<?= $kc["id_kantorcabang"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusKantorCabang">
                                                    <i class="fas fa-trash-alt fa-sm"></i>
                                                    <strong>Hapus</strong>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <br><br><br>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal -->
            <div class="modal fade" id="formModalKCBaru" tabindex="-1" role="dialog" aria-labelledby="formModalKCBaruLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="formModalKCBaruLabel"><strong>Tambah Data Kantor Cabang</strong></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/dataKantorCabang'); ?>" method="post" class="aksiModalKC">
                            <input type="hidden" id="id_kantorcabang" name="id_kantorcabang">
                            <div class="modal-body">
                                <div class="form-group text-gray-900">
                                    <label for="kode_cabang"><strong>Kode Cabang</strong></label>
                                    <input type="text" class="form-control" id="kode_cabang" name="kode_cabang" placeholder="masukkan kode cabang..." autocomplete="off" autofocus>
                                </div>
                                <div class="form-group text-gray-900">
                                    <label for="nama_kantorcabang"><strong>Cabang</strong></label>
                                    <input type="text" class="form-control" id="nama_kantorcabang" name="nama_kantorcabang" placeholder="masukkan nama cabang..." autocomplete="off">
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

            <script type="text/javascript">
                //UNTUK MODAL KANTOR CABANG
                $('.tombolTambahDataKC').on('click', function() {
                    $('#formModalKCBaruLabel').html('<strong>Tambah Data Kantor Cabang</strong>');
                    $('.buttonModal').html('<strong>Tambah Data!</strong>');
                    $('.aksiModalKC').attr('action', base_url + 'admin/dataKantorCabang');
                    $('#kode_cabang').val("");
                    $('#nama_kantorcabang').val("");
                    $('#id_kantorcabang').val("");
                });
                $('.tombolUbahKC').on('click', function() {
                    //UBAH TAMPILAN HTML DI MODAL
                    $('#formModalKCBaruLabel').html('<strong>Ubah Data Kantor Cabang</strong>');
                    $('.buttonModal').html('<strong>Ubah Data!</strong>');
                    $('.aksiModalKC').attr('action', base_url + 'admin/ubahKC');

                    //AMBIL ID YANG MAU DIUPDATE
                    const id_kantorcabang = $(this).data('id');

                    //JALANIN AJAX
                    $.ajax({
                        url: base_url + 'admin/getUbahKC',
                        data: {
                            id_kantorcabang: id_kantorcabang
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            $('#id_kantorcabang').val(data.id_kantorcabang);
                            $('#kode_cabang').val(data.kode_cabang);
                            $('#nama_kantorcabang').val(data.nama_kantorcabang);
                        }
                    });
                });
            </script>