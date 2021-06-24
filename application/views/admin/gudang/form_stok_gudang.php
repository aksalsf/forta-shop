<!-- Modal -->
<div class="modal fade" id="modalStok" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?= form_open('admin/gudang/update_stok', ['class' => 'p-3']) ?>
				<h2 class="fw-bold mt-3 mb-5">Update Stok</h2>
				<div class="mb-3">
					<?= form_label('Brand', 'id_produk', ['class' => 'fw-bold mb-2']) ?>
					<?= form_dropdown('id_produk', $produk, set_value('id_produk') ,['class' => 'form-select', 'required' => 'required', 'min' => 1]) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Stok', 'stok', ['class' => 'fw-bold mb-2']) ?>
					<?= form_input(
						[
							'name' => 'stok',
							'type' => 'number', 
							'class' => 'form-control shadow-none',
							'required' => 'required'
						], set_value('stok')) ?>
				</div>
				<div class="d-flex justify-content-end">
					<?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Simpan') ?>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
