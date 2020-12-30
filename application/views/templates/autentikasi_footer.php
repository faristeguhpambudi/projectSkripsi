<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script type="text/javascript">
    //UNTUK SHOW PASSSWORD DI LOGIN
    const visibilityToggle = document.querySelector('#icon');
    const input = document.querySelector('.kolompassword');
    const warna = document.querySelector('#icon-click');
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
</script>
<script type="text/javascript">
    //UNTUK SHOW PASSWORD DI RESET PASSWORD
    const mata1 = document.querySelector('#mata1');
    const input1 = document.querySelector('.kolompassword1');
    const warna1 = document.querySelector('#warna1');
    var password = true;

    mata1.addEventListener('click', function() {
        if (password) {
            input1.setAttribute('type', 'text');
            mata1.setAttribute('class', 'large fas fa-eye');
            warna1.setAttribute('class', 'text-primary');
        } else {
            input1.setAttribute('type', 'password');
            mata1.setAttribute('class', 'large fas fa-eye-slash');
            warna1.setAttribute('class', 'text-danger');
        }
        password = !password;
    });
</script>
<script type="text/javascript">
    //UNTUK SHOW PASSWORD DI RESET PASSWORD
    const mata2 = document.querySelector('#mata2');
    const input2 = document.querySelector('.kolompassword2');
    const warna2 = document.querySelector('#warna2');
    var password = true;

    mata2.addEventListener('click', function() {
        if (password) {
            input2.setAttribute('type', 'text');
            mata2.setAttribute('class', 'large fas fa-eye');
            warna2.setAttribute('class', 'text-primary');
        } else {
            input2.setAttribute('type', 'password');
            mata2.setAttribute('class', 'large fas fa-eye-slash');
            warna2.setAttribute('class', 'text-danger');
        }
        password = !password;
    });
</script>

</body>

</html>