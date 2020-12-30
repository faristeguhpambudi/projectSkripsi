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
        <i class="fas fa-user-tie mr-1"></i>
        <strong><?= $judulHalaman; ?></strong>
    </h1>
    <div class="ml-5">
        <div class="flash-data" data-flashdataprofil="<?= $this->session->flashdata("flashPesanProfil"); ?>">
        </div>
    </div>
    <div class="row ml-5">
        <div class="col-sm-4">
            <div class="card mb-3">
                <img class="card-img-top" src="<?= base_url('assets/img/perangkat/') . $perangkatDetail["foto"]; ?>" alt="Card image cap">
                <div class="card-body">
                    <a href="<?= base_url(); ?>admin/ubahPerangkat/<?= $perangkatDetail["id_perangkat"]; ?>" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-edit fa-sm"></i>
                        <strong> Edit Data Perangkat</strong></a>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <table class="table table-borderless text-gray-900">
                <tbody>
                    <tr>
                        <td><strong>Serial Number</strong></td>
                        <td>: <?= $perangkatDetail["serial_number"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kategori</strong></td>
                        <td>: <?= $perangkatDetail["nama_kategori"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kantor Cabang</strong></td>
                        <td>: <?= $perangkatDetail["nama_kantorcabang"]; ?></td>
                    </tr>
                    <tr>
                        <td><strong>End Of Life </strong></td>
                        <td>: <?= tgl_indo($perangkatDetail["end_of_life"]); ?></td>
                    </tr>
                    <tr>
                        <td><strong>End of Sale</strong></td>
                        <td>: <?= tgl_indo($perangkatDetail["end_of_sale"]); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Last Date Support</strong></td>
                        <td>: <?= tgl_indo($perangkatDetail["last_date_support"]); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Terdaftar sejak </strong></td>
                        <td>: <?= date('d F Y', $perangkatDetail["tgl_input"]); ?> </td>
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