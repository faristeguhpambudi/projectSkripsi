<!-- Sidebar -->
<div class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion buatsidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-server"></i>
        </div>
        <div class="text-center mx-2">SIIPJ</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- MELAKUKAN QUERY MENU -->
    <?php
    //MENYIAPKAN ROLE ID
    $role_id  = $this->session->userdata('id_user_role');
    //membuat query tb_user_menu join tb_user_access_menu
    $queryMenu = "SELECT `tb_user_menu`.`id_user_menu`,`nama_menu`
                        FROM `tb_user_menu` JOIN `tb_user_access_menu`
                        ON `tb_user_menu`.`id_user_menu` = `tb_user_access_menu`.`id_user_menu`
                        WHERE `tb_user_access_menu`.`id_user_role` = $role_id
                        ORDER BY `tb_user_menu`.`nama_menu` ASC
                    ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading text-warning">
            <?= $m["nama_menu"]; ?>
        </div>

        <!-- SIAPKAN SUBMENU SESUAI MENU -->
        <?php
        //MENYIAPKAN MENU ID
        $menu_id = $m["id_user_menu"];
        //membuat query tb_user_menu join tb_user_sub_menu
        $querySubMenu = "SELECT *
            FROM `tb_user_sub_menu` JOIN `tb_user_menu`
            ON `tb_user_sub_menu`.`id_user_menu` = `tb_user_menu`.`id_user_menu`
            WHERE `tb_user_sub_menu`.`id_user_menu` = $menu_id AND `tb_user_sub_menu`.`is_active` = 1
            ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <!-- LOOPING SUBMENU -->
        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($judulHalaman == $sm["judul"]) : ?>
                <li class="nav-item ml-3 active">
                <?php else : ?>
                <li class="nav-item ml-3">
                <?php endif; ?>
                <!-- Nav Item - SUBMENU -->
                <a class="nav-link pb-0" href="<?= base_url($sm["url"]); ?>">
                    <i class="<?= "fas fa-fw " . $sm["icon"]; ?>"></i>
                    <span><?= $sm["judul"]; ?></span></a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>

        <!-- Nav Item - Profil -->
        <div class="sidebar-heading text-warning">
            Logout
        </div>
        <li class="nav-item mt-0 ml-3">
            <a class="nav-link tombolLogoutIni" href="<?= base_url('autentikasi/LogOut'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</div>
<!-- End of Sidebar -->