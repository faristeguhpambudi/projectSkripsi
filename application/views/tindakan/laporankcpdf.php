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
<!DOCTYPE html>
<html lang="en">

<head>

    <title><?= $judulHalaman; ?></title>
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css2/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css2/font.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="logotaspen.jpg" />
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid mt-4">
        <img src="assets/img/logotaspen.jpg" alt="" style="position: absolute; width: 150px; height: auto;">
        <br>
        <table style="width: 100%;" class="pl-3 ml-3">
            <tr>
                <td>
                    <span style="line-height: 1.6; font-weight: bold;">
                    </span>
                </td>
            </tr>
        </table>
        <br><br>
        <hr>
        <h2 class="text-center buatfont">
            <strong>Laporan Tindakan</strong> KC <?= $user["nama_kantorcabang"]; ?><br>
            <?php if ($this->session->userdata('tanggalmulai')) : ?>
                <p class="text-center buatfont"><strong><?= "Periode tanggal " .  tgl_indo2($this->session->userdata('tanggalmulai')) . " s/d " . tgl_indo2($this->session->userdata('tanggalselesai')); ?></strong></p>
            <?php endif; ?>
        </h2>
        <br>
        <div class="ml-5">
            <div class="row">
                <div class="col-lg">
                    <table class="table table-hover table-bordered buatfont">
                        <thead class="bg-primary text-white buatfont">
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
                        <tbody class="buatfont">
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
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
</body>

</html>