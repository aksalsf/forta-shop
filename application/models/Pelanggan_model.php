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

    public function lihat_dari_id($id_pelanggan)
    {
        $query = $this->db->get_where($this->table, ['id_pelanggan' => $id_pelanggan]);
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

    public function verifikasi($id_pelanggan, $status)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->update($this->table, ['status' => $status]);
    }

    public function update_profil($id, $data)
    {
        $this->db->where('id_pelanggan', $id);
        return $this->db->update($this->table, $data);
    }

}

?>
