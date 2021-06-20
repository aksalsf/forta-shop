<?php

class Toko extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('brand_model');
        $this->load->model('pelanggan_model');
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
        $this->validasi_form_login();
        if ($this->form_validation->run() == TRUE)
        {
            $surel = $this->input->post('surel');
            $kata_sandi = $this->input->post('kata_sandi');
            if ($this->pelanggan_model->lihat('kata_sandi', 'surel', $surel)) {
                if (password_verify($kata_sandi, $this->pelanggan_model->lihat('kata_sandi', 'surel', $surel)->kata_sandi)) {
                    
                }
            }
            $this->session->set_flashdata('notifikasi', 'Surel atau kata sandi salah!');
            redirect(base_url());
        }
        else
        {
            redirect(base_url());
        }
    }
    private function validasi_form_login()
    {
        $this->form_validation->set_error_delimiters('<small class="form-text text-danger">', '</small>');
        $this->form_validation->set_rules('surel', 'Surel', 'trim|required|valid_email');
        $this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'trim|required');
    }
    public function daftar()
    {
        $data['title'] = 'Daftar';
        $this->template->load('template_toko', 'toko/daftar', $data);
    }
}
