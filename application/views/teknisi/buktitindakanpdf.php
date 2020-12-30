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
            <strong>Tindakan</strong><br>
        </h2>
        <br>
        <div class="ml-5">
            <h1 class="h3 mb-2 buatfont">
                <strong>KC <?= $user["nama_kantorcabang"]; ?></strong>
            </h1>

            <div class="row ml-2 buatfont">
                <table class="table table-borderless buatfont">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="ml-3"><img src="assets/img/bukti/<?= $tindakanbyid["bukti_tindakan"]; ?>" style="width: 500px; height: auto;" class="gambar"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Kode Tindakan</strong></td>
                            <td>: <?= $tindakanbyid["kode_tindakan"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>: <?= tgl_indo($tindakanbyid["tgl_tindakan"]); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Teknisi </strong></td>
                            <td>: <?= $tindakanbyid["nama_lengkap"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Kategori </strong></td>
                            <td>: <?= $tindakanbyid["nama_kategori"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Serial Number</strong></td>
                            <td>: <?= $tindakanbyid["serial_number"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Masalah</strong></td>
                            <td>: <?= $tindakanbyid["desk_masalah"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tindakan</strong></td>
                            <td>: <?= $tindakanbyid["desk_tindakan"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Diinput Tanggal </strong></td>
                            <td>: <?= date('d F Y', $tindakanbyid["date_created"]); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>