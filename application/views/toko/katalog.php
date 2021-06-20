<section class="container-fluid p-5 bg-light">
	<div class="d-flex align-items-center">
		<h1 class="fs-6 mb-0 me-auto">Katalog</h1>
		<a href="#" class="btn btn-sm btn-primary rounded-pill">Realme</a>
	</div>
	<hr>
	<div class="row">
		<?php foreach($produkCollection as $produk): ?>
		<a class="col-md-2 text-dark text-decoration-none mb-4 card-item d-flex align-items-stretch"
			href="<?= base_url(). 'index.php/beli/lihat/' . $produk -> id_produk; ?>"
			title="Beli <?= $produk -> nama; ?> ">
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
				<div class="btn btn-primary">
					Beli
				</div>
			</div>
		</a>
		<?php endforeach; ?>
	</div>
</section>
