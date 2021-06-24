<?php 

class Brand_model extends CI_Model {

    private $table = 'tb_brand';

    public function lihat_semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_tunggal($id)
    {
        $query = $this->db->get_where($this->table, ['id_brand' => $id]);
        return $query->row();
    }

    public function lihat_nama_brand($id)
    {
        $this->db->select('nama');
        $query = $this->db->get_where($this->table, ['id_brand' => $id]);
        return $query->row()->nama;
    }

    public function tambah_brand($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function sunting_brand($id, $data)
    {
        $this->db->where('id_brand', $id);
        return $this->db->update($this->table, $data);
    }

}

?>
