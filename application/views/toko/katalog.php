<section class="container-fluid p-5 bg-light">
	<div class="d-flex align-items-center">
		<h1 class="fs-6 mb-0 me-auto">Katalog</h1>
		<?php foreach($brandCollection as $brand): ?>
		<?= form_open('toko') ?>
		<?= form_button(
			[
				'name' => 'cari',
				'value' => $brand -> nama,
				'class' => 'btn btn-sm px-3 btn-primary rounded-pill ms-2',
				'type' => 'submit',
				'content' => $brand -> nama
			]
		) ?>
		<?= form_close() ?>
		<?php endforeach; ?>
	</div>
	<hr>
	<div class="row">
		<?php foreach($produkCollection as $produk): ?>
		<a class="col-md-2 text-dark text-decoration-none mb-4 card-item d-flex align-items-stretch"
			href="<?= base_url(). 'toko/detail/' . $produk -> id_produk; ?>" title="<?= $produk -> nama; ?> ">
			<div class="col-12 card p-3 shadow-sm border-0">
				<img src="<?= base_url() . 'assets/images/products/'. $produk -> gambar; ?>"
					class="card-img-top card-item-img">
				<div class="card-body card-item-body text-center">
					<h3 class="fs-6 text-body">
						<?= $produk -> nama;?>
					</h3>
					<small class="text-danger">
						<?= "IDR " . number_format($produk -> harga,0,',','.'); ?>
					</small>
				</div>
				<div class="d-flex">
					<div class="btn btn-sm border-primary text-primary col me-2">
						Lihat
					</div>
					<form action="<?= base_url('toko/keranjang/tambah') ?>" method="POST" class="ms-auto">
						<input type="hidden" name="id_produk" value="<?= $produk -> id_produk; ?>">
						<input type="hidden" name="nama" value="<?= $produk -> nama; ?>">
						<input type="hidden" name="harga" value="<?= $produk -> harga; ?>">
						<button type="submit" class="btn btn-sm btn-primary" title="Simpan ke Keranjang 🤗">
							<i class="bi bi-cart4"></i>
						</button>
					</form>
				</div>
			</div>
		</a>
		<?php endforeach; ?>
	</div>
</section>
