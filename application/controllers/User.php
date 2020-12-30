<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //MENJALANKAN HELPER FUNCTION CEK LOGIN
        apakah_sudah_login(); //dalam folder helper
        //MEMANGGIL MODEL DI CONSTRUCT
        $this->load->model('User_model');
    }


    public function index()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Profil Saya";
        $data["user"] = $this->User_model->dataSessionUser();

        //MEMANGGIL VIEW HALAMAN LOGIN    
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function editProfil()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Edit Profil";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["gender"] = $this->User_model->dataGender();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM edit profil
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim', [
            'required' => 'Kolom nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_gender', 'Gender', 'required|trim', [
            'required' => 'Harus memilih jenis kelamin!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Kolom email tidak boleh kosong!',
            'valid_email' => 'Yang anda masukkan bukan email!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN LOGIN    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('user/halaman-editprofil', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //JIKA FORM VALIDATIONNYA BENAR
            //KE METHOD YANG ADA DI MODEL
            $this->User_model->ubahDataProfil();
            //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanProfil", "diubah");
            //ALIHKAN HALAMAN
            redirect('user');
        }
    }

    public function ubahPassword()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Password";
        $data["user"] = $this->User_model->dataSessionUser();

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM edit profil
        $this->form_validation->set_rules('password_saatini', 'Password saat ini', 'required|trim', [
            'required' => 'Kolom password saat ini tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password baru', 'required|trim|min_length[6]|matches[password_baru2]', [
            'required' => 'Kolom password baru tidak boleh kosong!',
            'min_length' => 'Password minimal 6 karakter!',
            'matches' => 'Password yang tidak sama!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi password', 'required|trim|min_length[6]|matches[password_baru1]', [
            'required' => 'Kolom konfirmasi password tidak boleh kosong!',
            'min_length' => 'Password minimal 6 karakter!',
            'matches' => 'Password yang tidak sama!'
        ]);


        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN LOGIN    
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('user/halaman-ubahpassword', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else { //JIKA VALIDASI FORM BENAR
            //CEK PASSWORD SAAT INI SAMA TIDAK DENGAN DATABASE
            //TANGKAP PASSWORD SEKARANG DAN PASSWORD BARU
            $passwordSekarang = $this->input->post('password_saatini');
            $passwordBaru = $this->input->post('password_baru1');
            //CEK TIDAK SAMA DENGAN DATABASE
            if (!password_verify($passwordSekarang, $data["user"]["password"])) {
                //KIRIM FLASHDATA
                $this->session->set_flashdata("flashPesanUbahPasswordGagal", "Password lama salah! Gagal mengubah password anda.");
                //ALIHKAN HALAMAN
                redirect('user/ubahPassword');
            } else { //jika password baru == password lama
                if ($passwordSekarang == $passwordBaru) {
                    //KIRIM FLASHDATA
                    $this->session->set_flashdata("flashPesanUbahPasswordGagal", "Gagal mengubah password anda. Password baru tidak boleh sama dengan password lama.");
                    //ALIHKAN HALAMAN
                    redirect('user/ubahPassword');
                } else { //PASSWORD SUDAH OKE
                    //HASH PASSWORD BARU
                    $passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

                    //update data password
                    $this->db->set('password', $passwordHash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_user');
                    //KIRIM FLASHDATA
                    $this->session->set_flashdata("flashPesanUbahPassword", "Berhasil mengubah password anda!");
                    //ALIHKAN HALAMAN
                    redirect('user/ubahPassword');
                }
            }
        }
    }
}
