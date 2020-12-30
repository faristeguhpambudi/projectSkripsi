<?php

class Historis_model extends CI_Model
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


    public function getAllHistoris()
    {
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function cariDataHistorisforLaporanBdsCabang($id_kantorcabang)
    {

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE `tb_perangkat`.`id_kantorcabang` = $id_kantorcabang
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }


    public function cariDataHistorisforLaporanBdsKategori($id_kategori)
    {

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE `tb_perangkat`.`id_kategori` = $id_kategori
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }

    public function cariDataHistorisforLaporanBdsStatus($status)
    {

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE `tb_historis`.`status_perangkat` = $status
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }


    public function cariDataHistorisforLaporan()
    {
        //AMBIL DATA DARI POST
        $tanggalmulai = $this->input->post("tanggalmulai");
        $tanggalselesai = $this->input->post("tanggalselesai");

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE tgl_historis BETWEEN '$tanggalmulai' AND '$tanggalselesai'
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }

    public function cariDataHistorisforLaporan2()
    {
        //AMBIL DATA DARI POST
        $tanggalmulai = $this->session->userdata('tanggalmulai');
        $tanggalselesai = $this->session->userdata('tanggalselesai');

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE tgl_historis BETWEEN '$tanggalmulai' AND '$tanggalselesai'
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }

    public function getAllHistorisByKC($idKC)
    {
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`                    
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE `tb_user`.`id_kantorcabang` = $idKC
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function cariDataHistorisforLaporanKC($idKC)
    {
        //AMBIL DATA DARI POST
        $tanggalmulai = $this->input->post("tanggalmulai");
        $tanggalselesai = $this->input->post("tanggalselesai");

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE `tb_user`.`id_kantorcabang` = $idKC AND tgl_historis BETWEEN '$tanggalmulai' AND '$tanggalselesai'
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }

    public function cariDataHistorisforLaporan3($idKC)
    {
        //AMBIL DATA DARI POST
        $tanggalmulai = $this->session->userdata('tanggalmulai');
        $tanggalselesai = $this->session->userdata('tanggalselesai');

        //buat query
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*, `tb_status_historis`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    JOIN `tb_status_historis` ON `tb_historis`.`status_perangkat` = `tb_status_historis`.`status_perangkat`
                    WHERE `tb_user`.`id_kantorcabang` = $idKC AND tgl_historis BETWEEN '$tanggalmulai' AND '$tanggalselesai'
                    ORDER BY `tb_historis`.`tgl_historis` ASC
        ";

        //jalanin query
        return $this->db->query($query)->result_array();
    }

    public function getHistorisById($id_historis)
    {
        $query = "SELECT `tb_historis`.*, `tb_tindakan`.*,`tb_perangkat`.*, `tb_kategori_perangkat`.`nama_kategori`, `tb_user`.*, `tb_kantorcabang`.*
                    FROM `tb_historis` 
                    JOIN `tb_tindakan` ON `tb_historis`.`id_tindakan` = `tb_tindakan`.`id_tindakan`
                    JOIN `tb_perangkat` ON `tb_tindakan`.`id_perangkat` = `tb_perangkat`.`id_perangkat`
                    JOIN `tb_kategori_perangkat` ON `tb_perangkat`.`id_kategori` = `tb_kategori_perangkat`.`id_kategori`
                    JOIN `tb_user` ON `tb_tindakan`.`id_user` = `tb_user`.`id_user`
                    JOIN `tb_kantorcabang` ON `tb_perangkat`.`id_kantorcabang` = `tb_kantorcabang`.`id_kantorcabang`
                    WHERE `tb_historis`.`id_historis` = $id_historis
        ";
        return $this->db->query($query)->row_array();
    }

    public function tambahDataHistorisKC()
    {

        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'tgl_historis' => htmlspecialchars($this->input->post('tgl_historis', true)),
            'id_tindakan' => htmlspecialchars($this->input->post('id_tindakan', true)),
            'status_perangkat' => htmlspecialchars($this->input->post('status_perangkat', true)),
            'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
            'biaya' => htmlspecialchars($this->input->post('biaya', true))
        );
        //QUERY INSERT DATA
        $this->db->insert('tb_historis', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }

    public function hapusDataHistoris($id_historis)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_historis', array('id_historis' => $id_historis));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataHistorisKC()
    {
        //JALANKAN QUERY UPDATE DATA
        $id_historis = $this->input->post('id_historis');
        $tgl_historis = $this->input->post('tgl_historis');
        $id_tindakan = $this->input->post('id_tindakan');
        $status_perangkat = $this->input->post('status_perangkat');
        $deskripsi = $this->input->post('deskripsi');
        $biaya = $this->input->post('biaya');
        $this->db->set('tgl_historis', $tgl_historis);
        $this->db->set('id_tindakan', $id_tindakan);
        $this->db->set('status_perangkat', $status_perangkat);
        $this->db->set('deskripsi', $deskripsi);
        $this->db->set('biaya', $biaya);
        $this->db->where('id_historis', $id_historis);
        $this->db->update('tb_historis');
    }
}
