<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //MEMANGGIL MODEL DI CONSTRUCT
        $this->load->model('Autentikasi_model');
    }

    public function index()
    {
        //CEK APAKAH SUDAH LOGIN
        //JIKA ADA SESSION EMAIL
        if ($this->session->userdata('email')) {
            //TENDANG KE HALAMAN LOGIN
            redirect('user');
        }
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Halaman Login";

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM VALIDASI
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Kolom email tidak boleh kosong! isi dengan email akun anda.',
            'valid_email' => 'Yang anda masukkan bukan email!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Kolom password tidak boleh kosong! Isi dengan password akun anda.'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN LOGIN
            $this->load->view('templates/autentikasi_header', $data);
            $this->load->view('autentikasi/halaman_login');
            $this->load->view('templates/autentikasi_footer');
        } else { //JIKA VALIDASINYA SUKSES
            $this->Autentikasi_model->cekLogin();
        }
    }

    public function buatAkun()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Halaman Buat Akun";

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM VALIDASI
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim', [
            'required' => 'Kolom nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'required' => 'Kolom email tidak boleh kosong!',
            'valid_email' => 'Yang anda masukkan bukan email!',
            'is_unique' => 'Email ini sudah pernah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Kolom password tidak boleh kosong!',
            'min_length' => 'Password minimal 6 karakter!',
            'matches' => 'Password yang tidak sama!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN BUAT AKUN
            $this->load->view('templates/autentikasi_header', $data);
            $this->load->view('autentikasi/halaman_buatakun');
            $this->load->view('templates/autentikasi_footer');
        } else { //JIKA FORM VALIDASINYA BENAR
            //KE METHOD YANG ADA DI MODEL
            $this->Autentikasi_model->tambahDataUser();
            //KIRIM FLASHDATA
            $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat! Akun anda berhasil dibuat. silahkan Login!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            //ALIHKAN HALAMAN
            redirect('Autentikasi');
        }
    }

    public function logOut()
    {
        //MEMBERSIHKAN DATA SESSION
        $this->session->unset_userdata("email");
        $this->session->unset_userdata("id_user_role");

        //KIRIM FLASHDATA
        $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Anda Baru saja logout!</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        //ALIHKAN HALAMAN
        redirect('autentikasi');
    }

    public function blokAkses()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Akses Blok";
        //MEMANGGIL VIEW HALAMAN AKSES BLOK
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('autentikasi/halaman_blokakses');
        $this->load->view('templates/halaman_footer');
    }

    private function _sendEmail($token, $type)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sisteminventarispj@gmail.com',
            'smtp_pass' => 'Sayangaudra16',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('sisteminventarispj@gmail.com', 'Sistem Informasi inventaris Perangkat Jaringan');
        $this->email->to($this->input->post('email'));
        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link ini untuk memulai proses reset password anda : <a href="' . base_url() . 'Autentikasi/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function lupaPassword()
    {
        //CEK APAKAH SUDAH LOGIN
        //JIKA ADA SESSION EMAIL
        if ($this->session->userdata('email')) {
            //TENDANG KE HALAMAN LOGIN
            redirect('user');
        }
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Halaman Lupa Password";

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM VALIDASI
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Kolom email tidak boleh kosong!',
            'valid_email' => 'Yang anda masukkan bukan email!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN LUPA PASSWORD
            $this->load->view('templates/autentikasi_header', $data);
            $this->load->view('autentikasi/halaman_lupapassword');
            $this->load->view('templates/autentikasi_footer');
        } else { //JIKA VALIDASINYA SUKSES
            //MENANGKAP EMAIL DARI USER
            $email = $this->input->post('email');
            //QUERY USER BERDSRKN EMAIL & ISACTIVE
            $user = $this->db->get_where('tb_user', ['email' => $email, 'is_active' => 1])->row_array();

            //CEK JIKA QUERY USERNYA ADA
            if ($user) {
                //BUAT TOKEN BILANGAN RANDOM
                $token = base64_encode(random_bytes(32));

                //SIAPKAN ARRAY TOKEN
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                //INSERT KE DATABASE
                $this->db->insert('tb_user_token', $user_token);

                //jalankan fungsi kirim email
                $this->_sendEmail($token, 'forgot');

                //KIRIM FLASHDATA
                $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sebuah email telah dikirim ke' . $email . '. Cek email untuk mulai proses reset password.</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                //ALIHKAN HALAMAN
                redirect('autentikasi/lupaPassword');
            } else { //JIKA QUERY USER GAADA
                //KIRIM FLASHDATA
                $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Email ini tidak terdaftar di dalam sistem!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                //ALIHKAN HALAMAN
                redirect('autentikasi/lupaPassword');
            }
        }
    }

    public function resetPassword()
    {
        //AMBIL DATA YANG DIKIRIM LEWAT URL
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        //CEK APAKAH EMAIL TSB ADA DI DATABASE
        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

        //JIKA ADA 
        if ($user) {
            //CEK TOKEN
            //QUERY DATA TOKEN DATABASE
            $userToken = $this->db->get_where('tb_user_token', ['token' => $token])->row_array();
            //JIKA ADA
            if ($userToken) {
                //JIKA ADA
                //BUAT SESSION
                $this->session->set_userdata('resetPassword', $email);
                //ALIHKAN KE FUNGSI UBAH PASSWORD
                $this->ubahPassword();
            } else { //KALO GAADA
                //KIRIM FLASHDATA
                $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Reset password gagal! Token salah!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                //ALIHKAN HALAMAN
                redirect('autentikasi');
            }
        } else { //Jika gaada usernya
            //KIRIM FLASHDATA
            $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Reset password gagal! Email salah!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            //ALIHKAN HALAMAN
            redirect('autentikasi');
        }
    }

    public function ubahPassword()
    {
        //CEK TIDAKA ADA SESSION RESET
        if (!$this->session->userdata('resetPassword')) {
            redirect('Autentikasi');
        }
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Password";

        $this->form_validation->set_rules('password1', 'Password baru', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Kolom password baru tidak boleh kosong! Silahkan isi sesuai keinginan anda.',
            'min_length' => 'Password yang anda masukkan terlalu pendek. Panjang Password minimal 6 karakter!',
            'matches' => 'Password yang anda input tidak sama! Samakan dengan kolom konfirmasi password.'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|trim|min_length[6]|matches[password1]', [
            'required' => 'Kolom password baru tidak boleh kosong! Silahkan isi sesuai keinginan anda.',
            'min_length' => 'Password yang anda masukkan terlalu pendek. Panjang Password minimal 6 karakter!',
            'matches' => 'Password yang anda input tidak sama! Samakan dengan kolom password baru.'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN UBAH PASSWORD
            $this->load->view('templates/autentikasi_header', $data);
            $this->load->view('autentikasi/halaman_ubahpassword', $data);
            $this->load->view('templates/autentikasi_footer', $data);
        } else { //JIKA VALIDASI FORM BENAR
            //ENKRIPSI PASSWORD
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            //AMBIL DATA EMAI DI SESSION RESET
            $email = $this->session->userdata('resetPassword');

            //QUERY UPDATE DATABASE PASSWORD USER
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('tb_user');

            //HAPUS DATA TOKEN
            $this->db->delete('tb_user_token', ['email' => $email]);

            //BERSIHKAN SESSION RESET PASSWORD
            $this->session->unset_userdata('resetPassword');


            //KIRIM FLASHDATA
            $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password anda berhasil diubah! Silahkan Login!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            //ALIHKAN HALAMAN
            redirect('autentikasi');
        }
    }
}
