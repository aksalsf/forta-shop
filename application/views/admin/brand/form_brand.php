<!-- Modal -->
<div class="modal fade" id="modalBrand" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?= form_open('admin/brand', ['class' => 'p-3']) ?>
				<h2 class="fw-bold mt-3 mb-5">Brand Baru</h2>
				<div class="mb-3">
					<?= form_label('Nama Brand', 'nama', ['class' => 'fw-bold mb-2']) ?>
					<?= form_input('nama', set_value('nama'), [
						'class' => 'form-control shadow-none',
						'required' => 'required'
					]) ?>
				</div>
				<div class="d-flex justify-content-end">
					<?= form_button(['name' => 'tambah','type' => 'submit', 'class' => 'btn btn-primary'], 'Simpan') ?>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
