<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center text-gray-900 my-auto">
            <span><strong><i>Created by faristeguhpambudi@gmail.com &copy; 2020</i></strong></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/js/scriptalert.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>assets/js/scriptuntukmodal.js"></script>
<!-- BUAT DATE PICKER -->
<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<!-- UNTUK DATATABLES -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
<script type="text/javascript">
    $('#tabel').dataTable({
        "aLengthMenu": [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, 'All']
        ],
        "aoColumns": [{
                "bSortable": false
            },
            null,
            null,
            null
        ],
        "oLanguage": {
            "sInfo": 'Total Data yang tersimpan : _TOTAL_ Data.',
            "sLengthMenu": 'Tampilkan _MENU_ Data',
            "sInfoEmpty": 'Tidak ada Data.',
            "sZeroRecords": 'Tidak ditemukan data yang sesuai.',
            "sSearch": 'Pencarian:',
            "sEmptyTable": 'Tidak ada Data di dalam Database',
            "oPaginate": {
                "sNext": 'Selanjutnya',
                "sLast": 'Terakhir',
                "sFirst": 'Pertama',
                "sPrevious": 'Sebelumnya'
            }
        }
    });
</script>
<!-- UNTUK DATATABLES -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelUsers').DataTable();
    });
</script>
<script type="text/javascript">
    $('#tabelUsers').dataTable({
        "aLengthMenu": [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, 'All']
        ],
        "oLanguage": {
            "sInfo": 'Total Data yang tersimpan : _TOTAL_ Data.',
            "sLengthMenu": 'Tampilkan _MENU_ Data',
            "sInfoEmpty": 'Tidak ada Data.',
            "sZeroRecords": 'Tidak ditemukan data yang sesuai.',
            "sSearch": 'Pencarian:',
            "sEmptyTable": 'Tidak ada Data di dalam Database',
            "oPaginate": {
                "sNext": 'Selanjutnya',
                "sLast": 'Terakhir',
                "sFirst": 'Pertama',
                "sPrevious": 'Sebelumnya'
            }
        }
    });
</script>
<!-- UNTUK DATATABLES -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelHistoris').DataTable();
    });
</script>
<script type="text/javascript">
    $('#tabelHistoris').dataTable({
        "aLengthMenu": [
            [-1],
            ['All']
        ],
        "oLanguage": {
            "sInfo": 'Total Data yang tersimpan : _TOTAL_ Data.',
            "sLengthMenu": 'Tampilkan _MENU_ Data',
            "sInfoEmpty": 'Tidak ada Data.',
            "sZeroRecords": 'Tidak ditemukan data yang sesuai.',
            "sSearch": 'Pencarian:',
            "sEmptyTable": 'Tidak ada Data di dalam Database',
            "oPaginate": {
                "sNext": 'Selanjutnya',
                "sLast": 'Terakhir',
                "sFirst": 'Pertama',
                "sPrevious": 'Sebelumnya'
            }
        }
    });
</script>
<script>
    //UNTUK MODIFIKASI BROWSE FILE BOOTSTRAP
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });


    //UNTUK UBAH HAK AKSES
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        //JALANIN AJAX
        $.ajax({
            url: "<?= base_url('admin/ubahHakAkses'); ?>",
            type: 'post',
            data: {
                id_user_menu: menuId,
                id_user_role: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/aksesRole/'); ?>" + roleId;
            }
        });
    });
</script>

<!-- UNTUK SHOW PASSWORD -->
<script type="text/javascript">
    const visibilityToggle = document.querySelector('#icon');
    const input = document.querySelector('.kolompasswordnow');
    const warna = document.querySelector('#icon-click1');
    var password = true;

    visibilityToggle.addEventListener('click', function() {
        if (password) {
            input.setAttribute('type', 'text');
            visibilityToggle.setAttribute('class', 'large fas fa-eye');
            warna.setAttribute('class', 'text-primary');
        } else {
            input.setAttribute('type', 'password');
            visibilityToggle.setAttribute('class', 'large fas fa-eye-slash');
            warna.setAttribute('class', 'text-danger');
        }
        password = !password;
    });


    const visibilityToggle2 = document.querySelector('#icon2');
    const input2 = document.querySelector('.kolompasswordnew1');
    const warna2 = document.querySelector('#icon-click2');
    var password = true;

    visibilityToggle2.addEventListener('click', function() {
        if (password) {
            input2.setAttribute('type', 'text');
            visibilityToggle2.setAttribute('class', 'large fas fa-eye');
            warna2.setAttribute('class', 'text-primary');
        } else {
            input2.setAttribute('type', 'password');
            visibilityToggle2.setAttribute('class', 'large fas fa-eye-slash');
            warna2.setAttribute('class', 'text-danger');
        }
        password = !password;
    });


    const visibilityToggle3 = document.querySelector('#icon3');
    const input3 = document.querySelector('.kolompasswordnew2');
    const warna3 = document.querySelector('#icon-click3');
    var password = true;

    visibilityToggle3.addEventListener('click', function() {
        if (password) {
            input3.setAttribute('type', 'text');
            visibilityToggle3.setAttribute('class', 'large fas fa-eye');
            warna3.setAttribute('class', 'text-primary');
        } else {
            input3.setAttribute('type', 'password');
            visibilityToggle3.setAttribute('class', 'large fas fa-eye-slash');
            warna3.setAttribute('class', 'text-danger');
        }
        password = !password;
    });
</script>

<script type="text/javascript">
    //UNTUK MODAL KANTOR CABANG
    $('.tombolTambahDataKC').on('click', function() {
        $('#formModalKCBaruLabel').html('<strong>Tambah Data Kantor Cabang</strong>');
        $('.buttonModal').html('<strong>Tambah Data!</strong>');
        $('.aksiModalKC').attr('action', base_url + 'admin/dataKantorCabang');
        $('#kode_cabang').val("");
        $('#nama_kantorcabang').val("");
        $('#id_kantorcabang').val("");
    });
    $('.tombolUbahKC').on('click', function() {
        //UBAH TAMPILAN HTML DI MODAL
        $('#formModalKCBaruLabel').html('<strong>Ubah Data Kantor Cabang</strong>');
        $('.buttonModal').html('<strong>Ubah Data!</strong>');
        $('.aksiModalKC').attr('action', base_url + 'admin/ubahKC');

        //AMBIL ID YANG MAU DIUPDATE
        const id_kantorcabang = $(this).data('id');

        //JALANIN AJAX
        $.ajax({
            url: base_url + 'admin/getUbahKC',
            data: {
                id_kantorcabang: id_kantorcabang
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#id_kantorcabang').val(data.id_kantorcabang);
                $('#kode_cabang').val(data.kode_cabang);
                $('#nama_kantorcabang').val(data.nama_kantorcabang);
            }
        });
    });
</script>

</body>

</html>