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
        <i class="fas fa-calendar mr-1"></i>
        <strong><?= $judulHalaman; ?> : KC <?= $historisbyid["nama_kantorcabang"]; ?></strong>
    </h1>
    <div class="ml-5">
        <div class="flash-data" data-flashdataprofil="<?= $this->session->flashdata("flashPesanProfil"); ?>">
        </div>
    </div>
    <div class="row ml-5">
        <div class="col-sm-6">
            <table class="table table-borderless text-gray-900">
                <tbody>
                    <tr>
                        <td><strong>Tanggal Historis</strong></td>
                        <td>: <?= tgl_indo($historisbyid["tgl_historis"]); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kategori Perangkat </strong></td>
                        <td>: <?= $historisbyid["nama_kategori"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Serial Number</strong></td>
                        <td>: <?= $historisbyid["serial_number"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status Perangkat</strong></td>
                        <td>: <?= $historisbyid["status_perangkat"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Keterangan</strong></td>
                        <td>: <?= $historisbyid["deskripsi"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Biaya</strong></td>
                        <td>: Rp <?= number_format($historisbyid["biaya"], 0, ".", "."); ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-sm-6">
            <h3 class="text-center text-gray-900"><strong>Riwayat Tindakan</strong></h3>
            <table class="table table-borderless text-gray-900">
                <tbody>
                    <tr>
                        <td><strong>Kode Tindakan</strong></td>
                        <td>: <?= $historisbyid["kode_tindakan"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Tindakan</strong></td>
                        <td>: <?= tgl_indo($historisbyid["tgl_tindakan"]); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Teknisi </strong></td>
                        <td>: <?= $historisbyid["nama_lengkap"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Deskripsi Masalah </strong></td>
                        <td>: <?= $historisbyid["desk_masalah"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Deskripsi Tindakan </strong></td>
                        <td>: <?= $historisbyid["desk_tindakan"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <br><br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->