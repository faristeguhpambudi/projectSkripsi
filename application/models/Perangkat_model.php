<?php

class Perangkat_model extends CI_Model
{
    public function getAllKantorCabang()
    {
        $query = $this->db->get('tb_kantorcabang');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getAllSwitch()
    {
        $query = "SELECT `tb_perangkat`.*, `tb_kantorcabang`.*
                    FROM `tb_perangkat` 
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    WHERE `tb_perangkat`.`id_kategori` = 1
        ";
        return $this->db->query($query)->result_array();
    }

    public function getAllRouter()
    {
        $query = "SELECT `tb_perangkat`.*, `tb_kantorcabang`.*
                    FROM `tb_perangkat` 
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    WHERE `tb_perangkat`.`id_kategori` = 2
        ";
        return $this->db->query($query)->result_array();
    }


    public function getAllKategori()
    {
        $query = $this->db->get('tb_kategori_perangkat');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getKategoriById($id_kategori)
    {

        $query = $this->db->get_where('tb_kategori_perangkat', array('id_kategori' => $id_kategori)); // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN Satu BARIS
        return $query->row_array();
    }

    public function getPerangkatById($id_perangkat)
    {
        //MENYIAPKAN QUERY
        $query = "SELECT `tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_kantorcabang`.`nama_kantorcabang`
                    FROM `tb_perangkat` 
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    WHERE `tb_perangkat`.`id_perangkat` = $id_perangkat
        ";
        //MENGEMBALIKAN NILAI HASIL SATU BARIS
        return $this->db->query($query)->row_array();
    }

    public function getAllPerangkatByKC($idKC)
    {
        $query = "SELECT `tb_perangkat`.*, `tb_kantorcabang`.`nama_kantorcabang`, `tb_kategori_perangkat`.`nama_kategori`
                    FROM `tb_perangkat` 
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    WHERE `tb_perangkat`.`id_kantorcabang` = $idKC
        ";
        return $this->db->query($query)->result_array();
    }


    public function tambahDataPerangkat()
    {
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/perangkat/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto')) {
                $fotoBaru = $this->upload->data('file_name');

                //MENYIAPKAN DATA YANG AKAN DIINSERT
                $data = array(
                    'id_perangkat' => htmlspecialchars($this->input->post('id_perangkat', true)),
                    'id_kategori' => htmlspecialchars($this->input->post('id_kategori', true)),
                    'id_kantorcabang' => htmlspecialchars($this->input->post('id_kantorcabang', true)),
                    'serial_number' => htmlspecialchars($this->input->post('serial_number', true)),
                    'end_of_life' => htmlspecialchars($this->input->post('end_of_life', true)),
                    'end_of_sale' => htmlspecialchars($this->input->post('end_of_sale', true)),
                    'last_date_support' => htmlspecialchars($this->input->post('last_date_support', true)),
                    'foto' => $fotoBaru,
                    'tgl_input' => time()
                );

                //QUERY INSERT DATA
                $this->db->insert('tb_perangkat', $data);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        } else {
            //JIKA GAADA GAMBAR YANG DIUPLOAD 
            //MENYIAPKAN DATA YANG AKAN DIINSERT
            $data2 = array(
                'id_perangkat' => htmlspecialchars($this->input->post('id_perangkat', true)),
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori', true)),
                'id_kantorcabang' => htmlspecialchars($this->input->post('id_kantorcabang', true)),
                'serial_number' => htmlspecialchars($this->input->post('serial_number', true)),
                'end_of_life' => htmlspecialchars($this->input->post('end_of_life', true)),
                'end_of_sale' => htmlspecialchars($this->input->post('end_of_sale', true)),
                'last_date_support' => htmlspecialchars($this->input->post('last_date_support', true)),
                'foto' => "file.png",
                'tgl_input' => time()
            );

            //QUERY INSERT DATA
            $this->db->insert('tb_perangkat', $data2);
            // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
        }
    }

    public function tambahDataPerangkatKC($idKC)
    {
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/perangkat/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto')) {
                $fotoBaru = $this->upload->data('file_name');

                //MENYIAPKAN DATA YANG AKAN DIINSERT
                $data = array(
                    'id_kategori' => htmlspecialchars($this->input->post('id_kategori', true)),
                    'id_kantorcabang' => $idKC,
                    'serial_number' => htmlspecialchars($this->input->post('serial_number', true)),
                    'end_of_life' => $this->input->post('end_of_life'),
                    'end_of_sale' => $this->input->post('end_of_sale'),
                    'last_date_support' => $this->input->post('last_date_support'),
                    'foto' => $fotoBaru,
                    'tgl_input' => time()
                );

                //QUERY INSERT DATA
                $this->db->insert('tb_perangkat', $data);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        } else {
            //JIKA GAADA GAMBAR YANG DIUPLOAD 
            //MENYIAPKAN DATA YANG AKAN DIINSERT
            $data2 = array(
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori', true)),
                'id_kantorcabang' => $idKC,
                'serial_number' => htmlspecialchars($this->input->post('serial_number', true)),
                'end_of_life' => $this->input->post('end_of_life'),
                'end_of_sale' => $this->input->post('end_of_sale'),
                'last_date_support' => $this->input->post('last_date_support'),
                'foto' => "file.png",
                'tgl_input' => time()
            );

            //QUERY INSERT DATA
            $this->db->insert('tb_perangkat', $data2);
            // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
        }
    }

