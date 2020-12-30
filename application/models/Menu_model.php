<?php

class Menu_model extends CI_Model
{
    public function getAllMenu()
    {
        $query = $this->db->get('tb_user_menu');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getMenuTanpaAdmin()
    {
        return $this->db->get_where('tb_user_menu', 'id_user_menu != 1')->result_array();  // Produces: SELECT * FROM mytable
    }

    public function getMenuById($id_user_menu)
    {

        $query = $this->db->get_where('tb_user_menu', array('id_user_menu' => $id_user_menu)); // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN Satu BARIS
        return $query->row_array();
    }

    public function getSubMenuById($id_user_sub_menu)
    {

        $query = $this->db->get_where('tb_user_sub_menu', array('id_user_sub_menu' => $id_user_sub_menu)); // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN Satu BARIS
        return $query->row_array();
    }

    public function getSubMenu()
    {
        $query = "SELECT `tb_user_sub_menu`.* , `tb_user_menu`.`nama_menu`, `tb_status`.`status`
                    FROM `tb_user_sub_menu` JOIN `tb_user_menu`
                    ON `tb_user_sub_menu`.`id_user_menu` = `tb_user_menu`.`id_user_menu`
                    JOIN `tb_status`
                    ON `tb_user_sub_menu`.`is_active` = `tb_status`.`is_active`
        ";
        return $this->db->query($query)->result_array();
    }

    public function tambahDataMenu()
    {
        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'nama_menu' => htmlspecialchars($this->input->post('nama_menu', true)),
            'controller' => str_replace(' ', '', strtolower(($this->input->post('nama_menu', true))))
        );

        //QUERY INSERT DATA
        $this->db->insert('tb_user_menu', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }

    public function tambahDataSubMenu()
    {
        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'judul' => htmlspecialchars($this->input->post('judul', true)),
            'id_user_menu' => htmlspecialchars($this->input->post('id_user_menu', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true))
        );

        //QUERY INSERT DATA
        $this->db->insert('tb_user_sub_menu', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }

    public function hapusDataMenu($id_user_menu)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_user_menu', array('id_user_menu' => $id_user_menu));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function hapusDataSubMenu($id_user_sub_menu)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_user_sub_menu', array('id_user_sub_menu' => $id_user_sub_menu));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }

    public function ubahDataMenu()
    {
        $data = array(
            'nama_menu' => $this->input->post('nama_menu', true),
            'controller' => str_replace(' ', '', strtolower(($this->input->post('nama_menu', true))))
        );

        $this->db->where('id_user_menu', $this->input->post('id_user_menu'));
        $this->db->update('tb_user_menu', $data);
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id
    }

    public function ubahDataSubMenu()
    {
        //MENYIAPKAN DATA UPDATE
        $data = array(
            'id_user_menu' => htmlspecialchars($this->input->post('id_user_menu', true)),
            'judul' => htmlspecialchars($this->input->post('judul', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true))
        );

        $this->db->where('id_user_sub_menu', $this->input->post('id_user_sub_menu'));
        $this->db->update('tb_user_sub_menu', $data);
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id
    }
}
