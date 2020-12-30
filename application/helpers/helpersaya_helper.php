<?php

function apakah_sudah_login()
{
    //MEMANGGIL LIBRARY CI UNTUK FUNGSI INI
    //MENGGANTI THIS JADI CI
    $ci = get_instance();
    //CEK APAKAH SUDAH LOGIN
    //JIKA GAADA SESSION EMAIL
    if (!$ci->session->userdata('email')) {
        //TENDANG KE HALAMAN LOGIN
        redirect('autentikasi');
    } else { //JIKA SUDAH LOGIN
        //CEK ROLE ID NYA BERAPA
        $role_id = $ci->session->userdata('id_user_role');
        //SEDANG BERUSAHA AKSES CONTROLLER YANG MANA
        $controller = $ci->uri->segment(1);

        //QUERY TABEL USER MENU BERDASARKAN $CONTROLLER UNTK MENDAPATKAN ID USER MENU
        $queryMenu = $ci->db->get_where('tb_user_menu', ['controller' => $controller])->row_array();

        //AMBIL ID USER MENU
        $id_user_menu = $queryMenu["id_user_menu"];

        //CEK APAKAH ADA DI TABEL USER AKSES MENU
        //tampilkan semua data user akses menu dimana id_user_role = $role id dan id user menu = $id user menu
        $queryUserAccessMenu = $ci->db->get_where('tb_user_access_menu', [
            'id_user_role' => $role_id,
            'id_user_menu' => $id_user_menu
        ]);

        //JIKA QUERY USER ACCESS TIDAK ADA ISINYA
        if ($queryUserAccessMenu->num_rows() < 1) {
            //ALIHKAN KE HALAMAN AKSES BLOK
            redirect('autentikasi/blokAkses');
        }
    }
}

function cek_hak_akses($id_user_role, $id_user_menu)
{
    //MEMANGGIL LIBRARY CI UNTUK FUNGSI INI
    //MENGGANTI THIS JADI CI
    $ci = get_instance();

    //tampilkan semua data user akses menu dimana id_user_role = $role id dan id user menu = $id user menu
    $queryUserAccessMenu = $ci->db->get_where('tb_user_access_menu', [
        'id_user_role' => $id_user_role,
        'id_user_menu' => $id_user_menu
    ]);

    //JIKA QUERY ADA ISINYA
    if ($queryUserAccessMenu->num_rows() > 0) {
        //MENGEMBALIKAN NILAI KELAS CEKLIS
        $string = 'checked="checked"';
        return $string;
    }
}
