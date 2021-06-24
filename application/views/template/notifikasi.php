<div class="position-fixed top-0 end-0 p-3" style="z-index: 5">
	<div id="notifikasi" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
		<div class="toast-header">
			<strong class="me-auto">🐱‍💻 FortaBot</strong>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"
				onclick="$('.toast').toast('dispose')"></button>
		</div>
		<div class="toast-body">
			<?= $this->session->flashdata('notifikasi'); ?>
		</div>
	</div>
</div>
