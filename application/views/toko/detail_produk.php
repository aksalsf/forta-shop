<main class="container-fluid py-5" style="background:#F2F2F2">
	<div class="col-md-11 mx-auto mb-5">
		<?= $this->session->flashdata('alert') ?>
		<div class="row">
			<div class="col-md-4">
				<div class="p-3 rounded shadow-sm bg-white">
					<img src="<?= base_url().'assets/images/products/'.$produk->gambar; ?>" class="img-fluid rounded">
				</div>
			</div>
			<div class="col-md-5">
				<div class="card p-5 shadow-sm border-0">
					<h1 class="fw-bold">
						<?= $produk -> nama; ?>
					</h1>
					<aside class="mb-4">
						<span class="badge bg-primary rounded-pill">
							<?= $brand -> nama ?>
						</span>
					</aside>
					<h5 class="fw-bold fs-6">Deskripsi:</h5>
					<p class="text-secondary">
						<?= $produk -> deskripsi; ?>
					</p>
					<hr>
					<?php 
                        // Cek Stok
                        if ($produk -> stok <= 0) {
                            $stok = "Habis";
                        } else {
                            $stok = "Tersedia";
                        }
                    ?>
					<p class="text-black-50"><?= $stok; ?></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card p-5 shadow-sm border-0">
					<h2 class="h4 text-center fw-bold text-danger">
						<?= "IDR " . number_format($produk -> harga,0,',','.'); ?>
					</h2>
					<hr>
					<div class="d-flex flex-column">
						<!-- Beli -->
						<form action="<?= base_url('toko/keranjang/beli') ?>" class="d-flex mb-2" method="POST">
							<input type="hidden" name="id_produk" value="<?= $produk -> id_produk; ?>">
							<input type="hidden" name="nama" value="<?= $produk -> nama; ?>">
							<input type="hidden" name="harga" value="<?= $produk -> harga; ?>">
							<input type="number" name="qty" class="form-control me-2 shadow-none" min=" 1" value="1"
								required>
							<button type="submit" class="shadow-none btn border-primary text-primary col-7"
								title="Beli produk ini sekarang!" <?php if($stok == 'Habis') echo 'disabled'; ?>>
								Beli
							</button>
						</form>
						<!-- Kalo mau menambahkan ke keranjang -->
						<form action="<?= base_url('toko/keranjang/tambah') ?>" method="POST">
							<input type="hidden" name="id_produk" value="<?= $produk -> id_produk; ?>">
							<input type="hidden" name="nama" value="<?= $produk -> nama; ?>">
							<input type="hidden" name="harga" value="<?= $produk -> harga; ?>">
							<button type="submit" class="shadow-none btn btn-primary w-100"
								<?php if($stok == 'Habis') echo 'disabled'; ?> title="Simpan ke keranjang!">
								<i class="bi bi-cart4"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
