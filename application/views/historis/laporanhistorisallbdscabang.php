<?php
function tgl_indo2($tanggal)
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
        <i class="fas fa-file-alt mr-1"></i>
        <strong><?= $judulHalaman; ?></strong>
        <a href="<?= base_url('admin/laporanHistoris'); ?>" class="btn btn-success"><i class="fas fa-calendar-alt fa-sm mr-1"></i><strong>Berdasarkan Tanggal</strong></a>
        <a href="<?= base_url('admin/laporanHistorisBdsCabang'); ?>" class="btn btn-primary"><i class="fas fa-table fa-sm mr-1"></i><strong>Berdasarkan Cabang</strong></a>
        <a href="<?= base_url('admin/laporanHistorisBdsKategori'); ?>" class="btn btn-warning"><i class="fas fa-project-diagram fa-sm mr-1"></i><strong>Berdasarkan Kategori</strong></a>
        <a href="<?= base_url('admin/laporanHistorisBdsStatus'); ?>" class="btn btn-dark"><i class="fas fa-tools fa-sm mr-1"></i><strong>Berdasarkan Status</strong></a>
    </h1>
    <div class="ml-5">
        <form action="" method="post">
            <div class="row">
                <div class="col-sm-6 text-gray-900">
                    <div class="form-group row">
                        <label for="id_kantorcabang" class="col-sm-4 col-form-label"><strong>Pilih Kantor Cabang</strong></label>
                        <div class="col-sm-6">
                            <select name="id_kantorcabang" id="id_kantorcabang" class="form-control">
                                <option value="">-- Pilih Kantor Cabang --</option>
                                <?php foreach ($cabang as $c) : ?>
                                    <option value="<?= $c["id_kantorcabang"]; ?>"><?= $c["nama_kantorcabang"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_kantorcabang', '<small class="text-danger pl-3"><strong><i>', '</i></strong></small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 text-gray-900">
                    <div class="form-group row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success"><i class="fas fa-search fa-sm mr-1"></i><strong>Cari Data!</strong></button>
                            <a href="<?= base_url('admin/cetakLaporanHistorisBdsCabang'); ?>" target="_blank" class="btn btn-danger"><i class="fas fa-print fa-sm mr-1"></i><strong>Cetak Laporan!</strong></a>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg text-gray-900 mb-2">
            <?php if ($historis != null) : ?>
                <strong>Kantor Cabang : <?= $historis[0]["kode_cabang"] . " " . $historis[0]["nama_kantorcabang"]; ?></strong>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <?php if ($historis == null) : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Data yang anda cari tidak ditemukan.</strong>
                </div>
            <?php endif; ?>
            <?php if ($historis != null) : ?>
                <table class="table table-hover table-bordered text-gray-900">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <center>
                                    #
                                </center>
                            </th>
                            <th scope="col">Tanggal</th>
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
                                    <?= $h["kode_cabang"] . " - " . $h["nama_kantorcabang"]; ?>
                                </td>
                                <td>
                                    <center>
                                        <?= $h["nama_kategori"] . " - " . $h["serial_number"]; ?>
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
                            </tr>
                            <?php $totalBiaya += $h["biaya"]; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <td colspan="5" class="bg-danger text-white text-center"><strong>TOTAL BIAYA</strong></td>
                    <td class="bg-danger text-white text-center"><strong>Rp <?= number_format($totalBiaya, 0, ",", "."); ?></strong></td>
                </table>
            <?php endif; ?>

            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->