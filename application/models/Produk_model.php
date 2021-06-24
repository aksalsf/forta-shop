<?php 

class Produk_model extends CI_Model {

    private $table = 'tb_produk';

    public function lihat_semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_kolom($selected)
    {
        $this->db->select($selected);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function lihat_tunggal($id)
    {
        $query = $this->db->get_where($this->table, ['id_produk' => $id]);
        return $query->row();
    }

    public function cari($kueri)
    {
        // Mencari yang seperti kata yang dimasukkan user
        $this->db->like('nama', $kueri);
        $this->db->or_like('deskripsi', $kueri);
        $this->db->or_like('harga', $kueri);
        // Menjalankan query
        $query = $this->db->get($this->table);
        // Mengembalikan nilai
        return $query->result();
    }

    public function lihat($selected, $keyname, $key)
    {
        $this->db->select($selected);
        $this->db->from($this->table);
        $this->db->where($keyname, $key);
        return $this->db->get()->row();
    }

    public function kurangi_stok($id, $qty)
    {
        $this->db->set('stok', 'stok-'.$qty, FALSE);
        $this->db->where('id_produk', $id);
        return $this->db->update($this->table);
    }

    public function tambah_produk($produk)
    {
        return $this->db->insert($this->table, $produk);
    }

    public function update_stok($id, $qty)
    {
        $this->db->set('stok', $qty, FALSE);
        $this->db->where('id_produk', $id);
        return $this->db->update($this->table);
    }

    public function sunting_produk($id, $produk)
    {
        $this->db->where('id_produk', $id);
        return $this->db->update($this->table, $produk);
    }

    public function hitung_produk_dari_brand($id_brand)
    {
        $this->db->where('id_brand', $id_brand);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

?>
