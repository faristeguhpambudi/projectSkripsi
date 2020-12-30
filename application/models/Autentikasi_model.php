<?php

class Autentikasi_model extends CI_Model
{

    public function cekLogin()
    {
        //AMBIL DATA DARI FORM LOGIN
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //QUERY DATA USER YANG ADA DI TABEL USER // AMBIL SATU BARIS
        $user = $this->db->get_where('tb_user', array('email' => $email))->row_array();

        //JIKA DATA USERNYA ADA
        if ($user) {
            //JIKA USERNYA AKTIF
            if ($user["is_active"] == 1) {
                //CEK PASSWORDNYA, JIKA PASSWORD BENAR
                if (password_verify($password, $user["password"])) {
                    //MENYIAPKAN DATA USER (EMAIL&ROLEID)
                    $data = [
                        'password' => $user["password"],
                        'email' => $user["email"],
                        'id_user_role' => $user["id_user_role"]
                    ];
                    //MENYIMPAN DATA KE SESSION
                    $this->session->set_userdata($data);

                    //CEK DULU ROLENYA BERAPA
                    if ($user["id_user_role"] == 1) {
                        //ALIHKAN KE HALAMAN ADMIN
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else { //JIKA PASSWORDNYA SALAH
                    //KIRIM FLASDATA
                    $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Password yang anda masukkan salah!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    //ALIHKAN HALMAN
                    redirect('autentikasi');
                }
            } else { //JIKA USERNYA TIDAK AKTIF
                //KIRIM FLASHDATA
                $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Akun anda belum diaktivasi!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                //ALIHKAN HALAMAN
                redirect('Autentikasi');
            }
        } else { //JIKA DATA USERNYA TIDAK ADA
            //KIRIM FLASHDATA
            $this->session->set_flashdata('pesanAutentikasi', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Email yang anda masukkan tidak terdaftar!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            //ALIHKAN HALAMAN
            redirect('Autentikasi');
        }
    }

    public function tambahDataUser()
    {
        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'foto_profil' => 'default.jpg',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'id_user_role' => 2,
            'is_active' => 1,
            'date_created' => time()
        );

        //QUERY INSERT DATA
        $this->db->insert('tb_user', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }
}
