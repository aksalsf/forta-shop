<?php 

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('produk_model');
        $this->load->model('brand_model');
        $this->load->model('pelanggan_model');
        $this->load->model('pesanan_model');
        $this->load->model('detail_pesanan_model');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    }

    public function index()
    {
        $this->_redirect_to('admin/login');
    }

    public function login()
    {
        if (isset($this->session->userdata['admin'])) $this->_redirect_to('admin/order');

        $data['title'] = 'Ruang Rahasia';
        $this->template->load('template_toko', 'admin/admin_login', $data);

        // Cek input 
        if ($this->input->post()) {
            // Menyimpan input
            $post = $this->input->post();
            $nama_pengguna = $post['nama_pengguna'];
            $kata_sandi = $post['kata_sandi'];

            // Login
            if ($this->admin_model->login($nama_pengguna) && password_verify($kata_sandi,
            $this->admin_model->login($nama_pengguna)->kata_sandi)) {
                // Jika aman, buat session login
                $this->session->set_userdata(['admin' => $this->admin_model->login($nama_pengguna)]);
                $this->_notif('Selamat datang, Bosque!');
                $this->_redirect_to('admin/order');
            } {
                $this->_notif('Identitas login salah!');
                $this->_redirect_to('admin/login');
            }
        }
    }

    private function _cek_login()
    {
        if ($this->session->userdata['admin'] === null) {
            $this->_notif('Kamu belum login!');
            $this->_redirect_to('admin/login');
        }
    }

    // Logout
    public function logout()
    {
        // Menghapus session
        $this->session->unset_userdata('admin');
        // Kembali ke halaman utama dan kasih notif
        $this->_notif('Berhasil logout. Sampai jumpa kembali 👋');
        $this->_redirect_to('admin/login');
    }

    public function order()
    {
        $this->_cek_login();

        $data['riwayat_pesanan'] = $this->pesanan_model->lihat_semua_riwayat();

        $data['title'] = 'Order - Dasbor Admin';
        $this->template->load('template_admin', 'admin/order/dasbor_order', $data);
    }

    public function detail_order($id_pesanan)
    {
        $this->_cek_login();

        $data['detail_pesanan'] = $this->detail_pesanan_model->detail_riwayat_pesanan($id_pesanan);

        $data['title'] = 'Detail Pesanan - Dasbor Admin';
        $this->template->load('template_admin', 'admin/order/detail_order', $data);
    }

    public function verifikasi_order()
    {
        $this->_cek_login();
        $this->_cek_input_post();

        $id_pesanan = $this->input->post('id_pesanan');
        
        if ($this->pesanan_model->ubah_status($id_pesanan, 'DIKIRIM') == FALSE) {
            $this->_notif('GAGAL mengubah status pesanan');
        } else {
            $this->_notif('BERHASIL mengubah status pesanan');
        }

        $this->_redirect_to('admin/order');
    }

    public function gudang()
    {
        $this->_cek_login();

        $semuaProduk = $this->produk_model->lihat_kolom(['id_produk', 'id_brand', 'nama', 'harga', 'stok']);

        // Data untuk ditampilkan dalam tabel produk
        $data['gudang'] = [];
        foreach ($semuaProduk as $produk) {
            $brand = $this->brand_model->lihat_tunggal($produk -> id_brand) -> nama;
            array_push($data['gudang'],
                [
                    'id_produk' => $produk -> id_produk,
                    'nama' => $produk -> nama,
                    'brand' => $brand,
                    'harga' => $produk -> harga,
                    'stok' => $produk -> stok
                ]
            );
        }
        // Data untuk dropdown tambah produk
        $data['brand'] = array();
        foreach ($this->brand_model->lihat_semua() as $brand) {
            $data['brand'][$brand -> id_brand] = $brand -> nama;
        }

        $data['produk'] = $this->_dropdownDataBrand();

        $this->_validasi_form_produk();

        if ($this->form_validation->run() && $this -> input -> post())
        $this->_tambah_produk_gudang();

        if (validation_errors())
        $this->_notif('Produk gagal ditambahkan <br>'.validation_errors());

        $data['title'] = 'Gudang - Dasbor Admin';
        $this->template->load('template_admin', 'admin/gudang/dasbor_gudang', $data);
    }

    private function _dropdownDataBrand()
    {
        // Data untuk dropdown
        $data = array();
        foreach ($this->brand_model->lihat_semua() as $brand) {
            $data[$brand -> id_brand] = $brand -> nama;
        }
        return $data;
    }

    private function _validasi_form_produk()
    {
        $rule = [
            [
                'field' => 'nama',
                'label' => 'Nama Produk',
                'rules' => 'trim|required|regex_match[/[a-zA-Z]([\w -]*[a-zA-Z])?$/]'
            ],
            [
                'field' => 'id_brand',
                'label' => 'Brand',
                'rules' => 'trim|required|is_natural_no_zero'
            ],
            [
                'field' => 'harga',
                'label' => 'Harga',
                'rules' => 'trim|required|is_natural_no_zero'
            ],
            [
                'field' => 'stok',
                'label' => 'Stok',
                'rules' => 'trim|is_natural_no_zero'
            ],
            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'required'
            ],
        ];

        // if($this->uri->segment(3) != 'sunting')
        // array_push($rule, [
        //     'field' => 'gambar',
        //     'label' => 'Foto Produk',
        //     'rules' => 'required',
        //     'errors' => array(
        //         'required' => 'Kamu belum upload foto produk!',
        //     ),
        // ]);
        $this->form_validation->set_rules($rule);
    }

    public function detail_gudang($id_produk)
    {
        $this->_cek_login();
        
        $data['produk'] = $this->produk_model->lihat_tunggal($id_produk);

        $data['nama_brand'] = $this->brand_model->lihat_nama_brand($data['produk']->id_brand);
        
        $data['title'] = 'Detail ';
        $this->template->load('template_admin', 'admin/gudang/detail_gudang', $data);
    }

    private function _tambah_produk_gudang()
    {
        $this->_upload_gambar_produk();
        $produk = $this->input->post();
        $produk['gambar'] = $this->upload->data('file_name');
        if ($this->produk_model->tambah_produk($produk))
        $this->_notif('Produk baru berhasil ditambahkan! Semangat 🙌');
        redirect('admin/gudang');
    }

    public function update_stok_gudang()
    {
        $this->_cek_login();
        $this->_cek_input_post();
        $post = $this->input->post();
        if ($this->produk_model->update_stok($post['id_produk'], $post['stok']))
        $this->_notif('Stok berhasil diperbarui!');
        $this->_redirect_to('admin/gudang');
    }

    public function sunting_gudang($id_produk)
    {
        $this->_cek_login();
        $data['detail_produk'] = $this->produk_model->lihat_tunggal($id_produk);

        $data['brand'] = $this->_dropdownDataBrand();

        $this->_validasi_form_produk();

        if ($this->form_validation->run() && $this -> input -> post())
        $this->_sunting_produk_gudang($id_produk);

        if(validation_errors())
        $this->_notif('GAGAL menyunting detail produk! <br>'.validation_errors());

        $data['title'] = 'Sunting Data Produk';
        $this->template->load('template_admin', 'admin/gudang/form_produk_gudang', $data);
    }

    private function _sunting_produk_gudang($id_produk)
    {
        $produk = $this->input->post();
        
        $this->_upload_gambar_produk();
        if ($this->upload->data('file_name') != '')
        $produk['gambar'] = $this->upload->data('file_name');
        
        if ($this->produk_model->sunting_produk($id_produk, $produk)) {
            $this->_notif('Produk berhasil disunting!');
            redirect('admin/gudang');
        }
    }

    private function _upload_gambar_produk()
    {
        $config['upload_path'] = './assets/images/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '600';
        $config['max_height'] = '600';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
            $this->_notif('Upload gambar gagal! <br>' . $this->upload->display_errors());
        }
    }

    public function brand()
    {
        $this->_cek_login();

        if ($this -> session -> flashdata('notifikasi') == NULL)
        $this->_notif('Tips: Kamu bisa klik dua kali di nama brand kalo mau mengubahnya. Lalu tekan enter.');

        $this->_olah_data_brand();

        $data['brandCollection'] = $this->brand_model->lihat_semua();

        for ($i=0; $i < count($data['brandCollection']); $i++) { 
            $data['brandCollection'][$i] -> jumlah_produk = $this -> produk_model->hitung_produk_dari_brand($data['brandCollection'][$i] -> id_brand);
        }

        $data['title'] = 'Brand';
        $this->template->load('template_admin', 'admin/brand/dasbor_brand', $data);
    }

    private function _olah_data_brand()
    {
        if ($this->input->post('tambah') !== null) {
            $post = $this->input->post();
            array_pop($post);
            if($this->brand_model->tambah_brand($post)) {
                $this->_notif('Berhasil menambahkan brand baru!');
                $this->_redirect_to('admin/brand');
            }
        }

        if ($this->input->post('sunting') !== null) {
            $post = $this->input->post();
            array_pop($post);
            if($this->brand_model->sunting_brand($post['id_brand'], ['nama' => $post['nama']])) {
                $this->_notif('Berhasil mengubah detail brand!');
                $this->_redirect_to('admin/brand');
            }
        }
    }

    public function pelanggan()
    {
        $this->_cek_login();

        $data['pelangganCollection'] = $this->pelanggan_model->lihat_semua();

        $data['title'] = 'Pelanggan';
        $this->template->load('template_admin', 'admin/pelanggan/dasbor_pelanggan', $data);
    }

    public function detail_pelanggan($id_pelanggan)
    {
        $this->_cek_login();

        if($this->input->post())
        $this->_verifikasi_pelanggan($id_pelanggan);

        $data['pelanggan'] = $this->pelanggan_model->lihat_dari_id($id_pelanggan);

        $data['title'] = 'Pelanggan';
        $this->template->load('template_admin', 'admin/pelanggan/detail_pelanggan', $data);
    }
    
    // Mengubah status pelanggan
    private function _verifikasi_pelanggan($id_pelanggan)
    {
        $status = $this->input->post('status');
        if ($this->pelanggan_model->verifikasi($id_pelanggan, $status))
        $this->_notif('Status pelanggan berhasil diubah');
    }

    // Memeriksa ada input post atau ndak, dipake di function yang perlu input
    private function _cek_input_post()
    {
        if(empty($this->input->post())) {
            $this->_notif('Data POST tidak ditemukan! Jangan nakal, ya.');
            return $this->_redirect_to('admin/order');
        }
    }

    private function _notif($pesan)
    {
        $this->session->set_flashdata('notifikasi', $pesan);
    }

    private function _redirect_to($uri)
    {
        redirect(base_url($uri));
    }
}
?>
