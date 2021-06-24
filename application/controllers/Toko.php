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
    // Halaman utama
    public function index()
    {
        // Cek ada pencarian nggak
        if($this->input->post('cari')) {
            // Mencari data di database
            $data['produkCollection'] = $this->produk_model->cari($this->input->post('cari'));
            // Menampilkan flashdata menggunakan class Session CI
            $this->_notif('Kami menemukan '.count($data['produkCollection']).' produk yang mungkin sedang kamu cari.');
        } else {
            // Kalo gk ada yang mau dicari
            // Langsung mengambil semua data
            $data['produkCollection'] = $this->produk_model->lihat_semua();
            // Buat ngacak
            shuffle($data['produkCollection']);
        }

        // Ngambil data brand
        $data['brandCollection'] = $this->brand_model->lihat_semua();

        $data['title'] = 'Beranda';
        $this->template->load('template_toko', 'toko/beranda', $data);
    }
    // Menampilkan detail produk
    public function detail($id)
    {
        $data['produk'] = $this->produk_model->lihat_tunggal($id);
        $data['brand'] = $this->brand_model->lihat_tunggal($data['produk']->id_brand);
        $data['title'] = $data['produk']->nama;
        $this->template->load('template_toko', 'toko/detail_produk', $data);
    }
    // Login
    public function masuk()
    {
        // Menangkap data input form login
        $surel = $this->input->post('surel');
        $kata_sandi = $this->input->post('kata_sandi');
        
        // Memeriksa ada nggak data yang emailnya sama dari input user
        if ($this->pelanggan_model->lihat_tunggal($surel)) {
            // Kalo ada, apakah password input user sama dengan database
            if (password_verify($kata_sandi, $this->pelanggan_model->lihat_tunggal($surel)->kata_sandi)) {
                // Cek status user
                if ($this->pelanggan_model->lihat_tunggal($surel) -> status != 'ACTIVE') {
                    $this->_notif('Akun kamu telah dinonaktifkan. Jika kamu merasa ada kesalahan, silakan hubungi customer service kami.');
                } else {
                    // Jika aman, buat session login
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
    // Cek login yang digunakan di setiap method
    private function _cek_login()
    {
        // Mengecek dari session
        if ($this->session->userdata['pelanggan'] === null) {
            $this->_notif('Kamu belum login nih! Login dulu, ya!');
            redirect(base_url());
        }
    }
    // Logout
    public function logout()
    {
        // Menghapus session pelanggan
        $this->session->unset_userdata('pelanggan');
        // Menghapus semua isi keranjang
        $this->cart->destroy();
        // Kembali ke halaman utama dan kasih notif
        $this->_notif('Berhasil logout. Sampai jumpa kembali 👋');
        redirect(base_url());
    }
    // Menampilkan form pendaftaran
    public function daftar()
    {
        $data['title'] = 'Daftar';
        $this->_validasi_form_daftar();

        if($this->form_validation->run()) {
            $post = $this->input->post();
            // Menyiapkan data pendaftaran dari input user
            $data = [
                'nama' => $post['nama'],
                'surel' => $post['surel'],
                'no_ponsel' => $post['no_ponsel'],
                'kata_sandi' => password_hash($post['kata_sandi'], PASSWORD_BCRYPT, ['cost' => 12]),
                'alamat' => '-',
                'status' => 'ACTIVE'
            ];
            // Menyimpan data ke database
            if ($this->pelanggan_model->daftar($data)) {
                $this->_notif('Pendaftaran berhasil! Kamu sudah bisa login 🤗');
                redirect(base_url());
            } else {
                $this->_notif('Mohon maaf, pendaftaran gagal. Harap coba lagi atau tunggu beberapa saat.');
            }
        }
        $this->template->load('template_toko', 'toko/daftar', $data);
    }
    // Rule validasi form pendaftaran
    private function _validasi_form_daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('no_ponsel', 'Nomor Ponsel',
        'trim|required|min_length[13]|is_natural|is_unique[tb_pelanggan.no_ponsel]');
        $this->form_validation->set_rules('surel', 'Surel', 'trim|required|valid_email|is_unique[tb_pelanggan.surel]');
    }
    // Notif dengan flashdata => tempatnya di template_toko
    private function _notif($pesan)
    {
        $this->session->set_flashdata('notifikasi', $pesan);
    }
    // Memeriksa ada input post atau ndak, dipake di function yang perlu input
    private function _cek_input_post()
    {
        if(empty($this->input->post())) {
            $this->_notif('Maaf ya, ada sedikit kesalahan 😥');
            return redirect(base_url());
        }
    }
    // Tampilan halaman keranjang
    public function keranjang()
    {
        $this->_cek_login();
        $data['title'] = 'Keranjang';
        $this->template->load('template_toko', 'toko/keranjang', $data);
    }
    // Menambah isi keranjang
    public function tambah_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();

        $post = $this->input->post();
        // Menyimpan input user, lalu menyiapkan variabel buat Cart
        $produk = [
            // Data wajib di cart
            'id' => $post['id_produk'],
            'qty' => 1,
            'price' => $post['harga'],
            'name' => str_replace(',', ' -', str_replace('/', '_', $post['nama']))
        ];
        // Menambahkan Cart
        if($this->cart->insert($produk))
        $this->_notif('Berhasil disimpan ke keranjang!');
        // Kembali ke halaman sebelumnya
        redirect($this->agent->referrer());
    }
    // Memperbarui stok produk di keranjang
    public function simpan_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();

        $post = $this->input->post();
        // Menyiapkan data yang mau diganti
        $produk = [
            'rowid' => $post['rowid'],
            'qty' => $post['qty']
        ];
        // Dicek stoknya
        $this->_cek_stok($produk['qty'], $post['id_produk']);
        // Eksekusi
        if($this->cart->update($produk))
        $this->_notif('Berhasil memperbarui keranjang!');
        redirect($this->agent->referrer());
    }
    // Menghapus item di keranjang
    public function hapus_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();

        $post = $this->input->post();
        // Eksekusi
        if($this->cart->remove($post['rowid']))
        $this->_notif('Berhasil menghapus produk!');
        redirect($this->agent->referrer());
    }
    // Dipakai ketika menekan tombol Beli di halaman detail produk
    public function beli_keranjang()
    {
        $this->_cek_login();
        $this->_cek_input_post();
        $post = $this->input->post();
        $produk = [
            'id' => $post['id_produk'],
            'qty' => $post['qty'],
            'price' => $post['harga'],
            'name' => str_replace(',', ' -', str_replace('/', '_', $post['nama']))
        ];

        $this->_cek_stok($post['qty'], $post['id_produk']);

        if($this->cart->insert($produk))
        $this->_notif('Silakan lanjutkan proses pemesanan!');
        redirect(base_url('toko/keranjang'));
    }
    // Dipake untuk mengecek stok berdasarkan input user
    private function _cek_stok($qty, $id)
    {
        if($qty > intval($this->produk_model->lihat('stok', 'id_produk', $id)->stok) == TRUE)
        {
            $this->_notif('Maaf, sepertinya staf gudang kami belum <em>kulakan</em>. Stok tidak cukup!');
            redirect($this->agent->referrer());
        }
    }
    // Digunakan untuk checkout
    public function checkout()
    {
        $this->_cek_login();
        // Cek di keranjang ada barang nggak, antisipasi kalo ada yang langsung ketik url
        if ($this->cart->total_items() > 0) {
            // Bikin kode pesanan acak
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
            // Menyiapkan isi keranjang
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
            // Menyimpan isi keranjang ke dalam database
            if ($this->detail_pesanan_model->baru_batch($keranjang)) {
                foreach ($keranjang as $item) {
                    if($this->produk_model->kurangi_stok($item['id_produk'], $item['kuantitas']) == FALSE) {
                        $this->_notif('Maaf ada kesalahan dalam proses checkout Anda. Silakan ulangi transaksi atau hubungi customer service.');
                        redirect(base_url('toko/riwayat'));
                    }
                }
                $this->cart->destroy();
                $this->_notif('Pesanan kamu sudah kami terima 😄. Mohon segera melakukan pembayaran agar kami bisa mengirim
                barang kamu segera!');
                redirect(base_url('toko/riwayat'));
            }
        } else {
            $this->_cek_input_post();
        }
    }
    // Riwayat Transaksi
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

            // Melihat isi pesanan dan menyimpannya ke array
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
    // Profil
    public function profil()
    {
        $this->_cek_login();

        if ($this -> session -> flashdata('notifikasi') == NULL)
        $this->_notif('Tips: Kamu bisa klik dua kali di bagian yang ingin kamu ubah, lalu simpan.');

        $config =
        [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required|min_length[4]',
            ],
            [
                'field' => 'surel',
                'label' => 'Surel',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'no_ponsel',
                'label' => 'Nomor Ponsel',
                'rules' => 'trim|required|min_length[13]|is_natural'
            ]
        ];
        $this->form_validation->set_rules($config);
        
        if($this->input->post()) {
            $post = $this->input->post();
            // Ganti Identitas Profil
            if ($this->input->post('simpan')) {
                if($this->form_validation->run() == FALSE) {
                    $this->_notif('Maaf, data salah.<br>' . validation_errors());
                } else {
                    array_pop($post);
                    $this->_update_profil($post);
                }
            }
            // Ganti Kata Sandi
            if ($this->input->post('ganti_kata_sandi')) {
                array_pop($post);
                $post['kata_sandi'] = password_hash($post['kata_sandi'], PASSWORD_BCRYPT, ['cost', 12]);
                $this->_update_profil($post);
            }
            // Ganti/Upload Foto
            if ($this->input->post('ganti_foto')) {
                $profil = array();
                $this->_upload_foto();
                if ($this->upload->data('file_name') != '') {
                    $profil['foto'] = $this->upload->data('file_name');
                    $this->_update_profil($profil);
                }
            }
            redirect(base_url('toko/profil'));
        }

        $data['profil'] = $this->pelanggan_model->lihat_tunggal($this->session->userdata('pelanggan')->surel);

        $data['title'] = 'Profil';
        $this->template->load('template_toko', 'toko/profil', $data);
    }
    
    // Unggah Foto Profil
    private function _upload_foto()
    {
        $config['upload_path'] = './assets/images/customer_photos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '600';
        $config['max_height'] = '600';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto'))
        $this->_notif('Upload foto gagal! <br>' . $this->upload->display_errors());
    }

    private function _update_profil($data)
    {
        $id_pelanggan = $this->session->userdata('pelanggan')->id_pelanggan;
        if($this->pelanggan_model->update_profil($id_pelanggan, $data)) {
            $this->_notif('Berhasil memperbarui data!');
            redirect('toko/profil');
        }
    }

}
