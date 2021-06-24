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

    public function baru($data){
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        // Mengembalikan id dari data yang baru saja dimasukkan
        return $id;
    }

    public function lihat_semua_riwayat()
    {
        $this->db->select('tb_pesanan.id_pesanan, tb_pesanan.kode_pesanan, tb_pelanggan.nama, tb_pesanan.tgl_pesan,
        tb_pesanan.status');
        $this->db->from($this->table);
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = '.$this->table.'.id_pelanggan');
        $query = $this->db->get();
        return $query->result();
    }

    public function ubah_status($id_pesanan, $status)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update($this->table, ['status' => $status]);
    }


}

?>
