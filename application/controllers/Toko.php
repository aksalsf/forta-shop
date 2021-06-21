<?php

class Toko extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('brand_model');
        $this->load->model('pelanggan_model');
        $this->load->model('pesanan_model');
        $this->load->model('detail_pesanan_model');
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');
    }
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['produkCollection'] = $this->produk_model->lihat_semua();
        $data['brandCollection'] = $this->brand_model->lihat_semua();

        $this->template->load('template_toko', 'toko/beranda', $data);
    }
    public function detail($id)
    {
        $data['produk'] = $this->produk_model->lihat_tunggal($id);
        $data['brand'] = $this->brand_model->lihat_tunggal($data['produk']->id_brand);
        $data['title'] = $data['produk']->nama;
        $this->template->load('template_toko', 'toko/detail_produk', $data);
    }
    public function masuk()
    {
        $surel = $this->input->post('surel');
        $kata_sandi = $this->input->post('kata_sandi');
        
        if ($this->pelanggan_model->lihat_tunggal($surel)) {
            if (password_verify($kata_sandi, $this->pelanggan_model->lihat_tunggal($surel)->kata_sandi)) {
                if ($this->pelanggan_model->lihat_tunggal($surel) -> status != 'ACTIVE') {
                    $this->_notif('Akun kamu telah dinonaktifkan. Jika kamu merasa ada kesalahan, silakan hubungi customer service kami.');
                } else {
                    $this->session->set_userdata(
                    ['pelanggan' => $this->pelanggan_model->lihat_tunggal($surel)]
                    );
                    $this->_notif('Selamat datang, '.$this->pelanggan_model->lihat_tunggal($surel)->nama.'!');
                }
            } else {
                $this->_notif('Kata sandi salah!');
            }
        } else {
            $this->_notif('Surel salah!');
        }
        redirect(base_url());
    }
    private function _validasi_form_login()
    {
        $this->form_validation->set_rules('surel', 'Surel', 'trim|required|valid_email');
        $this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'trim|required');
    }
    private function _cek_login()
    {
        if ($this->session->userdata['pelanggan'] === null) {
            $this->_notif('Kamu belum login nih! Login dulu, ya!');
            redirect(base_url());
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('pelanggan');
        $this->cart->destroy();
        $this->_notif('Berhasil logout. Sampai jumpa kembali 👋');
        redirect(base_url());
    }
    public function daftar()
    {
        $data['title'] = 'Daftar';
        $this->_validasi_form_daftar();
        if($this->form_validation->run()) {
            $post = $this->input->post();
            $data = [
                'nama' => $post['nama'],
                'surel' => $post['surel'],
                'no_ponsel' => $post['no_ponsel'],
                'kata_sandi' => password_hash($post['kata_sandi'], PASSWORD_BCRYPT, ['cost' => 12]),
                'alamat' => '-',
                'status' => 'ACTIVE'
            ];
            if ($this->pelanggan_model->daftar($data)) {
                $this->_notif('Pendaftaran berhasil! Kamu sudah bisa login 🤗');
                redirect(base_url());
            } else {
                $this->_notif('Mohon maaf, pendaftaran gagal. Harap coba lagi atau tunggu beberapa saat.');
            }
        }
        $this->template->load('template_toko', 'toko/daftar', $data);
    }
    private function _validasi_form_daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('no_ponsel', 'Nomor Ponsel',
        'trim|required|min_length[13]|is_natural|is_unique[tb_pelanggan.no_ponsel]');
        $this->form_validation->set_rules('surel', 'Surel', 'trim|required|valid_email|is_unique[tb_pelanggan.surel]');
    }
    private function _notif($pesan)
    {
        $this->session->set_flashdata('notifikasi', $pesan);
    }
    private function _cek_input_post()
    {
        if(empty($this->input->post())) {
            $this->_notif('Maaf ya, ada sedikit kesalahan 😥');
            return redirect(base_url());
        }
    }
    public function keranjang()
    {
        $this->_cek_login();
        $data['title'] = 'Keranjang';
        $this->template->load('template_toko', 'toko/keranjang', $data);
    }
    public function tambah_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();
        $post = $this->input->post();
        $produk = [
            'id' => $post['id_produk'],
            'qty' => 1,
            'price' => $post['harga'],
            'name' => str_replace('/', '_', $post['nama'])
        ];
        if($this->cart->insert($produk))
        $this->_notif('Berhasil disimpan ke keranjang!');
        redirect($this->agent->referrer());
    }
    public function simpan_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();
        $post = $this->input->post();
        $produk = [
            'rowid' => $post['rowid'],
            'qty' => $post['qty']
        ];

        $this->_cek_stok($produk['qty'], $post['id_produk']);

        if($this->cart->update($produk))
        $this->_notif('Berhasil memperbarui keranjang!');
        redirect($this->agent->referrer());
    }
    public function hapus_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();
        $post = $this->input->post();

        if($this->cart->remove($post['rowid']))
        $this->_notif('Berhasil menghapus produk!');
        redirect($this->agent->referrer());
    }
    public function beli_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();
        $post = $this->input->post();
        $produk = [
            'id' => $post['id_produk'],
            'qty' => $post['qty'],
            'price' => $post['harga'],
            'name' => str_replace('/', '_', $post['nama'])
        ];

        $this->_cek_stok($post['qty'], $post['id_produk']);

        if($this->cart->insert($produk))
        $this->_notif('Silakan lanjutkan proses pemesanan!');
        redirect(base_url('toko/keranjang'));
    }
    private function _cek_stok($qty, $id)
    {
        if($qty > intval($this->produk_model->lihat('stok', 'id_produk', $id)->stok) == TRUE)
        {
            $this->_notif('Maaf, sepertinya staf gudang kami belum <em>kulakan</em>. Stok tidak cukup!');
            redirect($this->agent->referrer());
        }
    }
    public function checkout()
    {
        $this->_cek_login();
        if ($this->cart->total_items() > 0) {
            $kode_pesanan =
            'ORD'.strtoupper(substr(str_shuffle(md5($this->session->userdata('pelanggan')->surel.time())),0,9));
            // Menyiapkan data
            $pesanan = [
                'id_pelanggan' => $this->session->userdata('pelanggan')->id_pelanggan,
                'kode_pesanan' => $kode_pesanan,
                'tgl_pesan' => date('Y-m-d H:i:s'),
                'status' => 'CHECKOUT'
            ];
            // Menyimpan $pesanan ke tabel pesanan
            $id_pesanan = $this->pesanan_model->baru($pesanan);
            $keranjang = [];
            foreach ($this->cart->contents() as $item) {
                array_push($keranjang, [
                    'id_pesanan' => $id_pesanan,
                    'id_produk' => $item['id'],
                    'kuantitas' => $item['qty'],
                    'harga' => $item['price'],
                    'total' => $item['subtotal']
                ]);
            }
            if ($this->detail_pesanan_model->baru_batch($keranjang)) {
                $this->cart->destroy();
                $this->_notif('Pesanan kamu sudah kami terima 😄. Mohon segera melakukan pembayaran agar kami bisa mengirim
                barang kamu segera!');
                redirect(base_url('toko/riwayat'));
            }
        } else {
            $this->_cek_input_post();
        }
    }
    public function riwayat()
    {
        $this->_cek_login();
        $data['title'] = 'Riwayat Belanjamu';

        $data['riwayat'] = [];

        // Melihat semua pesanan dari user
        $semua_pesanan = $this->pesanan_model->lihat_dari($this->session->userdata('pelanggan')->id_pelanggan);
        foreach ($semua_pesanan as $pesanan) {
            $detail_semua = $this->detail_pesanan_model->detail_riwayat_pesanan($pesanan -> id_pesanan);
            $data['riwayat'][$pesanan -> kode_pesanan] = [
                'tgl_pesan' => $pesanan -> tgl_pesan,
                'status' => $pesanan -> status
            ];

            $data['riwayat'][$pesanan -> kode_pesanan]['detail'] = [];
            foreach ($detail_semua as $detail) {
                array_push($data['riwayat'][$pesanan -> kode_pesanan]['detail'],
                    [
                        'nama' => $detail -> nama,
                        'harga' => $detail -> harga,
                        'kuantitas' => $detail -> kuantitas,
                        'total' => $detail -> total,
                    ]
                );
            }
        }
        // Mengurutkan biar data yang tampil dari yang terbaru
        $data['riwayat'] = array_reverse($data['riwayat'],true);
        $this->template->load('template_toko', 'toko/riwayat', $data);
    }
}
