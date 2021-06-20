<?php 

class Produk_model extends CI_Model {

    private $table = 'tb_produk';

    public function lihat_semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_tunggal($id)
    {
        $query = $this->db->get_where($this->table, ['id_produk' => $id]);
        return $query->row();
    }

}

?>
