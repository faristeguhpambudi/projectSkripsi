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
        <i class="fas fa-tools mr-1"></i>
        <strong><?= $judulHalaman; ?> : KC <?= $user["nama_kantorcabang"]; ?></strong>
    </h1>
    <div class="row ml-5">
        <div class="col-sm-6">
            <table class="table table-borderless text-gray-900">
                <tbody>
                    <tr>
                        <td><strong>Kode Tindakan</strong></td>
                        <td>: <?= $tindakanbyid["kode_tindakan"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Tindakan</strong></td>
                        <td>: <?= tgl_indo($tindakanbyid["tgl_tindakan"]); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Teknisi </strong></td>
                        <td>: <?= $tindakanbyid["nama_lengkap"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kategori Perangkat </strong></td>
                        <td>: <?= $tindakanbyid["nama_kategori"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Serial Number</strong></td>
                        <td>: <?= $tindakanbyid["serial_number"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Deskripsi Masalah</strong></td>
                        <td>: <?= $tindakanbyid["desk_masalah"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Deskripsi Tindakan</strong></td>
                        <td>: <?= $tindakanbyid["desk_tindakan"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Diinput Tanggal </strong></td>
                        <td>: <?= date('d F Y', $tindakanbyid["date_created"]); ?> </td>
                    </tr>
                </tbody>
            </table>
            <a href="<?= base_url(); ?>teknisi/tindakan" class="btn btn-success btn-sm">
                <i class="fas fa-arrow-left mr-1"></i>
                <strong>Kembali</strong>
            </a>

        </div>
        <div class="col-sm-6">
            <div class="card mb-3">
                <img class="card-img-top" src="<?= base_url('assets/img/bukti/') . $tindakanbyid["bukti_tindakan"]; ?>" alt="Card image cap">
            </div>
        </div>

    </div>
    <br><br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->