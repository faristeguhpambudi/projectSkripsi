<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
    <br><br><br>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900">
        <i class="fas fa-table mr-1"></i>
        <strong><?= $judulHalaman; ?> : Switch</strong>
    </h1>
    <div class="ml-5">
        <div class="flash-data" data-flashdataperangkat="<?= $this->session->flashdata("flashPesanDataPerangkat"); ?>">
        </div>
        <div class="row">
            <div class="col-sm-3 pr-0">
                <a href="tambahDataPerangkat" class="btn btn-success mb-3">
                    <i class="fas fa-plus-circle fa-sm mr-1"></i>
                    <strong>Tambah Data Perangkat</strong>
                </a>
            </div>
            <div class="col-sm-4 pl-0 ml-0">
                <a href="<?= base_url('admin/dataPerangkatRouter'); ?>" class="btn btn-primary mb-3">
                    <i class="fas fa-info-circle fa-sm mr-1"></i>
                    <strong>Lihat Data Perangkat : Router</strong>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <table class="table table-hover table-bordered text-gray-900" id="tabelUsers">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <center>
                                    #
                                </center>
                            </th>
                            <th scope="col">Ser. Number</th>
                            <th scope="col">
                                <center>K. Cabang</center>
                            </th>
                            <th scope="col">
                                <center>End Of Life</center>
                            </th>
                            <th scope="col">
                                <center>End Of Sale</center>
                            </th>
                            <th scope="col">
                                <center>Last Date Support</center>
                            </th>
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($perangkat as $p) : ?>
                            <tr>
                                <th scope="row">
                                    <center>
                                        <?= $i++; ?>
                                    </center>
                                </th>
                                <td><?= $p["serial_number"]; ?></td>
                                <td>
                                    <center>
                                        <?= $p["kode_cabang"] . " " . $p["nama_kantorcabang"]; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= tgl_indo($p["end_of_life"]); ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= tgl_indo($p["end_of_sale"]); ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= tgl_indo($p["last_date_support"]); ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="<?= base_url(); ?>admin/detailPerangkat/<?= $p["id_perangkat"]; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-info-circle fa-sm"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>admin/ubahPerangkat/<?= $p["id_perangkat"]; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>admin/hapusPerangkat/<?= $p["id_perangkat"]; ?>" class="btn badge-danger btn-sm tombolHapusPerangkat">
                                            <i class="fas fa-trash-alt fa-sm"></i>
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