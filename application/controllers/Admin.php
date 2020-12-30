<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //MENJALANKAN HELPER FUNCTION CEK LOGIN
        apakah_sudah_login(); //dalam folder helper
        //MEMANGGIL MODEL DI CONSTRUCT
        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Menu_model');
        $this->load->model('KantorCabang_model');
        $this->load->model('Perangkat_model');
        $this->load->model('Tindakan_model');
        $this->load->model('Historis_model');
    }

    public function index()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Dashboard";
        $data["user"] = $this->User_model->dataSessionUser();

        //MEMANGGIL VIEW HALAMAN ADMIN    
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function role()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Role";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["role"]  = $this->Role_model->getAllRole();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH MENU BARU
        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Gagal menambah Role baru. Kolom Role tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN ADMIN    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('admin/halaman_role', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //jika formnya benar
            //KE METHOD YANG ADA DI MODEL
            $this->Role_model->tambahDataRole();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataRole", "ditambah");
            //ALIHKAN HALAMAN
            redirect('admin/role');
        }
    }

    public function ubahRole()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Role";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["role"]  = $this->Role_model->getAllRole();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH MENU BARU
        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Gagal menambah Role baru. Kolom Role tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN ADMIN    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('admin/halaman_role', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //jika formnya benar
            //KE METHOD YANG ADA DI MODEL
            $this->Role_model->ubahDataRole();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataRole", "diubah");
            //ALIHKAN HALAMAN
            redirect('admin/role');
        }
    }


    public function getUbahRole()
    {
        //menampilkan data yang akan diubah untuk di modal
        echo json_encode($this->Role_model->getRoleById($_POST["id_user_role"]));
    }

    public function hapusRole($id_user_role)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Role_model->hapusDataRole($id_user_role);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataRole", "dihapus");
        //ALIHKAN HALAMAN
        redirect('admin/role');
    }



    public function aksesRole($id_user_role)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Hak Akses";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["role"]  = $this->Role_model->getRoleById($id_user_role);
        $data["menu"]  = $this->Menu_model->getMenuTanpaAdmin();

        //MEMANGGIL VIEW HALAMAN ADMIN    
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('admin/halaman_roleAkses', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function ubahHakAkses()
    {
        //AMBIL DATA YANG DIKIRIM AJAX
        $menuId = $this->input->post('id_user_menu');
        $roleId = $this->input->post('id_user_role');

        //MENYIAPKAN ARRAY DATA UNTUK DIMASUKKAN KE QUERY
        $data = [
            'id_user_role' => $roleId,
            'id_user_menu' => $menuId
        ];

        //QUERY TABEL USER ACCESS MENU DIMANA ADA DATANYA
        $queryAccessMenu = $this->db->get_where('tb_user_access_menu', $data);

        //JIKA DATANYA GAADA DI TABEL
        if ($queryAccessMenu->num_rows() < 1) {
            //INSERT DATANYA KE TABEL
            $this->db->insert('tb_user_access_menu', $data);
        } else { //JIKA DATANYA ADA DI TABEL
            //DELETE DATANYA
            $this->db->delete('tb_user_access_menu', $data);
        }
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanAksesRole", "diubah");
    }

    public function dataKantorCabang()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Kantor Cabang";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH SUBMENU BARU
        $this->form_validation->set_rules('kode_cabang', 'Kode Cabang', 'required|trim|is_unique[tb_kantorcabang.kode_cabang]', [
            'required' => 'Gagal menambah data kantor cabang baru. Kolom kode cabang tidak boleh kosong!',
            'is_unique' => 'Kode Cabang ini sudah pernah terdaftar! Buat kode cabang lain!'
        ]);
        $this->form_validation->set_rules('nama_kantorcabang', 'Cabang', 'required|trim', [
            'required' => 'Gagal menambah data kantor cabang baru. Kolom cabang tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('admin/datakantorcabang', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->KantorCabang_model->tambahDataKC();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanKC", "ditambah");
            //ALIHKAN HALAMAN
            redirect('admin/dataKantorCabang');
        }
    }

    public function hapusKC($id_kantorcabang)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->KantorCabang_model->hapusDataKC($id_kantorcabang);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanKC", "dihapus");
        //ALIHKAN HALAMAN
        redirect('admin/dataKantorCabang');
    }

    public function ubahKC($id_kantorcabang)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data Kantor Cabang";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kantorCabang"]  = $this->KantorCabang_model->getKCById($id_kantorcabang);

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH SUBMENU BARU
        $this->form_validation->set_rules('kode_cabang', 'Kode Cabang', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom kode cabang tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('nama_kantorcabang', 'Cabang', 'required|trim', [
            'required' => 'Gagal mengubah data. Kolom cabang tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('admin/ubahkantorcabang', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->KantorCabang_model->ubahDataKC();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanKC", "diubah");
            //ALIHKAN HALAMAN
            redirect('admin/dataKantorCabang');
        }
    }

    public function dataUser()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data User";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["dataUser"]  = $this->User_model->getAllUser();

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('admin/datauser', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function detailUser($id_user)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail User";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["userDetail"] = $this->User_model->getUserById($id_user);

        //MEMANGGIL VIEW HALAMAN LOGIN    
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('admin/detaildatauser', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataUser()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Data User";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["role"] = $this->User_model->dataRole();
        $data["gender"] = $this->User_model->dataGender();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH USER
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim', [
            'required' => 'Gagal menambah data user. Kolom nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_gender', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Gagal menambah data user. Kolom jenis kelamin tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kantorcabang', 'Kc', 'required|trim', [
            'required' => 'Kolom kantor cabang tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_user_role', 'Role', 'required|trim', [
            'required' => 'Kolom Role tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'required' => 'Kolom email tidak boleh kosong!',
            'valid_email' => 'Yang anda masukkan bukan email!',
            'is_unique' => 'Email ini sudah pernah terdaftar!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN TAMBAH DATA USER    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('admin/tambahdatauser', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->User_model->tambahDataUser();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataUser", "ditambah");
            //ALIHKAN HALAMAN
            redirect('admin/dataUser');
        }
    }

    public function hapusUser($id_user)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->User_model->hapusDataUser($id_user);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataUser", "dihapus");
        //ALIHKAN HALAMAN
        redirect('admin/dataUser');
    }

    public function ubahDataUser($id_user)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data User";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["userbyid"] = $this->User_model->getUserById($id_user);
        $data["role"] = $this->User_model->dataRole();
        $data["gender"] = $this->User_model->dataGender();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH USER
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim', [
            'required' => 'Gagal menambah data user. Kolom nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_gender', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Gagal menambah data user. Kolom jenis kelamin tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kantorcabang', 'Kc', 'required|trim', [
            'required' => 'Kolom kantor cabang tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_user_role', 'Role', 'required|trim', [
            'required' => 'Kolom Role tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Kolom email tidak boleh kosong!',
            'valid_email' => 'Yang anda masukkan bukan email!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN TAMBAH DATA USER    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('admin/ubahdatauser', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //KE METHOD YANG ADA DI MODEL
            $this->User_model->ubahDataUser();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataUser", "diubah");
            //ALIHKAN HALAMAN
            redirect('admin/dataUser');
        }
    }

    public function dataPerangkat()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["perangkat"]  = $this->Perangkat_model->getAllSwitch();

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('perangkat/dataswitch', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function detailPerangkat($id_perangkat)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["perangkatDetail"] = $this->Perangkat_model->getPerangkatById($id_perangkat);

        //MEMANGGIL VIEW HALAMAN LOGIN    
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('perangkat/detaildataperangkat', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataPerangkat()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();
        $data["kategori"]  = $this->Perangkat_model->getAllKategori();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|trim', [
            'required' => 'Kolom serial number tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|trim', [
            'required' => 'Kolom kategori tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kantorcabang', 'Kc', 'required|trim', [
            'required' => 'Kolom kantor cabang tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_life', 'End of life', 'required|trim', [
            'required' => 'Kolom End of Life tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_sale', 'End of Sale', 'required|trim', [
            'required' => 'Kolom End of Sale tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('last_date_support', 'Last Date Support', 'required|trim', [
            'required' => 'Kolom Last date support tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('perangkat/tambahdataperangkat', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Perangkat_model->tambahDataPerangkat();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataPerangkat", "ditambah");
            // //ALIHKAN HALAMAN
            redirect('admin/dataPerangkat');
        }
    }

    public function hapusPerangkat($id_perangkat)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Perangkat_model->hapusDataPerangkat($id_perangkat);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataPerangkat", "dihapus");
        //ALIHKAN HALAMAN
        redirect('admin/dataPerangkat');
    }

    public function ubahPerangkat($id_perangkat)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["perangkatbyid"] = $this->Perangkat_model->getPerangkatById($id_perangkat);
        $data["kategori"]  = $this->Perangkat_model->getAllKategori();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|trim', [
            'required' => 'Kolom serial number tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|trim', [
            'required' => 'Kolom kategori tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kantorcabang', 'Kc', 'required|trim', [
            'required' => 'Kolom kantor cabang tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_life', 'End of life', 'required|trim', [
            'required' => 'Kolom End of Life tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_sale', 'End of Sale', 'required|trim', [
            'required' => 'Kolom End of Sale tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('last_date_support', 'Last Date Support', 'required|trim', [
            'required' => 'Kolom Last date support tidak boleh kosong!'
        ]);


        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN TAMBAH DATA USER    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('perangkat/ubahdataperangkat', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Perangkat_model->ubahDataPerangkat();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataPerangkat", "diubah");
            // //ALIHKAN HALAMAN
            redirect('admin/dataPerangkat');
        }
    }

    public function kategoriPerangkat()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Kategori Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kategori"]  = $this->Perangkat_model->getAllKategori();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH MENU BARU
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim', [
            'required' => 'Gagal menambah Kategori baru. Kolom nama kategori tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN MENU   
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('perangkat/kategoriperangkat', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //jika formnya benar
            //KE METHOD YANG ADA DI MODEL
            $this->Perangkat_model->tambahDataKategori();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanKategori", "ditambah");
            //ALIHKAN HALAMAN
            redirect('admin/kategoriPerangkat');
        }
    }

    public function hapusKategori($id_kategori)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Perangkat_model->hapusDataKategori($id_kategori);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanKategori", "dihapus");
        //ALIHKAN HALAMAN
        redirect('admin/kategoriPerangkat');
    }

    public function getUbahKategori()
    {
        //menampilkan data yang akan diubah untuk di modal
        echo json_encode($this->Perangkat_model->getKategoriById($_POST["id_kategori"]));
    }

    public function ubahKategori()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Kategori Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kategori"]  = $this->Perangkat_model->getAllKategori();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH MENU BARU
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim', [
            'required' => 'Gagal mengubah kategori. Kolom nama kategori tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN MENU   
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('perangkat/kategoriperangkat', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //jika formnya benar
            //KE METHOD YANG ADA DI MODEL
            $this->Perangkat_model->ubahDataKategori();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanKategori", "diubah");
            //ALIHKAN HALAMAN
            redirect('admin/kategoriPerangkat');
        }
    }

    public function dataPerangkatRouter()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["perangkat"]  = $this->Perangkat_model->getAllRouter();

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('perangkat/datarouter', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function historis()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = $this->Historis_model->getAllHistoris();

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('historis/datahistorisall', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataHistoris()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Data Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["teknisi"]  = $this->Tindakan_model->getAllTeknisiByKC($idKC);
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('tgl_historis', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal historis tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_tindakan', 'tindakan', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('status_perangkat', 'status', 'required|trim', [
            'required' => 'Kolom status perangkat tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('biaya', 'biaya', 'required|trim|integer', [
            'required' => 'Kolom biaya tidak boleh kosong!',
            'integer' => 'Yang anda masukkan bukan angka!',
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/tambahdatahistoriskc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Historis_model->tambahDataHistorisKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataHistoris", "ditambah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang/historis');
        }
    }

    public function hapusHistoris($id_historis)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Historis_model->hapusDataHistoris($id_historis);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataHistoris", "dihapus");
        //ALIHKAN HALAMAN
        redirect('adminkantorcabang/historis');
    }

    public function ubahDataHistoris($id_historis)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["historisid"] = $this->Historis_model->getHistorisById($id_historis);

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('tgl_historis', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal historis tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_tindakan', 'tindakan', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('status_perangkat', 'status', 'required|trim', [
            'required' => 'Kolom status perangkat tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('biaya', 'biaya', 'required|trim|integer', [
            'required' => 'Kolom biaya tidak boleh kosong!',
            'integer' => 'Yang anda masukkan bukan angka!',
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/ubahdatahistoriskc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Historis_model->ubahDataHistorisKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataHistoris", "diubah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang/historis');
        }
    }

    public function detailHistoris($id_historis)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["historisbyid"] = $this->Historis_model->getHistorisById($id_historis);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('historis/detailhistoris', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function laporanHistoris()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = $this->Historis_model->getAllHistoris();


        //ATUR RULE
        $this->form_validation->set_rules("tanggalmulai", "Tanggal Mulai", "required");
        $this->form_validation->set_rules("tanggalselesai", "Tanggal Selesai", "required");

        $data["tanggalmulai"] = $this->input->post("tanggalmulai");
        $data["tanggalselesai"] = $this->input->post("tanggalselesai");
        $data["submit"] = $this->input->post("submit");
        $this->session->set_userdata('tanggalmulai', $data["tanggalmulai"]);
        $this->session->set_userdata('tanggalselesai', $data["tanggalselesai"]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisall', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporan();
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisall', $data);
            $this->load->view('templates/halaman_footer', $data);
        }
    }

    public function cetakLaporanHistoris()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = $this->Historis_model->getAllHistoris();

        $data["tanggalmulai"] = $this->input->post("tanggalmulai");
        $data["tanggalselesai"] = $this->input->post("tanggalselesai");
        $data["submit"] = $this->input->post("submit");
        $tanggalmulai = $this->session->userdata('tanggalmulai');
        $tanggalmulai = $this->session->userdata('tanggalselesai');
        //JIKA
        if ($tanggalmulai == null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-petanikode.pdf";
            $this->pdf->load_view('historis/laporanpdf', $data);
        } else {
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporan2();
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan.pdf";
            $this->pdf->load_view('historis/laporanpdf', $data);
        }
    }

    public function laporanHistorisBdsCabang()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["cabang"]  = $this->Perangkat_model->getAllKantorCabang();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"] = null;

        //ATUR RULE
        $this->form_validation->set_rules("id_kantorcabang", "Kantor Cabang", "required", [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        $data["kantorCabang"] = $this->input->post("id_kantorcabang");
        $data["submit"] = $this->input->post("submit");
        $this->session->set_userdata('kantorCabang', $data["kantorCabang"]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisallbdscabang', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $id_kantorcabang = $this->input->post('id_kantorcabang');
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanBdsCabang($id_kantorcabang);
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisallbdscabang', $data);
            $this->load->view('templates/halaman_footer', $data);
        }
    }

    public function cetakLaporanHistorisBdsCabang()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = null;

        $kantorCabang = $this->session->userdata('kantorCabang');
        //JIKA
        if ($kantorCabang == null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-petanikode.pdf";
            $this->pdf->load_view('historis/laporanpdf', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanBdsCabang($kantorCabang);
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan.pdf";
            $this->pdf->load_view('historis/laporanpdfhistorisbdscabang', $data);
        }
    }

    public function laporanHistorisBdsKategori()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKategori();


        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"] = null;

        //ATUR RULE
        $this->form_validation->set_rules("id_kategori", "Kategori", "required", [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        $data["kategori"] = $this->input->post("id_kategori");
        $data["submit"] = $this->input->post("submit");
        $this->session->set_userdata('kategori', $data["kategori"]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisallbdskategori', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $id_kategori = $this->input->post('id_kategori');
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanBdsKategori($id_kategori);
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisallbdskategori', $data);
            $this->load->view('templates/halaman_footer', $data);
        }
    }

    public function cetakLaporanHistorisBdsKategori()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = null;

        $kategori = $this->session->userdata('kategori');
        //JIKA
        if ($kategori == null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-petanikode.pdf";
            $this->pdf->load_view('historis/laporanpdf', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanBdsKategori($kategori);
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan.pdf";
            $this->pdf->load_view('historis/laporanpdfhistorisbdskategori', $data);
        }
    }

    public function laporanHistorisBdsStatus()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllStatus();


        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"] = null;

        //ATUR RULE
        $this->form_validation->set_rules("status_perangkat", "Status", "required", [
            'required' => 'Kolom ini tidak boleh kosong.'
        ]);

        $data["status"] = $this->input->post("status_perangkat");
        $data["submit"] = $this->input->post("submit");
        $this->session->set_userdata('status', $data["status"]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisallbdsstatus', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $status = $this->input->post('status_perangkat');
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanBdsStatus($status);
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistorisallbdsstatus', $data);
            $this->load->view('templates/halaman_footer', $data);
        }
    }

    public function cetakLaporanHistorisBdsStatus()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = null;

        $status = $this->session->userdata('status');
        //JIKA
        if ($status == null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-petanikode.pdf";
            $this->pdf->load_view('historis/laporanpdf', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanBdsStatus($status);
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan.pdf";
            $this->pdf->load_view('historis/laporanpdfhistorisbdsstatus', $data);
        }
    }
}
