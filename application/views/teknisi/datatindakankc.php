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
        <strong><?= $judulHalaman; ?> : KC <?= $user["nama_kantorcabang"]; ?></strong>
    </h1>
    <div class="ml-5">
        <div class="flash-data" data-flashdatatindakan="<?= $this->session->flashdata("flashPesanDataTindakan"); ?>">
        </div>
        <div class="row">
            <div class="col-sm-3 pr-0">
                <a href="tambahDataTindakanKC" class="btn btn-success mb-3">
                    <i class="fas fa-plus-circle fa-sm mr-1"></i>
                    <strong>Tambah Data Tindakan</strong>
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
                            <th scope="col">Kode Tindakan</th>
                            <th scope="col">
                                <center>Tanggal Tindakan</center>
                            </th>
                            <th scope="col">
                                <center>Teknisi</center>
                            </th>
                            <th scope="col">
                                <center>Serial Number</center>
                            </th>
                            <!-- <th scope="col">
                                <center>Kategori</center>
                            </th> -->
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tindakan as $t) : ?>
                            <tr>
                                <th scope="row">
                                    <center>
                                        <?= $i++; ?>
                                    </center>
                                </th>
                                <td><?= $t["kode_tindakan"]; ?></td>
                                <td>
                                    <center>
                                        <?= tgl_indo($t["tgl_tindakan"]); ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= $t["nama_lengkap"]; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= $t["serial_number"]; ?>
                                    </center>
                                </td>
                                <!-- <td>
                                    <center>
                                        <?= $t["nama_kategori"]; ?>
                                    </center>
                                </td> -->
                                <td>
                                    <center>
                                        <a href="<?= base_url(); ?>teknisi/detailTindakan/<?= $t["id_tindakan"]; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-info-circle fa-sm mr-1"></i>
                                            <strong>Detail</strong>
                                        </a>
                                        <a href="<?= base_url(); ?>teknisi/cetakTindakan/<?= $t["id_tindakan"]; ?>" class="btn btn-danger btn-sm" target="_black">
                                            <i class="fas fa-print fa-sm mr-1"></i>
                                            <strong>Cetak</strong>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->