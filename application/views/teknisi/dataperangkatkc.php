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
        <strong><?= $judulHalaman; ?> <?= $user["nama_kantorcabang"]; ?></strong>
    </h1>
    <div class="ml-5">
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
                            <th scope="col">Serial Number</th>
                            <th scope="col">
                                <center>Kategori</center>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($perangkat as $p) : ?>
                            <tr>
                                <th scope="row" data-orderable="false">
                                    <center>
                                        <?= $i++; ?>
                                    </center>
                                </th>
                                <td><?= $p["serial_number"]; ?></td>
                                <td>
                                    <center>
                                        <?= $p["nama_kategori"]; ?>
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