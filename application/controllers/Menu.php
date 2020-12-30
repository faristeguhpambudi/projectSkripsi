<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //MENJALANKAN HELPER FUNCTION CEK LOGIN
        apakah_sudah_login(); //dalam folder helper
        //MEMANGGIL MODEL DI CONSTRUCT
        $this->load->model('User_model');
        $this->load->model('Menu_model');
    }

    public function index()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Menu Management";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["menu"]  = $this->Menu_model->getAllMenu();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH MENU BARU
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|trim', [
            'required' => 'Gagal menambah menu baru. Kolom nama menu tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN MENU   
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //jika formnya benar
            //KE METHOD YANG ADA DI MODEL
            $this->Menu_model->tambahDataMenu();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanMenu", "ditambah");
            //ALIHKAN HALAMAN
            redirect('menu');
        }
    }

    public function submenu()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Sub Menu Management";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["menu"]  = $this->Menu_model->getAllMenu();
        $data["subMenu"]  = $this->Menu_model->getSubMenu();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH SUBMENU BARU
        $this->form_validation->set_rules('judul', 'Nama Sub Menu', 'required|trim', [
            'required' => 'Gagal menambah sub menu baru. Kolom nama sub menu tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_user_menu', 'Menu', 'required|trim', [
            'required' => 'Gagal menambah menu baru. Kolom menu tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'Gagal menambah menu baru. Kolom URL menu tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon Menu', 'required|trim', [
            'required' => 'Gagal menambah menu baru. Kolom icon menu tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN SUBMENU   
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->Menu_model->tambahDataSubMenu();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanSubMenu", "ditambah");
            //ALIHKAN HALAMAN
            redirect('menu/submenu');
        }
    }

    public function hapusMenu($id_user_menu)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Menu_model->hapusDataMenu($id_user_menu);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanMenu", "dihapus");
        //ALIHKAN HALAMAN
        redirect('menu');
    }

    public function hapusSubMenu($id_user_sub_menu)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Menu_model->hapusDataSubMenu($id_user_sub_menu);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanSubMenu", "dihapus");
        //ALIHKAN HALAMAN
        redirect('menu/submenu');
    }

    public function getUbahMenu()
    {
        //menampilkan data yang akan diubah untuk di modal
        echo json_encode($this->Menu_model->getMenuById($_POST["id_user_menu"]));
    }

    public function getUbahSubMenu()
    {
        //menampilkan data yang akan diubah untuk di modal
        echo json_encode($this->Menu_model->getSubMenuById($_POST["id_user_sub_menu"]));
    }

    public function ubahMenu()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Menu Management";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["menu"]  = $this->Menu_model->getAllMenu();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH MENU BARU
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom nama menu tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN MENU   
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->Menu_model->ubahDataMenu();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanMenu", "diubah");
            //ALIHKAN HALAMAN
            redirect('menu');
        }
    }

    public function ubahSubMenu()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Sub Menu Management";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["menu"]  = $this->Menu_model->getAllMenu();
        $data["subMenu"]  = $this->Menu_model->getSubMenu();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH SUBMENU BARU
        $this->form_validation->set_rules('judul', 'Nama Sub Menu', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom nama sub menu tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_user_menu', 'Menu', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom menu tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom URL menu tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon Menu', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom icon menu tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN SUBMENU   
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->Menu_model->ubahDataSubMenu();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanSubMenu", "diubah");
            //ALIHKAN HALAMAN
            redirect('menu/submenu');
        }
    }
}
