<div class="row">
	<div class="col-6 border-end">
		<img src="<?= base_url('assets/images/products/').$produk->gambar ?>" class="img-fluid">
	</div>
	<div class="col-6 p-5">
		<h1 class="h3 fw-bold"><?= $produk -> nama ?></h1>
		<span class="badge bg-primary rounded-pill">
			<?= $nama_brand ?>
		</span>
		<hr>
		<h5 class="fw-bold fs-6">Deskripsi:</h5>
		<p class="text-secondary">
			<?= $produk -> deskripsi ?>
		</p>
	</div>
</div>
