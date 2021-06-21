<?php 

class Detail_pesanan_model extends CI_Model {

    private $table = 'tb_detail_pesanan';

    public function lihat_semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_tunggal($id)
    {
        $query = $this->db->get_where($this->table, ['id_detail_pesanan' => $id]);
        return $query->row();
    }

    public function lihat_dari($id)
    {
        $query = $this->db->get_where($this->table, ['id_pesanan' => $id]);
        return $query->result();
    }

    public function lihat($selected, $keyname, $key)
    {
        $this->db->select($selected);
        $this->db->from($this->table);
        $this->db->where($keyname, $key);
        return $this->db->get()->row();
    }

    function baru_batch($data){
        return $this->db->insert_batch($this->table, $data);
    }

    public function detail_riwayat_pesanan($id_pesanan)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_detail_pesanan.id_produk');
        $query = $this->db->get();
        return $query->result();
    }


}

?>
