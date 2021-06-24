<?php if($this->uri->segment(3) != 'sunting'): ?>
<!-- Modal -->
<div class="modal fade" id="modalProduk" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?php endif; ?>
				<?= form_open_multipart( ($this->uri->segment(3) != 'sunting') ? 'admin/gudang' : 'admin/gudang/sunting/'.$detail_produk -> id_produk, ['class' => 'p-3']) ?>
				<h2 class="fw-bold mt-3 mb-5">
					<?= ($this->uri->segment(3) != 'sunting') ? 'Produk Baru' : 'Sunting Data Produk'; ?></h2>
				<div class="mb-3">
					<?= form_label('Nama Produk', 'nama', ['class' => 'fw-bold mb-2']) ?>
					<?= form_input('nama', set_value('nama', (isset($detail_produk)) ? $detail_produk -> nama : ''), [
						'class' => 'form-control shadow-none',
						'pattern' => '[a-zA-Z]([\w -]*[a-zA-Z])?$',
						'required' => 'required'
					]) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Brand', 'id_brand', ['class' => 'fw-bold mb-2']) ?>
					<?= form_dropdown('id_brand', $brand, set_value('id_brand', (isset($detail_produk)) ? $detail_produk -> id_brand : '') ,['class' => 'form-select', 'required' => 'required']) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Harga', 'harga', ['class' => 'fw-bold mb-2']) ?>
					<?= form_input(
						[
							'name' => 'harga',
							'type' => 'number', 
							'class' => 'form-control shadow-none',
							'required' => 'required'
						], set_value('harga', (isset($detail_produk)) ? $detail_produk -> harga : '')) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Stok', 'stok', ['class' => 'fw-bold mb-2']) ?>
					<?= form_input(
						[
							'name' => 'stok',
							'type' => 'number', 
							'class' => 'form-control shadow-none',
							'required' => 'required'
						], set_value('stok', (isset($detail_produk)) ? $detail_produk -> stok : '')) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Deskripsi Produk', 'deskripsi', ['class' => 'fw-bold mb-2']) ?>
					<?= form_textarea(
						[
							'name' => 'deskripsi',
							'class' => 'form-control shadow-none',
							'required' => 'required',
							'style' => 'white-space: pre-line'
						], set_value('deskripsi', (isset($detail_produk)) ? $detail_produk -> deskripsi : '')) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Foto Produk', 'gambar', ['class' => 'fw-bold mb-2']) ?>
					<?= form_upload('gambar', set_value('gambar'), ['class' => 'form-control shadow-none']) ?>
				</div>
				<div class="d-flex justify-content-end">
					<?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Simpan') ?>
				</div>
				<?= form_close() ?>
				<?php if($this->uri->segment(3) != 'sunting'): ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
