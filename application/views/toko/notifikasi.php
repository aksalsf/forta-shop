<div class="position-fixed top-0 start-0 p-3" style="z-index: 5">
	<div id="toast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header">
			<strong class="me-auto">🐱‍💻 FortaBot</strong>
		</div>
		<div class="toast-body">
			<?= $this->session->flashdata('notifikasi'); ?>
		</div>
	</div>
</div>
