<div class="container py-5">
	<div class="row">
		<div class="col-6 border-end">
			<img src="<?= base_url('assets/images/customer_photos/').$profil->foto ?>" class="img-fluid">
		</div>
		<div class="col-6 p-5">
			<?= form_open('toko/profil') ?>
			<?= form_input('nama', set_value('nama', $profil -> nama), [
                    'class' => 'form-control bg-transparent border-0 shadow-none p-0 fs-1 mb-2 fw-bold',
                    'readonly' => 'true',
                    'ondblclick' => "this.readOnly=''"
                ]) ?>
			<span class="badge bg-primary rounded-pill px-2">
				<?= $profil -> status ?>
			</span>
			<hr>
			<h5 class="fw-bold fs-6">Surel:</h5>
			<?= form_input(['name' => 'surel', 'type' => 'email'], 
                set_value('surel', $profil -> surel), 
                [
                    'class' => 'form-control bg-transparent border-0 shadow-none p-0 fs-6 text-secondary mb-3',
                    'readonly' => 'true',
                    'ondblclick' => "this.readOnly=''"
                ]) ?>
			<h5 class="fw-bold fs-6">No. Ponsel:</h5>
			<?= form_input(['name' => 'no_ponsel', 'type' => 'tel'], 
                set_value('no_ponsel', $profil -> no_ponsel), 
                [
                    'class' => 'form-control bg-transparent border-0 shadow-none p-0 fs-6 text-secondary mb-3',
                    'readonly' => 'true',
                    'ondblclick' => "this.readOnly=''"
                ]) ?>
			<h5 class="fw-bold fs-6">Alamat:</h5>
			<?= form_textarea('alamat', 
                set_value('alamat', $profil -> alamat), 
                [
                    'class' => 'form-control bg-transparent border-0 shadow-none p-0 fs-6 text-secondary mb-3',
                    'style' => 'height:184px',
                    'readonly' => 'true',
                    'ondblclick' => "this.readOnly=''"
                ]) ?>
			<?= form_submit('simpan', 'Simpan', ['class' => 'btn btn-dark']) ?>
			<?= form_close() ?>
			<hr>
			<h2 class="mt-5 mb-4 fw-bold">Ganti Kata Sandi</h2>
			<?= form_open('toko/profil') ?>
			<?= form_password([
					'name' => 'kata_sandi',
                    'class' => 'form-control shadow-none mb-3 me-5',
                ]) ?>
			<?= form_submit('ganti_kata_sandi', 'Ganti', ['class' => 'btn btn-dark']) ?>
			<?= form_close() ?>
			<hr>
			<h2 class="mt-5 mb-4 fw-bold">Unggah Foto</h2>
			<?= form_open_multipart('toko/profil') ?>
			<?= form_upload('foto', '', [
                    'class' => 'form-control shadow-none mb-3 me-5',
                ]) ?>
			<?= form_submit('ganti_foto', 'Unggah', ['class' => 'btn btn-dark']) ?>
			<?= form_close() ?>
		</div>
	</div>
</div>
