<div class="row">
	<div class="col-6 border-end">
		<img src="<?= base_url('assets/images/customer_photos/').$pelanggan->foto ?>" class="img-fluid">
	</div>
	<div class="col-6 p-5">
		<h1 class="h3 fw-bold"><?= $pelanggan -> nama ?></h1>
		<span class="badge bg-primary rounded-pill px-2">
			<?= $pelanggan -> status ?>
		</span>
		<button class="badge btn btn-sm bg-transparent text-dark fs-6 shadow-none" data-bs-toggle="modal"
			data-bs-target="#modalVerifikasi">
			<i class="bi bi bi-arrow-repeat"></i>
		</button>
		<hr>
		<h5 class="fw-bold fs-6">Surel:</h5>
		<p class="text-secondary">
			<?= $pelanggan -> surel ?>
		</p>
		<h5 class="fw-bold fs-6">No. Ponsel:</h5>
		<p class="text-secondary">
			<?= $pelanggan -> no_ponsel ?>
		</p>
		<h5 class="fw-bold fs-6">Alamat:</h5>
		<p class="text-secondary">
			<?= $pelanggan -> alamat ?>
		</p>
	</div>
</div>
<?php $this->load->view('admin/pelanggan/form_verifikasi_pelanggan'); ?>
