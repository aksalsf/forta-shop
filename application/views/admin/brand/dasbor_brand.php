<div class="d-flex mb-5 justify-content-end">
	<span class="me-auto fs-3">🐱‍💻</span>
	<button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalBrand">[+] Tambah Brand</button>
</div>
<table class="table table-bordered" id="tabel">
	<thead class="table-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Brand</th>
			<th scope="col">Jumlah Produk</th>
		</tr>
	</thead>
	<tbody>
		<!-- Perulangan data dari sini -->
		<?php $i = 1; ?>
		<?php foreach($brandCollection as $brand): ?>
		<tr>
			<th style="vertical-align:middle;" class="col-1 text-center"><?= $i;$i++ ?></th>
			<td style="vertical-align:middle;">
				<?= form_open('admin/brand') ?>
				<?= form_hidden('id_brand', $brand -> id_brand) ?>
				<?= form_input('nama', $brand -> nama, [
					'class' => 'form-control bg-transparent border-0 shadow-none',
                    'readonly' => 'true',
                    'ondblclick' => "this.readOnly=''"
					]) ?>
				<?= form_hidden('sunting', TRUE) ?>
				<?= form_close() ?>
			</td>
			<td style="vertical-align:middle;"><?= $brand -> jumlah_produk ?></td>
		</tr>
		<?php endforeach; ?>
		<!-- Tutup perulangan -->
	</tbody>
</table>
<!-- Menambahkan filter dan sorting di tabel -->
<script>
	$(document).ready(function () {
		$('#tabel').DataTable();
	});

</script>
<?php $this->load->view('admin/brand/form_brand'); ?>
