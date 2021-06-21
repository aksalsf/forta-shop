<div class="container p-5">
	<div class="col-6 m-auto p-5 bg-white shadow-sm rounded">
		<h1 class="fw-bold mb-5">Daftar</h1>
		<form method="post">
			<div class="mb-3">
				<label for="nama" class="mb-2">Nama</label>
				<input required type="text" name="nama" class="form-control shadow-none" placeholder="Jusuf Habibie">
				<?= form_error('nama') ?>
			</div>
			<div class="mb-3">
				<label for="surel" class="mb-2">Surel</label>
				<input required type="email" name="surel" class="form-control shadow-none"
					placeholder="habibie@indonesia.id">
				<?= form_error('surel') ?>
			</div>
			<div class="mb-3">
				<label for="no_ponsel" class="mb-2">Nomor Ponsel</label>
				<input required type="tel" name="no_ponsel" class="form-control shadow-none"
					placeholder="6289691783679">
				<?= form_error('no_ponsel') ?>
			</div>
			<div class="mb-3">
				<label for="kata_sandi" class="mb-2">Kata Sandi</label>
				<input required type="password" name="kata_sandi" class="form-control shadow-none">
				<?= form_error('kata_sandi') ?>
			</div>
			<small class="form-text">
				Dengan ini saya sudah membaca dan setuju dengan seluruh kebijakan data dan regulasi
				<?= site_name ?>.
			</small>
			<div class="d-flex justify-content-end mt-5">
				<button type="submit" class="btn btn-primary">Daftar</button>
			</div>
		</form>
	</div>
</div>
