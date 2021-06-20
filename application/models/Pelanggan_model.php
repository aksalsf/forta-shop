<?php 

class Pelanggan_model extends CI_Model {

    private $table = 'tb_pelanggan';

    public function lihat($selected, $keyname, $key)
    {
        $this->db->select($selected);
        $this->db->from($this->table);
        $this->db->where($keyname, $key);
        return $this->db->get()->row();
    }

}

?>
