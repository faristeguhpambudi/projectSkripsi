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
        <strong><?= $judulHalaman; ?></strong> KC : <?= $user["nama_kantorcabang"]; ?>
    </h1>
    <div class="ml-5">
        <form action="" method="post">
            <div class="row">
                <div class="col-sm-4 text-gray-900">
                    <div class="form-group row">
                        <label for="tanggalmulai" class="col-sm-6 col-form-label"><strong>Tanggal Mulai</strong></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" id="tanggalmulai" name="tanggalmulai" value="<?= $tanggalmulai; ?>" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-gray-900">
                    <div class="form-group row">
                        <label for="tanggalselesai" class="col-sm-6 col-form-label"><strong>Tanggal Selesai</strong></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control datepicker" id="tanggalselesai" name="tanggalselesai" value="<?= $tanggalselesai; ?>" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-gray-900">
                    <div class="form-group row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success"><i class="fas fa-search fa-sm mr-1"></i><strong>Cari Data!</strong></button>
                            <a href="<?= base_url('adminkantorcabang/cetakLaporanTindakan'); ?>" target="_blank" class="btn btn-danger"><i class="fas fa-print fa-sm mr-1"></i><strong>Cetak Laporan!</strong></a>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg text-gray-900">
            <?php if ($tanggalmulai != null) : ?>
                <p><strong><?= "Laporan Tindakan Periode tanggal " .  tgl_indo2($tanggalmulai) . " s/d " . tgl_indo2($tanggalselesai); ?></strong></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
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
                            <center>Kode Tindakan</center>
                        </th>
                        <th scope="col">
                            <center>Perangkat</center>
                        </th>
                        <th scope="col">
                            <center>Teknisi</center>
                        </th>
                        <th scope="col">
                            <center>Masalah</center>
                        </th>
                        <th scope="col">
                            <center>Tindakan</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    ?>

                    <?php foreach ($tindakan as $t) : ?>
                        <tr>
                            <th scope="row">
                                <center>
                                    <?= $i++; ?>
                                </center>
                            </th>
                            <td>
                                <?= tgl_indo($t["tgl_tindakan"]); ?>
                            </td>
                            <td>
                                <center>
                                    <?= $t["kode_tindakan"]; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?= $t["nama_kategori"] . " - " . $t["serial_number"]; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?= $t["nama_lengkap"]; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?= $t["desk_masalah"]; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?= $t["desk_tindakan"]; ?>
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