<?php

class KantorCabang_model extends CI_Model
{
    public function getAllKantorCabang()
    {
        $query = $this->db->get('tb_kantorcabang');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getAllStatus()
    {
        $query = $this->db->get('tb_status_historis');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getAllKategori()
    {
        $query = $this->db->get('tb_kategori_perangkat');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getKCById($id_kantorcabang)
    {

        $query = $this->db->get_where('tb_kantorcabang', array('id_kantorcabang' => $id_kantorcabang)); // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN Satu BARIS
        return $query->row_array();
    }

    public function tambahDataKC()
    {
        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'kode_cabang' => htmlspecialchars($this->input->post('kode_cabang', true)),
            'nama_kantorcabang' => htmlspecialchars($this->input->post('nama_kantorcabang', true))
        );

        //QUERY INSERT DATA
        $this->db->insert('tb_kantorcabang', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }

    public function hapusDataKC($id_kantorcabang)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_kantorcabang', array('id_kantorcabang' => $id_kantorcabang));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataKC()
    {
        $data = array(
            'kode_cabang' => htmlspecialchars($this->input->post('kode_cabang', true)),
            'nama_kantorcabang' => htmlspecialchars($this->input->post('nama_kantorcabang', true))
        );

        $this->db->where('id_kantorcabang', $this->input->post('id_kantorcabang'));
        $this->db->update('tb_kantorcabang', $data);
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id
    }
}