    public function hapusDataPerangkat($id_perangkat)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_perangkat', array('id_perangkat' => $id_perangkat));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataPerangkat()
    {
        $id = $this->input->post('id_perangkat');
        $data["perangkatbyid"] = $this->Perangkat_model->getPerangkatById($id);
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/perangkat/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto')) {
                $fotoLama = $data["perangkatbyid"]["foto"];
                if ($fotoLama != 'file.png') {
                    unlink(FCPATH . 'assets/img/perangkat/' . $fotoLama);
                }

                $fotoBaru = $this->upload->data('file_name');
                $this->db->set('foto', $fotoBaru);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        }

        //JIKA GAADA GAMBAR YANG DIUPLOAD
        //JALANKAN QUERY UPDATE DATA
        $id_perangkat = $this->input->post('id_perangkat');
        $id_kategori = $this->input->post('id_kategori');
        $id_kantorcabang = $this->input->post('id_kantorcabang');
        $serial_number = $this->input->post('serial_number');
        $end_of_life = $this->input->post('end_of_life');
        $end_of_sale = $this->input->post('end_of_sale');
        $last_date_support = $this->input->post('last_date_support');
        $this->db->set('id_kategori', $id_kategori);
        $this->db->set('id_kantorcabang', $id_kantorcabang);
        $this->db->set('serial_number', $serial_number);
        $this->db->set('end_of_life', $end_of_life);
        $this->db->set('end_of_sale', $end_of_sale);
        $this->db->set('last_date_support', $last_date_support);
        $this->db->where('id_perangkat', $id_perangkat);
        $this->db->update('tb_perangkat');
    }

    public function ubahDataPerangkatKC($idKC)
    {
        $id = $this->input->post('id_perangkat');
        $data["perangkatbyid"] = $this->Perangkat_model->getPerangkatById($id);
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["foto"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/perangkat/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('foto')) {
                $fotoLama = $data["perangkatbyid"]["foto"];
                if ($fotoLama != 'file.png') {
                    unlink(FCPATH . 'assets/img/perangkat/' . $fotoLama);
                }

                $fotoBaru = $this->upload->data('file_name');
                $this->db->set('foto', $fotoBaru);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        }

        //JIKA GAADA GAMBAR YANG DIUPLOAD
        //JALANKAN QUERY UPDATE DATA
        $id_perangkat = $this->input->post('id_perangkat');
        $serial_number = $this->input->post('serial_number');
        $id_kategori = $this->input->post('id_kategori');
        $id_kantorcabang = $idKC;
        $end_of_life = $this->input->post('end_of_life');
        $end_of_sale = $this->input->post('end_of_sale');
        $last_date_support = $this->input->post('last_date_support');
        $this->db->set('serial_number', $serial_number);
        $this->db->set('id_kategori', $id_kategori);
        $this->db->set('id_kantorcabang', $id_kantorcabang);
        $this->db->set('end_of_life', $end_of_life);
        $this->db->set('end_of_sale', $end_of_sale);
        $this->db->set('last_date_support', $last_date_support);
        $this->db->where('id_perangkat', $id_perangkat);
        $this->db->update('tb_perangkat');
    }

    public function tambahDataKategori()
    {
        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', true))
        );

        //QUERY INSERT DATA
        $this->db->insert('tb_kategori_perangkat', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }

    public function hapusDataKategori($id_kategori)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_kategori_perangkat', array('id_kategori' => $id_kategori));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataKategori()
    {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori', true)
        );

        $this->db->where('id_kategori', $this->input->post('id_kategori'));
        $this->db->update('tb_kategori_perangkat', $data);
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id
    }
}
