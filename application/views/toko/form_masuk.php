<!-- Modal Login -->
<div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="masukLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<form class="modal-content" method="post" action="<?= base_url('toko/masuk') ?>">
			<div class="modal-body p-5">
				<h3 class="modal-title mb-5 fw-bold mx-auto" id="masukLabel">Masuk</h3>
				<div class="mb-3">
					<label for="surel" class="fw-bold mb-1">Surel</label>
					<input type="text" name="surel" class="form-control shadow-none" required>
				</div>
				<div class="mb-3">
					<label for="password" class="fw-bold mb-1">Kata Sandi</label>
					<input type="password" name="kata_sandi" class="form-control shadow-none" required>
				</div>
				<small class="form-text">
					Belum punya akun?
					<a href="<?= base_url('toko/daftar') ?>" class="text-primary text-decoration-none">Gabung Forta</a>
					sekarang!
				</small>
				<div class="d-flex justify-content-end mt-5">
					<button type="submit" class="btn btn-primary">Masuk</button>
				</div>
			</div>
		</form>
	</div>
