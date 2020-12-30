<?php

class Role_model extends CI_Model
{
    public function getAllRole()
    {
        $query = $this->db->get('tb_user_role');  // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN SEMUA BARIS
        return $query->result_array();
    }

    public function getRoleById($id_user_role)
    {
        $query = $this->db->get_where('tb_user_role', array('id_user_role' => $id_user_role)); // Produces: SELECT * FROM mytable
        //MENGEMBALIKAN NILAI DENGAN MENAMPILKAN Satu BARIS
        return $query->row_array();
    }

    public function tambahDataRole()
    {
        //MENYIAPKAN DATA YANG AKAN DIINSERT
        $data = array(
            'role' => htmlspecialchars($this->input->post('role', true))
        );

        //QUERY INSERT DATA
        $this->db->insert('tb_user_role', $data);
        // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    }

    public function ubahDataRole()
    {
        $data = array(
            'role' => htmlspecialchars($this->input->post('role', true))
        );

        $this->db->where('id_user_role', $this->input->post('id_user_role'));
        $this->db->update('tb_user_role', $data);
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id
    }

    public function hapusDataRole($id_user_role)
    {
        //QUERY DELETE DATA
        $this->db->delete('tb_user_role', array('id_user_role' => $id_user_role));  // Produces: // DELETE FROM mytable  // WHERE id = $id
    }
}
