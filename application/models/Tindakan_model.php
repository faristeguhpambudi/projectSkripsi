<?php

class Tindakan_model extends CI_Model
{
    public function getAllTindakanByKC($idKC)
    {
        $query = "SELECT `tb_tindakan`.*, `tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*
                    FROM `tb_tindakan` 
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    WHERE `tb_perangkat`.`id_kantorcabang` = $idKC
                    ORDER BY `tb_tindakan`.`tgl_tindakan` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function cariDataTindakanforLaporanKC($idKC)
    {
        //AMBIL DATA DARI POST
        $tanggalmulai = $this->input->post("tanggalmulai");
        $tanggalselesai = $this->input->post("tanggalselesai");

        $query = "SELECT `tb_tindakan`.*, `tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*
                    FROM `tb_tindakan` 
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    WHERE `tb_perangkat`.`id_kantorcabang` = $idKC AND tgl_tindakan BETWEEN '$tanggalmulai' AND '$tanggalselesai'
                    ORDER BY `tb_tindakan`.`tgl_tindakan` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function cariDataTindakanforLaporan2($idKC)
    {
        //AMBIL DATA DARI POST
        $tanggalmulai = $this->session->userdata('tanggalmulai');
        $tanggalselesai = $this->session->userdata('tanggalselesai');

        //buat query
        $query = "SELECT `tb_tindakan`.*, `tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*
                    FROM `tb_tindakan` 
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    WHERE `tb_perangkat`.`id_kantorcabang` = $idKC AND tgl_tindakan BETWEEN '$tanggalmulai' AND '$tanggalselesai'
                    ORDER BY `tb_tindakan`.`tgl_tindakan` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }


    public function getTindakanById($id_tindakan)
    {
        //MENYIAPKAN QUERY
        $query = "SELECT `tb_tindakan`.*, `tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*
                    FROM `tb_tindakan` 
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    WHERE `tb_tindakan`.`id_tindakan` = $id_tindakan
        ";
        //MENGEMBALIKAN NILAI HASIL SATU BARIS
        return $this->db->query($query)->row_array();
    }

    public function getAllTeknisiByKC($idKC)
    {
        $query = "SELECT * FROM `tb_user`
                    WHERE `id_kantorcabang` = $idKC AND `id_user_role` = '3'
        ";
        return $this->db->query($query)->result_array();
    }

    public function tambahDataTindakanKC()
    {
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["bukti_tindakan"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/bukti/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('bukti_tindakan')) {
                $fotoBaru = $this->upload->data('file_name');

                //MENYIAPKAN DATA YANG AKAN DIINSERT
                $data = array(
                    'kode_tindakan' => htmlspecialchars($this->input->post('kode_tindakan', true)),
                    'id_user' => htmlspecialchars($this->input->post('id_user', true)),
                    'id_perangkat' => htmlspecialchars($this->input->post('id_perangkat', true)),
                    'tgl_tindakan' => htmlspecialchars($this->input->post('tgl_tindakan', true)),
                    'desk_masalah' => htmlspecialchars($this->input->post('desk_masalah', true)),
                    'desk_tindakan' => htmlspecialchars($this->input->post('desk_tindakan', true)),
                    'bukti_tindakan' => $fotoBaru,
                    'date_created' => time()
                );

                //QUERY INSERT DATA
                $this->db->insert('tb_tindakan', $data);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        } else {
            //JIKA GAADA GAMBAR YANG DIUPLOAD 
            //MENYIAPKAN DATA YANG AKAN DIINSERT
            $data2 = array(
                'kode_tindakan' => htmlspecialchars($this->input->post('kode_tindakan', true)),
                'id_user' => htmlspecialchars($this->input->post('id_user', true)),
                'id_perangkat' => htmlspecialchars($this->input->post('id_perangkat', true)),
                'tgl_tindakan' => htmlspecialchars($this->input->post('tgl_tindakan', true)),
                'desk_masalah' => htmlspecialchars($this->input->post('desk_masalah', true)),
                'desk_tindakan' => htmlspecialchars($this->input->post('desk_tindakan', true)),
                'bukti_tindakan' => 'file.png',
                'date_created' => time()
            );

            //QUERY INSERT DATA
            $this->db->insert('tb_tindakan', $data2);
            // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
        }
    }

    public function hapusDataTindakan($id_tindakan)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_tindakan', array('id_tindakan' => $id_tindakan));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataTindakanKC()
    {
        $id_tindakan = $this->input->post('id_tindakan');
        $data["tindakanbyid"] = $this->Tindakan_model->getTindakanById($id_tindakan);
        //CEK JIKA ADA GAMBAR YANG DIUPLOAD
        $uploadGambar = $_FILES["bukti_tindakan"]["name"];
        if ($uploadGambar) {
            //SETTING SYARAT GAMBAR
            $config['upload_path'] = './assets/img/bukti/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            //JIKA MEMENUHI SYARAT GAMBAR
            if ($this->upload->do_upload('bukti_tindakan')) {
                $fotoLama = $data["tindakanbyid"]["bukti_tindakan"];
                if ($fotoLama != 'file.png') {
                    unlink(FCPATH . 'assets/img/bukti/' . $fotoLama);
                }

                $fotoBaru = $this->upload->data('file_name');
                $this->db->set('bukti_tindakan', $fotoBaru);
            } else { //JIKA TIDAK MEMENUHI SYARAT GAMBAR
                echo $this->upload->display_errors();
            }
        }

        //JIKA GAADA GAMBAR YANG DIUPLOAD
        //JALANKAN QUERY UPDATE DATA
        $id_tindakan = $this->input->post('id_tindakan');
        $kode_tindakan = $this->input->post('kode_tindakan');
        $id_user = $this->input->post('id_user');
        $id_perangkat = $this->input->post('id_perangkat');
        $tgl_tindakan = $this->input->post('tgl_tindakan');
        $desk_masalah = $this->input->post('desk_masalah');
        $desk_tindakan = $this->input->post('desk_tindakan');
        $this->db->set('id_tindakan', $id_tindakan);
        $this->db->set('kode_tindakan', $kode_tindakan);
        $this->db->set('id_user', $id_user);
        $this->db->set('id_perangkat', $id_perangkat);
        $this->db->set('tgl_tindakan', $tgl_tindakan);
        $this->db->set('desk_masalah', $desk_masalah);
        $this->db->set('desk_tindakan', $desk_tindakan);
        $this->db->where('id_tindakan', $id_tindakan);
        $this->db->update('tb_tindakan');
    }
}
