<?php 

class Admin_model extends CI_Model {

    private $table = 'tb_admin';

    public function login($nama_pengguna)
    {
        $query = $this->db->get_where($this->table, ['nama_pengguna' => $nama_pengguna]);
        return $query->row();
    }

}

?>
