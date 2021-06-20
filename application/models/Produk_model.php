<?php 

class Produk_model extends CI_Model {

    private $table = 'tb_produk';

    public function show_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

}

?>
