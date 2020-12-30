<?php

class User_model extends CI_Model
{

    public function getAllUser()
    {
        $query = "SELECT `tb_user`.*, `tb_kantorcabang`.`nama_kantorcabang`, `tb_user_role`.`role`
                    FROM `tb_user` 
                    JOIN `tb_kantorcabang` ON `tb_user`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_user_role` ON `tb_user`.`id_user_role` = `tb_user_role`.`id_user_role`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getUserById($id_user)
    {
        //MENYIAPKAN QUERY
        $query = "SELECT `tb_user`.*, `tb_gender`.`gender`, `tb_user_role`.`role`, `tb_kantorcabang`.`nama_kantorcabang`
                    FROM `tb_user` 
                    JOIN `tb_gender` ON `tb_user`.`id_gender` = `tb_gender`.`id_gender`
                    JOIN `tb_user_role` ON `tb_user`.`id_user_role` = `tb_user_role`.`id_user_role`
                    JOIN `tb_kantorcabang` ON `tb_user`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    WHERE `tb_user`.`id_user` = $id_user
        ";
        //MENGEMBALIKAN NILAI HASIL SATU BARIS
        return $this->db->query($query)->row_array();
    }

    public function dataGender()
    {
        $query = $this->db->get('tb_gender');  // Produces: SELECT * FROM mytable
        return $query->result_array();
    }

    public function dataRole()
    {
        $query = $this->db->get('tb_user_role');  // Produces: SELECT * FROM mytable
        return $query->result_array();
    }

    //Method untuk mengambil data user yang sedang login
    public function dataSessionUser()
    {
        //SIMPAN DATA SESSION EMAIL KE VARIABEL
        $email = $this->session->userdata('email');

        //MENYIAPKAN QUERY
        $query = "SELECT `tb_user`.*, `tb_gender`.`gender`, `tb_user_role`.`role`, `tb_kantorcabang`.`nama_kantorcabang`
                    FROM `tb_user` 
                    JOIN `tb_gender` ON `tb_user`.`id_gender` = `tb_gender`.`id_gender`
                    JOIN `tb_user_role` ON `tb_user`.`id_user_role` = `tb_user_role`.`id_user_role`
                    JOIN `tb_kantorcabang` ON `tb_user`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    WHERE `tb_user`.`email` = '$email'
        ";
        //MENGEMBALIKAN NILAI HASIL SATU BARIS
        return $this->db->query($query)->row_array();
    }

    public function ubahDataProfil()
    {
        $data["useredit"] = $this->User_model->dataSessionUser();
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto_profil"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/profil/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto_profil')) {
                $fotoLama = $data["useredit"]["foto_profil"];
                if ($fotoLama != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profil/' . $fotoLama);
                }

                $fotoBaru = $this->upload->data('file_name');
                $this->db->set('foto_profil', $fotoBaru);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        }

        //JIKA GAADA GAMBAR YANG DIUPLOAD
        //JALANKAN QUERY UPDATE DATA
        $nama = $this->input->post('nama_lengkap');
        $gender = $this->input->post('id_gender');
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $this->db->set('nama_lengkap', $nama);
        $this->db->set('email', $email);
        $this->db->set('id_gender', $gender);
        $this->db->set('telepon', $telepon);
        $this->db->set('alamat', $alamat);
        $this->db->where('email', $email);
        $this->db->update('tb_user');
    }

    public function tambahDataUser()
    {
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto_profil"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/profil/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto_profil')) {
                $fotoBaru = $this->upload->data('file_name');

                //MENYIAPKAN DATA YANG AKAN DIINSERT
                $data = array(
                    'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                    'id_kantorcabang' => htmlspecialchars($this->input->post('id_kantorcabang', true)),
                    'id_gender' => htmlspecialchars($this->input->post('id_gender', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'telepon' => htmlspecialchars($this->input->post('telepon', true)),
                    'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                    'foto_profil' => $fotoBaru,
                    'password' => password_hash('123456', PASSWORD_DEFAULT),
                    'id_user_role' => $this->input->post('id_user_role'),
                    'is_active' => 1,
                    'date_created' => time()
                );

                //QUERY INSERT DATA
                $this->db->insert('tb_user', $data);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        } else {
            //JIKA GAADA GAMBAR YANG DIUPLOAD 
            //MENYIAPKAN DATA YANG AKAN DIINSERT
            $data2 = array(
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'id_kantorcabang' => htmlspecialchars($this->input->post('id_kantorcabang', true)),
                'id_gender' => htmlspecialchars($this->input->post('id_gender', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'telepon' => htmlspecialchars($this->input->post('telepon', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'foto_profil' => 'default.jpg',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'id_user_role' => $this->input->post('id_user_role'),
                'is_active' => 1,
                'date_created' => time()
            );

            //QUERY INSERT DATA
            $this->db->insert('tb_user', $data2);
            // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
        }
    }

    public function hapusDataUser($id_user)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_user', array('id_user' => $id_user));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataUser()
    {
        $id = $this->input->post('id_user');
        $data["userbyid"] = $this->User_model->getUserById($id);
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto_profil"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/profil/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto_profil')) {
                $fotoLama = $data["userbyid"]["foto_profil"];
                if ($fotoLama != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profil/' . $fotoLama);
                }

                $fotoBaru = $this->upload->data('file_name');
                $this->db->set('foto_profil', $fotoBaru);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        }

        //JIKA GAADA GAMBAR YANG DIUPLOAD
        //JALANKAN QUERY UPDATE DATA
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama_lengkap');
        $gender = $this->input->post('id_gender');
        $id_kantorcabang = $this->input->post('id_kantorcabang');
        $id_user_role = $this->input->post('id_user_role');
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $this->db->set('nama_lengkap', $nama);
        $this->db->set('email', $email);
        $this->db->set('id_gender', $gender);
        $this->db->set('id_kantorcabang', $id_kantorcabang);
        $this->db->set('id_user_role', $id_user_role);
        $this->db->set('telepon', $telepon);
        $this->db->set('alamat', $alamat);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user');
    }
}
