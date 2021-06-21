<?php 

class Pelanggan_model extends CI_Model {

    private $table = 'tb_pelanggan';

    public function lihat_semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_tunggal($surel)
    {
        $query = $this->db->get_where($this->table, ['surel' => $surel]);
        return $query->row();
    }

    public function lihat($selected, $keyname, $key)
    {
        $this->db->select($selected);
        $this->db->from($this->table);
        $this->db->where($keyname, $key);
        return $this->db->get()->row();
    }

    public function daftar($data)
    {
        return $this->db->insert($this->table, $data);
    }

}

?>
