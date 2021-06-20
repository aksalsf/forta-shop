<?php

class Toko extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
    }
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['produkCollection'] = $this->produk_model->show_all();
        $this->template->load('template_toko', 'toko/beranda', $data);
    }
}
