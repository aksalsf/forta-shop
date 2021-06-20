<?php

/**
 * Template untuk Halaman Toko
 */

$this->load->view('template/header');

// Notifikasi
if ($this->session->flashdata('notifikasi')) {
	$this->load->view('toko/notifikasi');
}

?>

<div class="bg-light">
	<?php $this->load->view('template/navbar'); ?>
	<?= $content ?>
</div>
<footer class="container-fluid bg-dark pt-5 px-5 pb-3">
	<div class="row">
		<nav class="col-md-3">
			<h6 class="fw-bold mb-3 text-white">Tentang Kami</h6>
			<ul class="list-unstyled">
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Tentang Forta</a>
				</li>
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Karir</a>
				</li>
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Blog</a>
				</li>
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Kontak</a>
				</li>
			</ul>
		</nav>
		<nav class="col-md-3">
			<h6 class="fw-bold mb-3 text-white">Kebijakan</h6>
			<ul class="list-unstyled">
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Kebijakan Privasi</a>
				</li>
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Informasi Transaksi</a>
				</li>
			</ul>
		</nav>
		<nav class="col-md-3">
			<h6 class="fw-bold mb-3 text-white">Layanan</h6>
			<ul class="list-unstyled">
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Pusat Bantuan</a>
				</li>
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Panduan Penggunaan</a>
				</li>
				<li class="mb-2">
					<a class="text-white-50 text-decoration-none" href="#">Layanan Pengaduan</a>
				</li>
			</ul>
		</nav>
	</div>
	<hr class="bg-white">
	<div class="text-white">
		&copy;2021 Forta
	</div>
</footer>

<?php $this->load->view('template/footer');
