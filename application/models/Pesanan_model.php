<?php 

class Pesanan_model extends CI_Model {

    private $table = 'tb_pesanan';

    public function lihat_semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_tunggal($id)
    {
        $query = $this->db->get_where($this->table, ['id_pesanan' => $id]);
        return $query->row();
    }

    public function lihat($selected, $keyname, $key)
    {
        $this->db->select($selected);
        $this->db->from($this->table);
        $this->db->where($keyname, $key);
        return $this->db->get()->row();
    }

    public function lihat_dari($id)
    {
        $query = $this->db->get_where($this->table, ['id_pelanggan' => $id]);
        return $query->result();
    }

    function baru($data){
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        // Mengembalikan id dari data yang baru saja dimasukkan
        return $id;
    }


}

?>
