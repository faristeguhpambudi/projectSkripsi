<?php

class Teknisi_model extends CI_Model
{
    public function tambahDataTindakanKC()
    {
        $user = $this->User_model->dataSessionUser();
        $id_user = $user["id_user"];

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
                    'id_user' => $id_user,
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
                'id_user' => $id_user,
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
}
