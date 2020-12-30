<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . '/' . $bulan[(int)$pecahkan[1]] . '/' . $pecahkan[0];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
    <br><br><br>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900">
        <i class="fas fa-calendar mr-1"></i>
        <strong><?= $judulHalaman; ?> All Data</strong>
    </h1>
    <div class="ml-5">
        <div class="flash-data" data-flashdatahistoris="<?= $this->session->flashdata("flashPesanDataHistoris"); ?>">
        </div>
        <!-- <div class="row">
            <div class="col-sm-3 pr-0">
                <a href="tambahDataHistorisKC" class="btn btn-success mb-3">
                    <i class="fas fa-plus-circle fa-sm mr-1"></i>
                    <strong>Tambah Data Historis</strong>
                </a>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg">
                <table class="table table-hover table-bordered text-gray-900" id="tabelHistoris">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <center>
                                    #
                                </center>
                            </th>
                            <th scope="col">Tanggal Historis</th>
                            <th scope="col">
                                <center>Cabang</center>
                            </th>
                            <th scope="col">
                                <center>Perangkat</center>
                            </th>
                            <th scope="col">
                                <center>Status</center>
                            </th>
                            <th scope="col">
                                <center>Biaya</center>
                            </th>
                            <th scope="col">
                                <center>Aksi</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $totalBiaya = 0;
                        ?>

                        <?php foreach ($historis as $h) : ?>
                            <tr>
                                <th scope="row">
                                    <center>
                                        <?= $i++; ?>
                                    </center>
                                </th>
                                <td>
                                    <?= tgl_indo($h["tgl_historis"]); ?>
                                </td>
                                <td>
                                    <center>
                                        <?= $h["nama_kantorcabang"]; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= $h["nama_kategori"] . "-" . $h["serial_number"]; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?= $h["keterangan_status"]; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        Rp <?= number_format($h["biaya"], 0, ".", "."); ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="<?= base_url(); ?>admin/detailHistoris/<?= $h["id_historis"]; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-info-circle fa-sm mr-1"></i>
                                            <strong>Detail</strong>
                                        </a>
                                        <!-- <a href="<?= base_url(); ?>adminkantorcabang/ubahDataHistorisKC/<?= $h["id_historis"]; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit fa-sm mr-1"></i>
                                            <strong>Edit</strong>
                                        </a> -->
                                        <a href="<?= base_url(); ?>admin/hapusHistoris/<?= $h["id_historis"]; ?>" class="btn badge-danger btn-sm mr-1 tombolHapusHistori">
                                            <i class="fas fa-trash-alt fa-sm"></i>
                                            <strong>Hapus</strong>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                            <?php $totalBiaya += $h["biaya"]; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <td colspan="5" class="bg-danger text-white text-center"><strong>TOTAL BIAYA</strong></td>
                    <td class="bg-danger text-white text-center">Rp <strong><?= number_format($totalBiaya, 0, ",", "."); ?></strong></td>
                </table>

                <br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->