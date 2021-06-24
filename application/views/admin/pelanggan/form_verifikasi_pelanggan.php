<!-- Modal -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?= form_open('admin/pelanggan/detail/'.$pelanggan -> id_pelanggan, ['class' => 'p-3']) ?>
				<h2 class="fw-bold mt-3 mb-5">Verifikasi Pelanggan</h2>
				<div class="mb-3">
					<?= form_label('Status', 'status', ['class' => 'fw-bold mb-2']) ?>
					<?= form_dropdown('status', 
                        [
                            'ACTIVE' => 'ACTIVE',
                            'SUSPEND' => 'SUSPEND',
                            'BLOCKED' => 'BLOCKED'
                        ],
                        set_value('status') ,['class' => 'form-select', 'required' => 'required']) ?>
				</div>
				<div class="d-flex justify-content-end">
					<?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Simpan') ?>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
